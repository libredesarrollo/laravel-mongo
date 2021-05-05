<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('event', 'Api\EventController')->except('create','edit');

Route::put('event/update_range/{event}','Api\EventController@update_range');
Route::put('event/update_by_hour/{event}','Api\EventController@update_by_hour');

Route::post('event/store_by_hour','Api\EventController@store_by_hour');