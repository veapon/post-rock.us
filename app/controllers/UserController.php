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

		try
		{
			$user = Sentry::register(array(
						'email'    	=> $p['email'],
						'password' 	=> $p['password'],
						'name'		=> $p['name']
					));
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			echo 'User with this login already exists.';
		}
	}
}
