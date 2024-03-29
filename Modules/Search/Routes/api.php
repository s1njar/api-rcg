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
    Route::post('search', 'SearchController@searchCards');
});

Route::group(['middleware' => ['api'], 'prefix' => 'deck'], function () {
    Route::post('search', 'SearchController@searchDecks');
});

Route::group(['middleware' => ['api'], 'prefix' => 'ability'], function () {
    Route::post('search', 'SearchController@searchAbilities');
});