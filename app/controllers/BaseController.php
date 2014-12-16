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
			'field'	=>'file',
			'path'	=>Config::get('app.picPath') . '/temp',
			'name'	=>md5(time().rand(1000, 9999))
		);

		// combine upload configs
		$cfg = array_merge($defaults, $cfg);
		
		// process file
		try {
			$file = Input::file($cfg['field']);
			$target = $cfg['path'];
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

	public function tmpPicUpload()
	{
		$res = $this->upload(array('field'=>'file'));

		if (!$res) {
			$return['error'] = isset($this->uploadError) ? $this->uploadError : 'Upload failed';
		} else {
			$return['url'] = Config::get('app.picHost') . '/temp/'.$res['name'];
		}

		return Response::json($return);
	}

	protected function savePicture($source, $target)
	{
		try {
			return file_put_contents(Config::get('app.picPath') . $target, file_get_contents($source));
		} catch (Exception $e)	{
			return false;
		}
	}

}
