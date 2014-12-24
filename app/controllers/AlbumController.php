<?php
class AlbumController extends BaseController 
{
	public function index()
	{
		$data['data'] = DB::table('albumInfo')->paginate(3);
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
		) 
		{
			return Response::json(array(
				'status'=>0,
				'msg'	=>'It seems you forgot something...'
			));
			
		}

		$album = new Album;
		$ab = new AlbumBand;
		
		// album-band info
		$albumInfo = $album
			->join('AlbumBand', 'Album.id', '=', 'AlbumBand.album_id')
			->where('name', $p['album'])
			->get();
		var_dump($albumInfo);

		// album with same band_id exists
		if ($albumInfo && array_intersect($p['bands'], array_colum($albumInfo, 'band_id'))) {
			return Response::json(array(
				'status'=>2,
				'id'	=>$albumInfo[0]->id
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
		$this->savePicture($p['poster'], '/album/'.$id.'.jpg');

		// album-band relation
		

		/*
		if (!isset($albumInfo->id)) {
			$cover = '/album/' . uniqid() . '.' . getExt($p['cover']);
			$album->name = $p['album'];
			$album->artist_id = $artist->id;
			$album->release_date = date('Y-m-d', strtotime($p['release']));
			$album->create_time = date('Y-m-d H:i:s');
			$album->cover = $cover;
			$album->tracks = $p['tracks'];
			$album->save();
			$this->savePicture($p['cover'], $cover);
		} else {
			$album->id = $albumInfo->id;
		}

		if (!isset($album->id)) {
			die('error: album');
		}

		$tracks = explode("\r", $p['tracks']);
		if (isset($tracks[0])) {
			$values = array();
			$valueCnt = 0;
			foreach ($tracks as $t) {
				if (!empty(trim($t))) {
					$values = array_merge($values, array($t, $album->id, $artist->id, date('Y-m-d H:i:s')));
					$valueCnt++;
				}
			}

			if ($valueCnt > 0) {
				$track = new Track;
				$sql = 'INSERT IGNORE INTO '.$track->getTable().' (`title`,`album_id`,`artist_id`,`create_time`) 
					VALUES '.substr(str_repeat(',(?,?,?,?)', $valueCnt), 1);
				DB::insert($sql, $values);
			}			
		}
		 */
	}
	
	public function detail($id)
	{
		$data['data'] = DB::table('albumInfo')->where('album_id', $id)->first();

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
