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

Route::group(['prefix' => '/v1'], function () {
    Route::get('/pokemon', 'PokemonController@index');
    Route::get('/pokemon/{pokemon}', 'PokemonController@show');

    Route::get('/search', 'PokemonController@search');

    Route::get('/teams', 'TeamController@index');
    Route::post('/teams}', 'TeamController@create');
    Route::get('/teams/{team}', 'TeamController@show');
    Route::post('/teams/{team}', 'TeamController@update');
});

Route::group(['prefix' => '/v2'], function () {
    Route::get('/pokemon', 'PokemonController@index');
});
