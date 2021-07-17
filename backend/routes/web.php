<?php

Route::group(['middleware' => 'auth'], function () {
    //本 ダッシュボード表示
    Route::get('/', 'BooksController@index');

    //登録処理
    Route::post('/books', 'BooksController@store');

    //更新画面
    Route::post('/booksedit/{books}', 'BooksController@edit');

    //更新処理
    Route::post('/books/update', 'BooksController@update');

    //本を削除
    Route::delete('/book/{book}', 'BooksController@destroy');
});


//Auth
Auth::routes();
Route::get('/home', 'BooksController@index')->name('home');