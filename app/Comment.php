<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	protected $fillable = ['user_id', 'description', 'building_id'];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
