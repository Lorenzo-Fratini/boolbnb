<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GuestController@index')
    -> name('index');

Route::get('/apartment/{id}', 'GuestController@showApartment')
    -> name('apartment.show');
Route::post('/storeMessage', 'GuestController@storeMessage')
    -> name('storeMessage');

Route::post('/search', 'GuestController@search')
    -> name('search');

Route::get('/dashboard/{id}', 'LoggedController@dashboard')
    -> name('dashboard');

Route::get('/apartment/create', 'LoggedController@createApartment')
    -> name('apartment.create');
Route::get('/apartment', 'LoggedController@storeApartment')
    -> name('apartment.store');
    
Route::get('/apartment/edit/{id}', 'LoggedController@editApartment')
    -> name('apartment.edit');
Route::get('/apartment', 'LoggedController@updateApartment')
    -> name('apartment.update');
    
Route::get('/delete/apartment/{id}', 'LoggedController@destroyApartment')
    -> name('apartment.destroy');

Auth::routes();
