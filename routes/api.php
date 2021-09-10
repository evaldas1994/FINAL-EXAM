<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LakeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\Authentication\LoginController;
use App\Http\Controllers\Api\Authentication\RegistrationController;

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

Route::post('/registration', [RegistrationController::class, 'save']);
Route::post('/login', [LoginController::class, 'login']);

Route::apiResource('/user', UserController::class)->except('store');
Route::apiResource('/region', RegionController::class)->except(['store', 'update', 'destroy']);
Route::apiResource('/lake', LakeController::class);
Route::apiResource('/ticket', TicketController::class);
Route::post('/ticket/price', [TicketController::class, 'price']);

