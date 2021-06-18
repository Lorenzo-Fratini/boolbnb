<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GuestController@index')
    -> name('index');

Route::post('/search', 'GuestController@search')
    -> name('search');

Route::get('/show/apartment/{id}', 'GuestController@showApartment')
    -> name('showApartment');
Route::post('/store/Message', 'GuestController@storeMessage')
    -> name('storeMessage');
    
Route::get('/dashboard/{id}', 'LoggedController@dashboard')
    -> name('dashboard');

Auth::routes();
