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

Route::get('/', 'MainController@getIndex');

Route::get('/lorem-ipsum-generator', 'LoremGenController@getIndex');
Route::post('/lorem-ipsum-generator', 'LoremGenController@postIndex');

Route::get('/user-generator', 'UserGenController@getIndex');
Route::post('/user-generator', 'UserGenController@postIndex');

Route::get('/password-generator', 'PassGenController@getIndex');
Route::post('/password-generator', 'PassGenController@postIndex');