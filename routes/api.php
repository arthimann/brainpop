<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/auth', 'namespace' => 'V1\Auth'], function () {
    Route::post('register', RegisterController::class);
    Route::post('signin', SigninController::class);
    Route::post('signout', SignoutController::class);

    Route::get('me', MeController::class);
});

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'v1/period', 'namespace' => 'V1\Period'], function () {
    Route::resource('/', PeriodController::class)->only('index', 'store', 'show', 'update', 'destroy');
    Route::post('assign', 'AssignmentController@store');
});

