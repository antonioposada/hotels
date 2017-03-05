<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('services', 'ServiceController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource('hotels', 'HotelController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource('offers', 'OfferController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource('roomtypes', 'RoomTypeController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource('rates', 'RatesController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource('rooms', 'RoomController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
