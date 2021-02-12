<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/upload/user/icon', 'HomeController@uploadIcon') -> name('upload-icon');
Route::get('/delete/user/icon', 'HomeController@deleteIcon') -> name('delete-icon');
Route::get('/edit/user/icon', 'HomeController@editIcon') -> name('edit-icon');
