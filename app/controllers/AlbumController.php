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
		// p for post
		$p = Input::all();

		$artistId = Artist::firstOrCreate(array('name' => 'John'));
	}

}
