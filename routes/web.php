<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ClientController;

/*
|--------------------------------------------------------------------------
| CLIENT CONTROLLERS
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
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /* Dashboard */
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /* Company Profile (single record) */
        Route::resource('company-profile', CompanyProfileController::class)
            ->only(['index', 'store', 'update'])
            ->names('company-profile');

        /* Content Management */
        Route::resource('articles', ArticleController::class)
            ->names('articles');

        Route::resource('products', ProductController::class)
            ->names('products');

        Route::resource('events', EventController::class)
            ->names('events');

        Route::resource('gallery', GalleryController::class)
            ->names('gallery');

        Route::resource('clients', ClientController::class)
            ->names('clients');
    });


/*
|--------------------------------------------------------------------------
| CLIENT / FRONTEND
|--------------------------------------------------------------------------
*/

/* Home */
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/* Company Profile */
Route::get('/about', [ClientCompanyProfileController::class, 'about'])
    ->name('about');

Route::get('/vision-mission', [ClientCompanyProfileController::class, 'visionMission'])
    ->name('vision-mission');

/* Articles */
Route::get('/articles', [ClientArticleController::class, 'index'])
    ->name('articles');

Route::get('/articles/{article:slug}', [ClientArticleController::class, 'show'])
    ->name('articles.show');

/* Products */
Route::get('/products', [ClientProductController::class, 'index'])
    ->name('products');

Route::get('/products/{product:slug}', [ClientProductController::class, 'show'])
    ->name('products.show');

/* Events */
Route::get('/events', [ClientEventController::class, 'index'])
    ->name('events');

Route::get('/events/{event:slug}', [ClientEventController::class, 'show'])
    ->name('events.show');

/* Gallery */
Route::get('/gallery', [ClientGalleryController::class, 'index'])
    ->name('gallery');

/* Clients */
Route::get('/clients', [ClientClientController::class, 'index'])
    ->name('clients');

/* Contact */
Route::get('/contact', function () {
    return view('pages.client.contact.index');
})->name('contact');
