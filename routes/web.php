<?php

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

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/booking/{id}', 'BookingController@index');
Route::post('/search', 'BookingController@search');
Route::post('/results', 'BookingController@results');


Route::get('/home', 'HomeController@index');


Route::group(['middleware' => 'auth'], function () {

    Route::get('roomtypes', function () {
        return view('config/roomtypes');
    });

    Route::get('services', function () {
        return view('config/services');
    });

    Route::get('hotels', function () {
        return view('config/hotels');
    });

    Route::get('hotelservices/{id}', 'HotelController@services');
    Route::post('hotelservices/{id}', 'HotelController@saveService');
    Route::post('deleteservice/', 'HotelController@deleteService');


    Route::get('offers', function () {
        return view('config/offers');
    });

    Route::get('rates', function () {
        return view('config/rates');
    });

    Route::get('rooms', function () {
        return view('config/rooms');
    });

    Route::get('roomrates/{id}', 'RoomController@rates');
    Route::post('roomrates/{id}', 'RoomController@saveRate');
    Route::post('deleterate/', 'RoomController@deleteRate');


});

