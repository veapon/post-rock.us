<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('/spider/{module}/{id}', 'SpiderController@get');

Route::get('/album/new', 'AlbumController@createForm');
Route::post('/album/new', 'AlbumController@create');

