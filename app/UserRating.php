<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'user_ratings';

    public function ratingType()
    {
        return $this->belongsTo('App\RatingType', 'rating_id', 'id');
    }
}
