<?php

use Illuminate\Http\Request;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PackageController;

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

Route::get('/clients', [ClientController::class, 'index']);
Route::post('/client/create', [ClientController::class, 'store']);
Route::get('/client/{id}', [ClientController::class, 'show']);

Route::get('/packages', [PackageController::class, 'getAll']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
