<?php

use App\Http\Controllers\Api\PDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LakeController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\TicketController;

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

Route::apiResource('/lake', LakeController::class);

Route::apiResource('/region', RegionController::class)->except(['store', 'update', 'destroy']);
Route::get('/region/{id}/lakes', [RegionController::class, 'getLakesByRegionId']);

Route::apiResource('/ticket', TicketController::class)->except('update');
Route::post('/ticket/price', [TicketController::class, 'price']);
Route::get('/ticket/{id}/pdf', [PDFController::class, 'createPDF']);
