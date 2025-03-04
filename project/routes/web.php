<?php

use App\Http\Controllers\API\ContragentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inn', [ContragentController::class, 'index',]);
