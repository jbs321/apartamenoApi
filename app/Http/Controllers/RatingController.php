<?php

namespace App\Http\Controllers;

use App\Building;
use App\Http\Requests\StoreRatingPost;
use App\RatingType;
use App\UserRating;
use Illuminate\Support\Collection;

class RatingController extends Controller {

	/**
	 * create new user rating
	 *
	 * @param StoreRatingPost $request
	 *
	 * @return bool
	 */
	public function store( StoreRatingPost $request ): bool {
		$userRating = [
			'building_id' => $request->get( "building_id" ),
			'user_id'     => $request->get( "user_id" ),
			'rating_id'   => $request->get( "rating_id" ),
		];

		//Validate that user didn't double rate
		if ( UserRating::where( $userRating )->first() !== null ) {
			throw new \InvalidArgumentException( 'Rate value has already been assigned' );
		}

		$userRating = new UserRating( $request->all() );
		$isSaved    = $userRating->save();

		return $isSaved;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Building $building
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( Building $building ) {
		$rtMap = [];

		//Get all Rate Types
		RatingType::all()->each( function ( RatingType $rt ) use ( &$rtMap ) {
			$rtMap[ $rt->id ] = [
				RatingType::KEY_DESCRIPTION => $rt->description,
				UserRating::KEY_RATE        => 0
			];
		} );

		/** @var Collection $userRatings */
		$userRatings = $building->userRatings;

		//Create array mapping for rates per building
		$userRatings->each( function ( UserRating $ur ) use ( &$rtMap ) {
			$rtMap[ $ur->rating_id ][ UserRating::KEY_RATE ] += $ur->rate;
		} );

		return $rtMap;
	}

	/**
	 * remove user rating
	 *
	 * @param StoreRatingPost $request
	 * @param UserRating $userRating
	 *
	 * @return bool
	 */
	public function update( StoreRatingPost $request, UserRating $userRating ): bool {
		$isUpdated = $userRating->update( [ UserRating::KEY_RATE => $request->rate ] );
		return $isUpdated;
	}

	/**
	 * remove user rating
	 *
	 * @param UserRating $userRating
	 *
	 * @return bool
	 */
	public function destroy( UserRating $userRating ): bool {
		$isDeleted = $userRating->delete();
		return $isDeleted;
	}
}
