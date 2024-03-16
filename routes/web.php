<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CatalogController::class, 'index'])->name('home');

Route::get('/catalog/{product}', [CatalogController::class, 'view'])->name('catalog');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::group(['middleware' => ['auth', 'customer']], static function () {
    Route::group(['prefix' => 'order'], static function () {
        Route::get('/', [OrderController::class, 'index'])->name('order');
        Route::get('/{order}', [OrderController::class, 'view'])->name('order.view');
    });

    Route::group(['prefix' => 'invoice'], static function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('invoice');
        Route::get('/{code}', [InvoiceController::class, 'view'])->name('invoice.view');
    });

    Route::group(['prefix' => 'payment'], static function () {
        Route::get('/', [PaymentController::class, 'pay'])->name('payment');
        Route::get('/callback', [PaymentController::class, 'callback'])->name('payment.callback');
    });
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'customer'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
