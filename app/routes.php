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

Route::pattern('id', '[0-9]+');

Route::get('/', 'HomeController@index');
//Route::get('/', 'AlbumController@index');

Route::get('/spider/{module}/{id}', 'SpiderController@get');

Route::post('/upload/tmp', 'BaseController@tmpPicUpload');

Route::get('/albums', 'AlbumController@index');
Route::get('/album/{id}', 'AlbumController@detail');
Route::get('/album/create', 'AlbumController@createForm');
Route::post('/album/create', 'AlbumController@create');
Route::get('/album/update/{id}', 'AlbumController@editForm');
Route::post('/album/update', 'AlbumController@edit');

Route::get('/bands', 'BandController@index');
Route::get('/band/create', 'BandController@createForm');
Route::post('/band/create', 'BandController@create');
Route::get('/band/{id}', 'BandController@detail');
Route::get('/band/update/{id}', 'BandController@editForm');
Route::post('/band/update', 'BandController@edit');

Route::get('/login', 'UserController@loginForm');
Route::group(array('before' => 'auth'), function()
{
	Route::get('/dashboard', 'UserController@index');
});
