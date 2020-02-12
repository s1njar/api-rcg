<?php

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

Route::group(['middleware' => ['api'], 'prefix' => 'card'], function () {
    Route::post('create', 'CardsController@create');
    Route::post('search', 'CardsController@search');
    Route::post('searchbyid', 'CardsController@searchById');
    Route::post('delete', 'CardsController@delete');
});