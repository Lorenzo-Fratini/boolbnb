<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GuestController@index')
    -> name('index');

Route::get('/apartment/{id}', 'GuestController@showApartment')
    -> name('apartment.show');
Route::post('/storeMessage', 'GuestController@storeMessage')
        -> name('storeMessage');
    
Route::get('/search', 'GuestController@advancedSearch')
    -> name('advancedSearch');

Route::get('/dashboard/{id}', 'LoggedController@dashboard')
    -> name('dashboard');

Auth::routes();
