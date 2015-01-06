<?php
class UserController extends BaseController 
{
	public function index()
	{
		
	}

	public function loginForm()
	{
		return View::make('login');
	}

	public function login()
	{
	
	}
	
	public function signupForm()
	{
		return View::make('signup');
	}

	public function signup()
	{
	}
}
