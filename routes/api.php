<?php

use App\Http\Controllers\Api\V1\AuthorController;
use App\Http\Controllers\Api\V1\BooksController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\PublicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/get-categories', CategoryController::class)->name('get-categories-data');
Route::get('/get-publications', PublicationController::class)->name('get-publications-data');
Route::get('/get-authors', AuthorController::class)->name('get-authors-data');
Route::get('/get-books', BooksController::class)->name('get-books-data');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
