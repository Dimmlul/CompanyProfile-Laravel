<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| ADMIN
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
    UserController,
    OrderController as AdminOrderController,
    MessageController as AdminMessageController,
};

/*
|--------------------------------------------------------------------------
| CLIENT / PUBLIC
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Client\{
    HomeController,
    CompanyProfileController as ClientCompanyProfileController,
    ArticleController as ClientArticleController,
    ProductController as ClientProductController,
    EventController as ClientEventController,
    GalleryController as ClientGalleryController,
    ClientController as ClientClientController,
    ContactController as ClientContactController,
    MessageController as ClientMessageController,
};

/*
|--------------------------------------------------------------------------
| USER / SHOP
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\User\{
    CartController,
    CheckoutController,
    OrderController as UserOrderController,
    ProfileController,
    MessageController as UserMessageController,
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
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('company-profile', CompanyProfileController::class)
            ->only(['index', 'store', 'update']);

        Route::resource('articles', ArticleController::class);
        Route::resource('products', ProductController::class);
        Route::resource('events', EventController::class);
        Route::resource('gallery', GalleryController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('users', UserController::class);

        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        // Messages
        Route::get('/messages', [AdminMessageController::class, 'index'])
            ->name('messages.index');
        Route::get('/messages/{message}', [AdminMessageController::class, 'show'])
            ->name('messages.show');
        Route::post('/messages/{message}/reply', [AdminMessageController::class, 'reply'])
            ->name('messages.reply');
    });

/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [ClientCompanyProfileController::class, 'about'])
    ->name('about');

Route::get('/articles', [ClientArticleController::class, 'index'])
    ->name('articles');
Route::get('/articles/{article:slug}', [ClientArticleController::class, 'show'])
    ->name('articles.show');

Route::get('/products', [ClientProductController::class, 'index'])
    ->name('products');
Route::get('/products/{product:slug}', [ClientProductController::class, 'show'])
    ->name('products.show');

Route::get('/events', [ClientEventController::class, 'index'])
    ->name('events');
Route::get('/events/{event:slug}', [ClientEventController::class, 'show'])
    ->name('events.show');

Route::get('/gallery', [ClientGalleryController::class, 'index'])
    ->name('gallery');

Route::get('/clients', [ClientClientController::class, 'index'])
    ->name('clients');

Route::get('/contact', [ClientContactController::class, 'contact'])
    ->name('contact');
Route::post('/contact/send', [ClientContactController::class, 'send'])
    ->name('contact.send');

/*
|--------------------------------------------------------------------------
| CLIENT MESSAGES (GUEST CHAT)
|--------------------------------------------------------------------------
*/
Route::prefix('messages')->name('client.messages.')->group(function () {
    Route::get('/start', [ClientMessageController::class, 'create'])->name('start');
    Route::post('/start', [ClientMessageController::class, 'store'])->name('store');
    Route::get('/{token}', [ClientMessageController::class, 'show'])->name('show');
    Route::post('/{token}/reply', [ClientMessageController::class, 'reply'])->name('reply');
});

/*
|--------------------------------------------------------------------------
| USER / SHOP (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/buy-now', [CartController::class, 'buyNow'])->name('cart.buyNow');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/payment/{order}', [CheckoutController::class, 'payment'])
        ->name('checkout.payment');

    // Orders
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
    Route::get(
        '/orders/{order}/items/{item}/download',
        [UserOrderController::class, 'download']
    )->name('orders.items.download');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::match(['post', 'put'], '/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // User messages
    Route::get('/user/messages', [UserMessageController::class, 'index'])
        ->name('user.messages.index');
    Route::get('/user/messages/{message}', [UserMessageController::class, 'show'])
        ->name('user.messages.show');
    Route::post(
        '/user/messages/{message}/reply',
        [UserMessageController::class, 'reply']
    )->name('user.messages.reply');
});

/*
|--------------------------------------------------------------------------
| MIDTRANS CALLBACK
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

    $paymentMethod = $type;

    if ($type === 'bank_transfer') {
        $paymentMethod .= ' - ' . ($request->va_numbers[0]['bank'] ?? 'unknown');
    }

    if ($status === 'settlement' || ($status === 'capture' && $type === 'credit_card')) {

        $order->update([
            'payment_status'          => 'paid',
            'payment_method'          => $paymentMethod,
            'midtrans_transaction_id' => $request->transaction_id,
            'midtrans_response'       => $request->all(),
        ]);

    } elseif ($status === 'expire') {

        $order->update(['payment_status' => 'expired']);

    } elseif (in_array($status, ['cancel', 'deny'])) {

        $order->update(['payment_status' => 'failed']);
    }

    return response()->json(['success' => true]);
});
