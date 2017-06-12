<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'buildings';

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = true;

	/**
	 * Get the comments for the blog post.
	 */
	public function comments()
	{
		return $this->hasMany('App\Comment');
	}
}
