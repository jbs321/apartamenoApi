<?php

namespace App\Http\Controllers;

use App\Building;
use App\Exceptions\NotFoundException;
use Google\Facades\Google;
use Google\Types\GooglePlacesResponse;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
	public function findBuildingByAddressQuery($query)
	{
		$result = Google::findAddressByQuery($query);

		if( $result->getStatus() !== GooglePlacesResponse::STATUS_TYPE__OK) {
			throw new NotFoundException();
		}

		/** @var GoogleResult $firstResult */
		$firstResult = $result->getResults()->first();

		/** @var Building $building */
		$building = Building::firstOrCreate([
			'google_place_id' => $firstResult->getPlaceId(),
			'user_id'         => 1,
			'address'         => $firstResult->getFormattedAddress(),
		]);

		$building->comments;
		$ratings = $building->findRatingsByBuilding();

		//TODO::this is wrong way to do it, ratings should be defined in the model as member of class
		$building->ratings = $building->ratings = $ratings;

		return new JsonResponse($building);
	}
}
