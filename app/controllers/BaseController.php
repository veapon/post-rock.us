<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function upload(array $cfg = array())
	{
		$defaults = array(
			'field'	=>'files',
			'path'	=>'/pics/temp',
			'name'	=>md5(time().rand(1000, 9999))
		);

		// combine upload configs
		$cfg = array_merge($defaults, $cfg);
		
		// process file
		try {
			$file = Input::file($cfg['field']);
			$target = public_path() . $cfg['path'];
			$filename = $cfg['name'] . '.' . $file->getClientOriginalExtension();
			$file->move($target, $filename);
			return array(
				'absPath'	=>$target,
				'path'		=>$cfg['path'],
				'name'		=>$filename,
			);
		} catch (Exception $e) {
			$this->uploadError = $e->getMessage();
			return false;
		}
				
	}

}
