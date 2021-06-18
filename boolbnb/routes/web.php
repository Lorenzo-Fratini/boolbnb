<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GuestController@index')
    -> name('index');

Route::get('/apartment/{id}', 'GuestController@showApartment')
    -> name('apartment.show');
Route::post('/storeMessage', 'GuestController@storeMessage')
        -> name('storeMessage');
    
Route::get('/apartment/create', 'LoggedController@createApartment')
    -> name('apartment.create');
Route::get('/apartment', 'LoggedController@storeApartment')
    -> name('apartment.store');
    
Route::get('/apartment/{id}/edit', 'LoggedController@editApartment')
    -> name('apartment.edit');
Route::get('/apartment', 'LoggedController@updateApartment')
    -> name('apartment.update');
    
Route::get('/apartment/{id}', 'LoggedController@destroyApartment')
    -> name('apartment.destroy');
    
Route::get('/search', 'GuestController@advancedSearch')
    -> name('advancedSearch');

Route::get('/show/apartment/{id}', 'GuestController@showApartment')
    -> name('showApartment');
Route::post('/store/Message', 'GuestController@storeMessage')
    -> name('storeMessage');
    
Route::get('/dashboard/{id}', 'LoggedController@dashboard')
    -> name('dashboard');

Auth::routes();
