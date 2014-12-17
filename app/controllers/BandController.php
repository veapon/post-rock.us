<?php
class BandController extends BaseController 
{
	public function index()
	{
		$data['data'] = DB::table('albumInfo')->paginate(3);
		return View::make('albums', $data);
	}

	public function createForm()
	{
		$data['countries'] = Countries::getList('en', 'php', 'icu');
		return View::make('bandCreate', $data);
	}

	public function create()
	{
		// p for post
		$p = Input::all();

		$tBand = DB::table('band');
		$band = $tBand->where('name', $p['name'])->first(array('id', 'name'));
		if (!empty($band)) {
			return Response::json(array(
				'status'=>-1,
				'band'	=>$band,
			));
		}
		
		$poster = empty($p['poster']) ? '' : '/band/' . uniqid() . '.' . getExt($p['poster']);
		$data = array(
			'name'		=>$p['name'],
			'cover'		=>$poster,
			'create_time'	=>date('Y-m-d H:i:s'),
			'region'	=>$p['region'],
			'homepage'	=>$p['homepage'],
			'facebook'	=>$p['facebook'],
			'bandcamp'	=>$p['bandcamp'],
			'profile'	=>$p['profile'],
		);
		$id = $tBand->insertGetId($data);

		if ($id && $poster) {
			$picrs = $this->savePicture($p['poster'], $poster);
		} 
		
		if (!$id) {
			return Response::json(array(
				'status'=>0
			));
		} else {
			return Response::json(array(
				'status'=>1,
				'url'	=>url('band/'.$id)
			));
		}
		
	}
	
	public function detail($id)
	{
		$data['data'] = DB::table('band')->where('id', $id)->first();

		return View::make('band', $data);
	}

	public function editForm($id)
	{
		$data['countries'] = Countries::getList('en', 'php', 'icu');
		$data['data'] = (array)DB::table('band')->where('id', $id)->first();
		return View::make('bandCreate', $data);
	}
	
	public function edit()
	{
		// p for post
		$p = Input::all();

		$tBand = DB::table('band');
		$band = $tBand->where('name', $p['name'])->first(array('id', 'name'));
		if (!empty($band)) {
			return Response::json(array(
				'status'=>-1,
				'band'	=>$band,
			));
		}
		
		$poster = empty($p['poster']) ? '' : '/band/' . uniqid() . '.' . getExt($p['poster']);
		$data = array(
			'name'		=>$p['name'],
			'cover'		=>$poster,
			'create_time'	=>date('Y-m-d H:i:s'),
			'region'	=>$p['region'],
			'homepage'	=>$p['homepage'],
			'facebook'	=>$p['facebook'],
			'bandcamp'	=>$p['bandcamp'],
			'profile'	=>$p['profile'],
		);
		$id = $tBand->insertGetId($data);

		if ($id && $poster) {
			$picrs = $this->savePicture($p['poster'], $poster);
		} 
		
		if (!$id) {
			return Response::json(array(
				'status'=>0
			));
		} else {
			return Response::json(array(
				'status'=>1,
				'url'	=>url('band/'.$id)
			));
		}
	}
}
