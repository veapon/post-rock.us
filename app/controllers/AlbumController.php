<?php
class AlbumController extends BaseController 
{
	public function index()
	{
		$data['data'] = DB::table('albumInfo')
			->orderBy('album_id', 'desc')
			->paginate(3);
		return View::make('albums', $data);
	}

	public function createForm()
	{
		$data = array();
		$data['countries'] = Countries::getList('en', 'php', 'icu');
		return View::make('albumCreate', $data);
	}

	public function create()
	{
		// p for post
		$p = Input::all();

		if ( empty($p['bands']) 
			|| !trim($p['album'])
			|| !trim($p['release'])
			|| !trim($p['cover'])
		) 
		{
			return Response::json(array(
				'status'=>0,
				'msg'	=>'It seems you forgot something...'
			));
			
		}

		$album = new Albums;
		$ab = new AlbumBand;
		
		// album-band info
		$albumInfo = $album
			->join('albumBand', 'album.id', '=', 'albumBand.album_id')
			->where('name', $p['album'])
			->get()
			->toArray();

		// album with same band_id exists
		if ($albumInfo && array_intersect($p['bands'], array_column($albumInfo, 'band_id'))) {
			return Response::json(array(
				'status'=>2,
				'id'	=>$albumInfo[0]['id']
			));
		}
		
		$album->name = $p['album'];
		$album->release_date = date('Y-m-d', strtotime($p['release']));
		$album->create_time = $album->update_time = date('Y-m-d H:i:s');
		$album->tracks = $p['tracks'];
		$album->save();

		// save failed
		if (empty($album['id'])) {
			return Response::json(array(
				'status'=>0,
			));
		}

		// rename cover
		$this->savePicture($p['cover'], '/album/'.$album['id'].'.jpg');

		// album-band relation
		$relData = array();
		foreach ($p['bands'] as $v) {
			$relData[] = array('band_id'=>$v, 'album_id'=>$album['id']);
		}
		$ab->insert($relData);

		// album tracks
		$tracks = explode("\r", $p['tracks']);
		if (isset($tracks[0])) {
			$values = array();
			$valueCnt = 0;
			foreach ($tracks as $t) {
				if (!empty(trim($t))) {
					$values = array_merge($values, array($t, $album->id, date('Y-m-d H:i:s')));
					$valueCnt++;
				}
			}

			if ($valueCnt > 0) {
				$sql = 'INSERT IGNORE INTO tracks (`title`,`album_id`,`create_time`) 
					VALUES '.substr(str_repeat(',(?,?,?)', $valueCnt), 1);
				DB::insert($sql, $values);
			}			
		}
	}
	
	public function detail($id)
	{
		$album = new Albums;
		$albumInfo = $album
			->selectRaw('album.name as album_name, album.id as album_id, album.release_date, album.tracks, band.name as band_name, band.id as band_id')
			->join('albumBand', 'albumBand.album_id', '=', 'album.id')
			->join('band', 'band.id', '=', 'albumBand.band_id')
			->where('album.id', '=', $id)
			->get()
			->toArray();

		// 404 not found
		if (!$albumInfo) {
		
		}

		$data['data'] = $albumInfo[0];
		unset($data['data']['band_id']);
		unset($data['data']['band_name']);

		// various artists
		if (isset($albumInfo[1])) {
			foreach ($albumInfo as $a) {
				$data['data']['bands'][] = array(
					'id'	=>$a['band_id'],
					'name'	=>$a['band_name']
				);
			}		
		} else {
			$data['data']['bands'][0] = array(
				'id'	=>$albumInfo[0]['band_id'],
				'name'	=>$albumInfo[0]['band_name']
			);
		}
		
		return View::make('album', $data);
	}

	public function editForm($id)
	{
		$data['countries'] = Countries::getList('en', 'php', 'icu');
		$data['data'] = DB::table('albumInfo')->where('album_id', $id)->first();
		return View::make('albumEdit', $data);
	}
	
	public function edit()
	{
		$data['countries'] = Countries::getList('en', 'php', 'icu');
		$data['data'] = DB::table('albumInfo')->where('album_id', $id)->first();
		return View::make('albumEdit', $data);
	}
}
