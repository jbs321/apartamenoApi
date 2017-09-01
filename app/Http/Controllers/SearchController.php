<?php

namespace App\Http\Controllers;

use App\Building;
use App\Exceptions\NotFoundException;
use Google\Facades\Google;
use Google\Types\GooglePlacesResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
	public function findBuildingByAddressQuery($query)
	{
		$result = Google::places()->findAddressByQuery($query);

		if( $result->getStatus() !== GooglePlacesResponse::STATUS_TYPE__OK) {
			throw new NotFoundException();
		}

		/** @var GoogleResult $firstResult */
		$firstResult = $result->getResults()->first();

        $building = Building::where([
            'google_place_id' => $firstResult->getPlaceId(),
        ])->first();

        if($building->exists()) {
            $building->update([
                'user_id'         => is_null(Auth::id()) ? \UsersTableSeeder::VISITOR_ID : Auth::id(),
                'address'         => $firstResult->getFormattedAddress(),
            ]);
        } else {
            $building = new Building([
                'user_id'         => is_null(Auth::id()) ? \UsersTableSeeder::VISITOR_ID : Auth::id(),
                'address'         => $firstResult->getFormattedAddress(),
                'google_place_id' => $firstResult->getPlaceId(),
            ]);
        }

		/** @var Building $building */
		$building = Building::firstOrCreate([
			'google_place_id' => $firstResult->getPlaceId(),
			'user_id'         => is_null(Auth::id()) ? \UsersTableSeeder::VISITOR_ID : Auth::id(),
			'address'         => $firstResult->getFormattedAddress(),
		]);

		$building->comments;
		$ratings = $building->findRatingsByBuilding();

		//TODO::this is wrong way to do it, ratings should be defined in the model as member of class
		$building->ratings = $building->ratings = $ratings;

		return new JsonResponse($building);
	}
}
