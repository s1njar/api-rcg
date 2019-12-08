<?php

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

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api'], 'prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::post('logout', 'UserController@logout');
    Route::post('current', 'UserController@current');
    Route::post('refresh', 'UserController@refresh');
});

Route::group(['middleware' => ['api'], 'prefix' => 'user', 'namespace' => 'User\Password'], function () {
    Route::post('forgot', 'ForgotPasswordController@execute');
    Route::post('reset', 'ResetPasswordController@execute');
});