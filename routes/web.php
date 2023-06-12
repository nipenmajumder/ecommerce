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
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('frontend.layouts.app');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::resource('slider', SliderController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('author', AuthorController::class);
    Route::resource('publication', PublicationController::class);
    Route::resource('product', ProductController::class);
    Route::resource('purchase', PurchaseController::class)->except(['edit', 'update']);
    Route::post('barcode-wise-product', BarcodeWiseProduct::class)->name('barcode-wise-product');
    Route::resource('order', OrderController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('get-authors', \App\Http\Controllers\Backend\Api\AuthorController::class)->name('get-authors');
    Route::get('get-publications', \App\Http\Controllers\Backend\Api\PublicationController::class)->name('get-publications');
    Route::get('get-sku-barcode', GenerateSkuBarcode::class)->name('get-sku-barcode');
});

require __DIR__ . '/auth.php';
