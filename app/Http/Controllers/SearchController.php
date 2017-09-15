<?php

namespace App\Http\Controllers;

use App\Building;
use App\Exceptions\NotFoundException;
use Google\Facades\Google;
use Google\Types\GooglePlacesResponse;
use Google\Types\GooglePlacesResult;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller {

	public function findAndCreateBuilding( $query ) {

		$result = Google::places()->findAddressByQuery( $query );

		if ( $result->getStatus() !== GooglePlacesResponse::STATUS_TYPE__OK ) {
			throw new NotFoundException();
		}

		/** @var GooglePlacesResult $firstResult */
		$firstResult = $result->getResults()->first();

		$building = Building::where( [
			'google_place_id' => $firstResult->getPlaceId(),
		] )->first();

		if ( ! is_null( $building ) ) {
			$building->update( [
				'user_id' => is_null( Auth::id() ) ? \UsersTableSeeder::VISITOR_ID : Auth::id(),
				'address' => $firstResult->getFormattedAddress(),
				'lat'     => $firstResult->getLat(),
				'lng'     => $firstResult->getLng(),
			] );
		} else {
			$building = new Building( [
				'user_id'         => is_null( Auth::id() ) ? \UsersTableSeeder::VISITOR_ID : Auth::id(),
				'address'         => $firstResult->getFormattedAddress(),
				'google_place_id' => $firstResult->getPlaceId(),
				'lat'             => $firstResult->getLat(),
				'lng'             => $firstResult->getLng(),
			] );
		}

		$building->save();

		$building->comments;
		$ratings = $building->findRatingsByBuilding();

		//TODO::this is wrong way to do it, ratings should be defined in the model as member of class
		$building->ratings = $building->ratings = $ratings;

		return new JsonResponse( $building );
	}
}
