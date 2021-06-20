<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GuestController@index')
    -> name('index');

Route::get('/apartment/{id}', 'GuestController@showApartment')
    -> name('showApartment');

Route::post('/message/store', 'GuestController@storeMessage')
    -> name('storeMessage');

Route::get('/search', 'GuestController@search')
    -> name('search');

Route::get('/dashboard/{id}', 'LoggedController@dashboard')
    -> name('dashboard');

Route::get('/apartment/create', 'LoggedController@createApartment')
    -> name('createApartment');
Route::post('/apartment/store', 'LoggedController@storeApartment')
    -> name('storeApartment');
    
Route::get('/apartment/edit/{id}', 'LoggedController@editApartment')
    -> name('editApartment');
Route::post('/apartment/update', 'LoggedController@updateApartment')
    -> name('updateApartment');
    
Route::get('/delete/apartment/{id}', 'LoggedController@destroyApartment')
    -> name('destroyApartment');

Auth::routes();
