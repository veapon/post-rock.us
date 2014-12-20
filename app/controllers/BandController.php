<?php
class BandController extends BaseController 
{
	public function index()
	{
		// query condition
		$whereField = '1';
		$whereOperator = '=';
		$whereValue = '1';

		if ($region = Input::get('region')) {
			$whereField = 'region';
			$whereValue = $region;
		}

		if ($query = Input::get('query')) {
			$whereField = 'name';
			$whereOperator = 'like';
			$whereValue = '%'.$query.'%';
		}
		
		// execute the query
		$data['data'] = DB::table('band')
			->where($where)
			->orderBy('id', 'desc')
			->paginate(10);

		// make a proper response
		if (Input::get('f') == 'json') {
			return Response::json($data);
		} else {
			return View::make('bands', $data);
		}
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
		
		$data = array(
			'name'		=>$p['name'],
			'create_time'	=>date('Y-m-d H:i:s'),
			'update_time'	=>date('Y-m-d H:i:s'),
			'region'	=>$p['region'],
			'homepage'	=>$p['homepage'],
			'facebook'	=>$p['facebook'],
			'twitter'	=>$p['twitter'],
			'soundcloud'	=>$p['soundcloud'],
			'bandcamp'	=>$p['bandcamp'],
			'profile'	=>$p['profile'],
		);
		$id = $tBand->insertGetId($data);
		
		if (!$id) {
			return Response::json(array(
				'status'=>0
			));
		} else {
			// save cover
			if (!empty($p['poster'])) {
				$this->savePicture($p['poster'], '/band/'.$id.'.jpg');
			}

			return Response::json(array(
				'status'=>1,
				'url'	=>url('band/'.$id)
			));
		}
		
	}
	
	public function detail($id)
	{
		$data['data'] = DB::table('band')->where('id', $id)->first();
		if (!empty($data['data'])) {
			$data['data']->cover = Config::get('app.picHost') . "/band/$id.jpg";
		}

		return View::make('band', $data);
	}

	public function editForm($id)
	{
		$data['countries'] = Countries::getList('en', 'php', 'icu');
		$data['data'] = (array)DB::table('band')->where('id', $id)->first();
		if (!empty($data['data'])) {
			$data['data']['cover'] = Config::get('app.picHost') . "/band/$id.jpg";
		}
		return View::make('bandCreate', $data);
	}
	
	public function edit()
	{
		// p for post
		$p = Input::all();

		$tBand = DB::table('band');
		$data = array(
			'name'		=>$p['name'],
			'region'	=>$p['region'],
			'homepage'	=>$p['homepage'],
			'facebook'	=>$p['facebook'],
			'bandcamp'	=>$p['bandcamp'],
			'twitter'	=>$p['twitter'],
			'soundcloud'	=>$p['soundcloud'],
			'profile'	=>$p['profile'],
			'update_time'	=>date('Y-m-d H:i:s')
		);
		$rs = $tBand->where('id', $p['id'])->update($data);

		if (!$rs) {
			return Response::json(array(
				'status'=>0
			));
		} else {
			if (!empty($p['poster'])) {
				$this->savePicture($p['poster'], '/band/'.$p['id'].'.jpg');
			}
			return Response::json(array(
				'status'=>1,
				'url'	=>url('band/'.$p['id'])
			));
		}
	}
}
