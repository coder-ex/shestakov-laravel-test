<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\TagController;
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

Route::get('/materials', [MaterialController::class, 'getAll']);
Route::put('/materials/{id}', [MaterialController::class, 'edit']);
Route::post('/materials/create', [MaterialController::class, 'create']);
Route::get('/materials/{id}', [MaterialController::class, 'get']);
Route::get('/tags', [TagController::class, 'getAll']);
Route::put('/tags/{id}', [TagController::class, 'edit']);
Route::post('/tags/create', [TagController::class, 'create']);
Route::get('/categories', [CategoryController::class, 'getAll']);
Route::put('/categories/{id}', [CategoryController::class, 'edit']);
Route::post('/categories/create', [CategoryController::class, 'create']);
