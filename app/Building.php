<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
	use SoftDeletes;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['address', 'user_id', 'google_place_id'];


	protected $primaryKey = 'id';

    /**
     * Get the comments for the Building.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the comments for the Building.
     */
    public function userRatings()
    {
        return $this->hasMany('App\UserRating');
    }

	/**
	 * Sum Up the Ratings for Building and return array
	 * @return array
	 */
	public function findRatingsByBuilding() {
		$ratingTypes = RatingType::all();
		$ratings  = [];
		foreach ($ratingTypes as $ratingType) {
			$ratingTypeId = $ratingType->id;
			$ratingSum = UserRating::all()
			                     ->where('rating_id' , $ratingTypeId)
			                     ->where('building_id' , $this->getKey('id'))
			                     ->sum(function ($userRating) {
			                     	return $userRating->rate;
			                     });

			$ratings[] = ['description' => $ratingType->description, 'sum' => $ratingSum, 'rating_id' => $ratingTypeId];
		}

		return $ratings;
    }

	/**
	 * Get the User who create this building post
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];
}
