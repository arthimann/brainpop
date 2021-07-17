<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/auth', 'namespace' => 'V1\Auth'], function () {
    Route::post('register', 'RegisterController');
    Route::post('signin', 'SigninController');
    Route::post('signout', 'SignoutController');

    Route::get('me', MeController::class);
});

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'v1', 'namespace' => 'V1\Period'], function () {
    Route::resource('period', 'PeriodController')
        ->only('index', 'store', 'show', 'update', 'destroy');

    Route::post('assign', 'AssignmentController@store')->name('assign');
    Route::patch('assign/{id}', 'AssignmentController@update')->name('update');
});

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'v1', 'namespace' => 'V1\Teacher'], function () {
    Route::resource('teacher', 'TeacherController')
        ->only('show', 'update', 'destroy');

    Route::get('teacher/periods/{id}', 'TeacherController@periods')->name('periods');
});

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'v1', 'namespace' => 'V1\Student'], function () {
    Route::resource('student', 'StudentController')
        ->only('show', 'update', 'destroy');
});

