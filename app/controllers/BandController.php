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
		
		$data = array(
			'name'		=>$p['name'],
			'create_time'	=>date('Y-m-d H:i:s'),
			'update_time'	=>date('Y-m-d H:i:s'),
			'region'	=>$p['region'],
			'homepage'	=>$p['homepage'],
			'facebook'	=>$p['facebook'],
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
