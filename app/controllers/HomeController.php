<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

<<<<<<< HEAD
	public function index()
	{
		$data['countries'] = Countries::getList('en', 'php', 'icu');
		return View::make('hello', $data);
=======
	public function showWelcome()
	{
		return View::make('hello');
>>>>>>> e4e59a6e39c3326bbe0bc1e847d63846555211ea
	}

}
