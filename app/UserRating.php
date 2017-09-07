<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRating
 * @package App
 */
class UserRating extends Model
{
	const KEY_RATE = "rate";

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'user_ratings';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'rating_id', 'rate', 'building_id'];

    public function ratingType()
    {
        return $this->belongsTo('App\RatingType', 'rating_id', 'id');
    }
}