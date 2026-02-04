<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| AUTH CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\{
    DashboardController,
    CompanyProfileController,
    ArticleController,
    ProductController,
    EventController,
    GalleryController,
    ClientController,
    OrderController as AdminOrderController
};

/*
|--------------------------------------------------------------------------
| CLIENT / PUBLIC CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Client\{
    HomeController,
    CompanyProfileController as ClientCompanyProfileController,
    ArticleController as ClientArticleController,
    ProductController as ClientProductController,
    EventController as ClientEventController,
    GalleryController as ClientGalleryController,
    ClientController as ClientClientController
};

/*
|--------------------------------------------------------------------------
| USER / SHOP CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\User\{
    CartController,
    CheckoutController,
    OrderController as UserOrderController,
    ProfileController
};

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('company-profile', CompanyProfileController::class)
        ->only(['index', 'store', 'update']);

    Route::resource('articles', ArticleController::class);
    Route::resource('products', ProductController::class);
    Route::resource('events', EventController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('clients', ClientController::class);

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
});

/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [ClientCompanyProfileController::class, 'about'])->name('about');
Route::get('/vision-mission', [ClientCompanyProfileController::class, 'visionMission'])->name('vision-mission');

Route::get('/articles', [ClientArticleController::class, 'index'])->name('articles');
Route::get('/articles/{article:slug}', [ClientArticleController::class, 'show'])->name('articles.show');

Route::get('/products', [ClientProductController::class, 'index'])->name('products');
Route::get('/products/{product:slug}', [ClientProductController::class, 'show'])->name('products.show');

Route::get('/events', [ClientEventController::class, 'index'])->name('events');
Route::get('/events/{event:slug}', [ClientEventController::class, 'show'])->name('events.show');

Route::get('/gallery', [ClientGalleryController::class, 'index'])->name('gallery');
Route::get('/clients', [ClientClientController::class, 'index'])->name('clients');
Route::get('/contact', fn () => view('pages.client.contact.index'))->name('contact');

/*
|--------------------------------------------------------------------------
| USER / SHOP
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // CART
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/buy-now', [CartController::class, 'buyNow'])->name('cart.buyNow');

    // CHECKOUT
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/payment/{order}', [CheckoutController::class, 'payment'])->name('checkout.payment');

    // ORDERS
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| MIDTRANS CALLBACK (SERVER TO SERVER)
|--------------------------------------------------------------------------
*/
Route::post('/midtrans/callback', function (Request $request) {

    Log::info('MIDTRANS CALLBACK', $request->all());

    $order = Order::where('order_number', $request->order_id)->first();

    if (! $order) {
        Log::error('ORDER NOT FOUND', ['order_id' => $request->order_id]);
        return response()->json(['message' => 'Order not found'], 404);
    }

    $status = $request->transaction_status;
    $type   = $request->payment_type;

    // 🔹 normalize payment method
    $paymentMethod = $type;

    if ($type === 'bank_transfer') {
        $paymentMethod .= ' - ' . ($request->va_numbers[0]['bank'] ?? 'unknown');
    }

    if ($status === 'settlement' || ($status === 'capture' && $type === 'credit_card')) {

        $order->update([
            'payment_status'            => 'paid',
            'payment_method'            => $paymentMethod,
            'midtrans_transaction_id'   => $request->transaction_id,
            'midtrans_response'         => $request->all(),
        ]);

    } elseif ($status === 'expire') {

        $order->update(['payment_status' => 'expired']);

    } elseif (in_array($status, ['cancel', 'deny'])) {

        $order->update(['payment_status' => 'failed']);
    }

    return response()->json(['success' => true]);
});
