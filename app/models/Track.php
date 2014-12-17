<?php
class Track extends Eloquent 
{
	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'track';

	public static function insertIgnore(array $tracks)
	{
		$track = new static();
		$sql = 'INSERT IGNORE INTO '.$track->getTable().' (`title`,`album_id`,`artist_id`,`create_time`) 
			VALUES '.substr(str_repeat(',(?,?,?,?)', count($tracks)), 1);
		//var_dump($sql);
		DB::insert($sql, $tracks);
	}
}
