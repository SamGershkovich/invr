<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CountryOfOriginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ShrinkController;
use App\Http\Controllers\ReportController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/products', [ProductController::class, 'search']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/sub_categories', [SubCategoryController::class, 'index']);
Route::get('/country_of_origins', [CountryOfOriginController::class, 'index']);
Route::post('/inventory/update', [InventoryController::class, 'update']);
Route::get('/comments', [CommentController::class, 'getComments']);
Route::post('/addComment', [CommentController::class, 'store']);
Route::get('/messages', [MessageController::class, 'getMessages']);
Route::post('/addMessage', [MessageController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/shrink/update', [ShrinkController::class, 'update']);
Route::post('/reports', [ReportController::class, 'index']);
