<?php
class Album extends Eloquent 
{
	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'album';
}
