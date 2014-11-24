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

		$artist = Artist::where('name', $p['artist'])->first(array('id'));
		if (!isset($artist->id)) {
			$artist->name = $p['artist'];
			$artist->region = $p['region'];
			$artist->create_time = date('Y-m-d H:i:s');
			$artist->save();
		}

		if (!isset($artist->id)) {
			die('error: aritst');
		}
		
		$album = Album::where('artist_id', $artist->id)->where('name', $p['album'])->first(array('id'));
		if (!isset($album->id)) {
			$album->name = $p['album'];
			$album->artist_id = $artist->id;
			$album->release_date = date('Y-m-d', strtotime($p['release']));
			$album->create_time = date('Y-m-d H:i:s');
			$album->cover = $p['cover'];
			$album->save();
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

}
