<?php

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'BookController@index')->name('home');
    Route::resource('books', BookController::class, ['except' => ['index', 'create']]);
});