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

Route::get('favorite-sites/create', 'FavoriteSiteController@create');
Route::post('favorite-sites', 'FavoriteSiteController@store');
Route::get('favorite-sites', 'FavoriteSiteController@index');