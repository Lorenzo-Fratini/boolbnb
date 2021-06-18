<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'GuestController@index')
    -> name('index');

Route::get('/apartment/{id}', 'GuestController@apartment')
    -> name('apartment.show');
    
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

Route::get('/dashboard/{id}', 'LoggedController@dashboard')
    -> name('dashboard');

Route::get('/message/{id}', 'GuestController@message')
    -> name('message');

Route::post('/storeMessage/{id}', 'GuestController@storeMessage')
    -> name('storeMessage');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/flat', 'MyController@flat') -> name('flat');
// Route::get('/home', 'HomeController@index')->name('home');
