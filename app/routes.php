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

<<<<<<< HEAD
Route::get('/', 'HomeController@index');

Route::get('/spider/{module}/{id}', 'SpiderController@get');

Route::get('/album/new', 'AlbumController@createForm');
Route::post('/album/new', 'AlbumController@create');
=======
Route::get('/', function()
{
	return View::make('hello');
});
>>>>>>> e4e59a6e39c3326bbe0bc1e847d63846555211ea
