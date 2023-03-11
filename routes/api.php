<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/artwork', [\App\Http\Controllers\ArtworkController::class, 'index']);
Route::get('/artwork/category/{artwork_category}', \App\Http\Controllers\ArtworkByCategoryController::class);
Route::get('/artwork_category', [\App\Http\Controllers\ArtworkCategoryController::class, 'index']);
