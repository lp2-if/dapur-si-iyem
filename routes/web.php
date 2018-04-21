<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/api/v1', 'namespace' => 'Api\V1'], function() {
    Route::group(['prefix' => 'food'], function() {
        Route::get('/', 'FoodController@index')->name('api.food.index');
    });

    Route::group(['prefix' => 'glosary'], function() {
        Route::get('/', 'GlosaryController@index')->name('api.glosary.index');
    });

    Route::group(['prefix' => 'ingredient'], function() {
        Route::get('/', 'IngredientController@index')->name('api.ingredient.index');
    });
});
