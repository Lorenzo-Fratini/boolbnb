<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('/getApartments/{searchString}', 'ApiController@getApartments')
    -> name('getApartments');

Route::get('/getServices', 'ApiController@getServices')
    -> name('getServices');

Route::post('/filterApartments/{searchString}/{filterServices}', 'ApiController@filterApartments')
    -> name('filterApartments');

Route::post('/filterBedsRooms/{searchString}/{bedsRooms}', 'ApiController@filterBedsRooms')
    -> name('filterBedsRooms');