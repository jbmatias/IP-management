<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\IndexIpAddressController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StoreIpAddressController;
use App\Http\Controllers\UpdateIpAddressController;
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

Route::post('/register', RegisterController::class)->name('user.store');
Route::post('/login', LoginController::class)->name('user.login');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['guest', 'signed', 'throttle:6,1'])
    ->name('verification.verify');            

Route::middleware('auth:api')->group(function () {
    Route::post('/ip', StoreIpAddressController::class)->name('ip.store');
    Route::get('/ip', IndexIpAddressController::class)->name('ip.index');
    Route::put('/ip/{address}', UpdateIpAddressController::class)->name('ip.update');
});
