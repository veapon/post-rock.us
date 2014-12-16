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
		$data['countries'] = Countries::getList('en', 'php', 'icu');
		return View::make('albumCreate', $data);
	}

	public function create()
	{
		// p for post
		$p = Input::all();

		$artist = new Artist;
		$artInfo = $artist->where('name', $p['artist'])->first(array('id'));
		if (!isset($artInfo->id)) {
			$artist->name = $p['artist'];
			$artist->region = $p['region'];
			$artist->create_time = date('Y-m-d H:i:s');
			$artist->save();
		} else {
			$artist->id = $artInfo->id;
		}
		

		if (!isset($artist->id)) {
			die('error: aritst');
		}
		
		$album = new Album;
		$albumInfo = $album->where('artist_id', $artist->id)->where('name', $p['album'])->first(array('id'));
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
