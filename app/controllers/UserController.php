<?php
class UserController extends BaseController 
{
	public function index()
	{
		
	}

	public function signinForm()
	{
		return View::make('signin');
	}

	public function signin()
	{
	
	}
	
	public function signupForm()
	{
		return View::make('signup');
	}

	public function signup()
	{
		$p = Input::all();
		var_dump($p);
	}
}
