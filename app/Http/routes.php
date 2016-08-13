<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/csrf', function() {
    return csrf_token();
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/input/s/{appKey}/{sense}', [
    "uses" => "DeviceController@smokeSense",
    "name" => "signal"
])->where('appKey', '[0-9A-Za-z]+')->where('sense', '^(0|1)$');

Route::get('/input/c/{appKey}/{batt}', 'DeviceController@connectSense')
    ->name('connect')
    ->where('appKey', '[0-9A-Za-z]+')
    ->where('batt', '[0-9]{1,5}');

Route::post('/reg', 'DeviceController@deviceReg')->name('device_reg');


//Route::group(['middleware' => 'web'], function () {
//    Route::auth();
//    Route::get('/', 'PagesController@index');
//    Route::get('terms-of-service', 'PagesController@terms');
//    Route::get('privacy', 'PagesController@privacy');
//    Route::get('combo', 'PagesController@combo');
//});