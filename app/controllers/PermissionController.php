<?php
class PermissionController extends BaseController 
{
	public function createGroup()
	{
		return;

		try
		{
			// Create the group
			$admin = Sentry::createGroup(array(
					'name'        => 'Administrator',
					'permissions' => array(
						'superuser'	=>1,
					),
			));

			$editor = Sentry::createGroup(array(
					'name'        => 'Editor',
					'permissions' => array(
						'band'		=>1,
						'album'		=>1,
					),
			));

		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
			echo 'Name field is required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
			echo 'Group already exists';
		}	
	}
}
