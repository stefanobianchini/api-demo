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

Route::get('/users', [\App\Http\Controllers\UserController::class, 'readAll']);
Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'readSingle']);
Route::post('/users', [\App\Http\Controllers\UserController::class, 'create']);
Route::put('/users/{id}', [\App\Http\Controllers\UserController::class, 'update']);
Route::patch('/users/{id}', [\App\Http\Controllers\UserController::class, 'partialUpdate']);
Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'delete']);
