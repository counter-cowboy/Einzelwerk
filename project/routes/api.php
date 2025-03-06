<?php

use App\Http\Controllers\API\ContragentController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\SwaggerTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/contragents', ContragentController::class)->middleware('auth:sanctum');

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});

Route::post('/swaglogin', [SwaggerTokenController::class, 'login']);
