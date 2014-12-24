<?php
class Album extends \LaravelBook\Ardent\Ardent
{
	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'album';

}
