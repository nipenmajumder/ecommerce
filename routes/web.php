<?php

use App\Http\Controllers\Backend\Api\BarcodeWiseProduct;
use App\Http\Controllers\Backend\Api\GenerateSkuBarcode;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PublicationController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\AuthorBooksController;
use App\Http\Controllers\Frontend\BookDetailsController;
use App\Http\Controllers\Frontend\BooksController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryBooksController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CustomerDashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PublicationBooksController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('subjects', \App\Http\Controllers\Frontend\CategoryController::class)->name('subjects');
Route::get('publications', \App\Http\Controllers\Frontend\PublicationController::class)->name('publications');
Route::get('authors', \App\Http\Controllers\Frontend\AuthorController::class)->name('authors');
Route::get('books', BooksController::class)->name('books');
Route::get('author/{slug}', AuthorBooksController::class)->name('author.book');
Route::get('subject/{slug}', CategoryBooksController::class)->name('subject.book');
Route::get('publication/{slug}', PublicationBooksController::class)->name('publication.book');
Route::get('book-details/{slug}', BookDetailsController::class)->name('book-details-slug');
Route::post('search', SearchController::class)->name('search');

Route::resource('cart', CartController::class)->middleware(['web'])->only(['index', 'store', 'update', 'destroy']);

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'dashboard'])->name('customer-dashboard.home');
    Route::resource('checkout', CheckoutController::class);
    Route::get('user-logout', [CustomerDashboardController::class, 'logout'])->name('customer-dashboard.logout');
    Route::resource('orders', \App\Http\Controllers\Frontend\OrderController::class);
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::resource('slider', SliderController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('author', AuthorController::class);
    Route::resource('publication', PublicationController::class);
    Route::resource('product', ProductController::class);
    Route::resource('purchase', PurchaseController::class)->except(['edit', 'update']);
    Route::resource('order', OrderController::class);
    Route::resource('role', RoleController::class);
    Route::resource('settings', SettingsController::class)->only(['index', 'store']);

    Route::post('barcode-wise-product', BarcodeWiseProduct::class)->name('barcode-wise-product');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('get-authors', \App\Http\Controllers\Backend\Api\AuthorController::class)->name('get-authors');
    Route::get('get-publications', \App\Http\Controllers\Backend\Api\PublicationController::class)->name('get-publications');
    Route::get('get-sku-barcode', GenerateSkuBarcode::class)->name('get-sku-barcode');
});

require __DIR__.'/auth.php';
