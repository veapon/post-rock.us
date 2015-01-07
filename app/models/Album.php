<?php
class Album extends \LaravelBook\Ardent\Ardent 
{
	public $timestamps = false;
	public $autoPurgeRedundantAttributes = true;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'albums';

}
