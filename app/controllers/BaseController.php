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

	protected function upload($module='album')
	{
		$path = array(
			'album'	=>
		);
		// Simple validation (max file size 2MB and only two allowed mime types)
		$validator = new FileUpload\Validator\Simple(1024 * 1024 * 2, ['image/png', 'image/jpg']);

		// Simple path resolver, where uploads will be put
		$pathresolver = new FileUpload\PathResolver\Simple('/my/uploads/dir');

		// The machine's filesystem
		$filesystem = new FileUpload\FileSystem\Simple();

		// FileUploader itself
		$fileupload = new FileUpload\FileUpload($_FILES['files'], $_SERVER);

		// Adding it all together. Note that you can use multiple validators or none at all
		$fileupload->setPathResolver($pathresolver);
		$fileupload->setFileSystem($filesystem);
		$fileupload->addValidator($validator);

		// Doing the deed
		list($files, $headers) = $fileupload->processAll();

		// Outputting it, for example like this
		foreach($headers as $header => $value) {
			header($header . ': ' . $value);
		}

		echo json_encode(array('files' => $files));
	}

}
