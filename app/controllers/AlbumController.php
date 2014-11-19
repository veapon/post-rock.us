<?php
class AlbumController extends BaseController 
{
	public function createForm()
	{
		$data['countries'] = Countries::getList('en', 'php', 'icu');
		return View::make('albumCreate', $data);
	}

	public function create()
	{
		$p = Input::all();
		var_dump($p);
	}

}
