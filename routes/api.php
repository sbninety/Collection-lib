<?php

use App\Http\Controllers\CollectionController;
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

Route::prefix('collection')->group(function () {
    Route::get('/push', [CollectionController::class, 'push']);
    Route::get('/filter', [CollectionController::class, 'filter']);
    Route::get('/map', [CollectionController::class, 'map']);
    Route::get('/merge', [CollectionController::class, 'merge']);
    Route::get('/first', [CollectionController::class, 'first']);
    Route::get('/each', [CollectionController::class, 'each']);
    Route::get('/foreach', [CollectionController::class, 'foreach']);
    Route::get('/', [CollectionController::class, 'index']);
});
