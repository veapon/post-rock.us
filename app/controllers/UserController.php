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
		$input['email'] = Input::get('email');
		$input['password'] = Input::get('password');
			
		try
		{
		    // Authenticate the user
		    $user = Sentry::authenticate($input, false);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		    echo 'Wrong password, try again.';
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    echo 'User is not activated.';
		}

		// The following is only required if the throttling is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    echo 'User is suspended.';
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    echo 'User is banned.';
		}
	}

	public function signupForm()
	{
		return View::make('signup');
	}

	public function signup()
	{
		$p = Input::all();
		$data = $p;

		if (empty($p['name'])) {
			$data['error'] = 'Name field is required';
			return View::make('signup', $data);
		} elseif (Users::where('name', '=', $p['name'])->first()) {
			$data['error'] = 'The user name has been registered';
			return View::make('signup', $data);
		}

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
			$data['error'] = 'Login field is required.';
			return View::make('signup', $data);
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			$data['error'] = 'Password field is required.';
			return View::make('signup', $data);
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$data['error'] = 'This email has been registered.';
			return View::make('signup', $data);
		}
		
		$data['success'] = 1;
		return View::make('signup', $data);
	}
}
