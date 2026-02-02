<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| CLIENT / PUBLIC
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\CompanyProfileController as ClientCompanyProfileController;
use App\Http\Controllers\Client\ArticleController as ClientArticleController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\EventController as ClientEventController;
use App\Http\Controllers\Client\GalleryController as ClientGalleryController;
use App\Http\Controllers\Client\ClientController as ClientClientController;

/*
|--------------------------------------------------------------------------
| USER / SHOP
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\ProfileController;

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
Route::middleware('auth')
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

   
    Route::get('/orders', [UserOrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [UserOrderController::class, 'show'])
        ->name('orders.show');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| MIDTRANS CALLBACK
|--------------------------------------------------------------------------
*/
Route::post('/midtrans/callback', function (Request $request) {
    $order = \App\Models\Order::where('order_number', $request->order_id)->firstOrFail();

    if ($request->transaction_status === 'settlement') {
        $order->update(['payment_status' => 'paid']);
    } elseif (in_array($request->transaction_status, ['expire', 'cancel'])) {
        $order->update(['payment_status' => 'failed']);
    }

    return response()->json(['success' => true]);
});
