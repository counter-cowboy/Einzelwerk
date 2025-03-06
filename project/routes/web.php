<?php

use App\Http\Controllers\API\ContragentController;
use App\Http\Controllers\SwaggerTokenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

