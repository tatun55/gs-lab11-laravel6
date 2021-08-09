<?php

Auth::routes(['verify' => true]);
Route::get('login/{provider}', 'SocialLoginController@redirect');
Route::get('login/{provider}/callback', 'SocialLoginController@Callback');
Route::group(['middleware' => ['verified']], function () {
    Route::get('/', 'BookController@index')->name('home');
    Route::resource('books', BookController::class, ['except' => ['index', 'create']]);
    Route::get('me', 'UserProfileController@index')->name('me');
    Route::put('me/{user}', 'UserProfileController@upsert');
    Route::resource('books.comments', BookCommentController::class, ['only' => ['store', 'destroy']])->shallow();
});

// admin
Route::group(['middleware' => ['verified']], function () {
    Route::resource('admin/users', UserController::class, ['only' => ['index', 'show']]);
});