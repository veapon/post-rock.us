<?php
class UserController extends BaseController 
{
	public function index()
	{
		$user = Sentry::getUser();
		var_dump($user);

		echo '<hr>';
		if ($user->isSuperUser()) {
			echo 1;
		} else {
			echo 0;
		}
	}

	public function signinForm()
	{
		return View::make('signin');
	}

	public function signin()
	{
		if (Sentry::check()) {
			return Redirect::to('/dashboard');
		}

		$input['email'] = Input::get('email');
		$input['password'] = Input::get('password');
		$remember = !Input::get('rem') ? false : true;
		
		$data = Input::all();
		try
		{
		    // Authenticate the user
		    $user = Sentry::authenticate($input, $remember);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    $data['error'] = 'Email field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    $data['error'] = 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		    $data['error'] = 'Invalid email or password.';
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    $data['error'] = 'Invalid email or password.';
		}
		// The following is only required if the throttling is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    $data['error'] = 'User is suspended.';
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    $data['error'] = 'User is banned.';
		}

		if (isset($data['error'])) {
			return View::make('signin', $data);	
		}

		return Redirect::to('/dashboard');
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
