<?php

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

Route::group(['middleware' => ['api'], 'prefix' => 'decks'], function () {
    Route::post('create', 'DeckController@create');
    Route::post('search', 'DeckController@search');
    Route::post('searchbyid', 'DeckController@searchById');
    Route::post('delete', 'DeckController@delete');
});