<?php

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'BookController@index')->name('home');
    Route::resource('books', BookController::class, ['except' => ['index', 'create']]);
    Route::get('me', 'UserProfileController@index')->name('me');
    Route::put('me/{user}', 'UserProfileController@upsert');
    Route::resource('books.comments', BookCommentController::class, ['only' => ['store', 'destroy']])->shallow();
});