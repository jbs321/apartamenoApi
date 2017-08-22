<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatingType extends Model
{
	const KEY_DESCRIPTION = "description";

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'rating_type';

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
}
