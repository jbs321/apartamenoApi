<?php

namespace App\Http\Controllers;

use App\Building;
use App\Exceptions\NotFoundException;
use GooglePlacesAPI\Facades\GooglePlacesApi;
use GooglePlacesAPI\Types\GooglePlacesResponse;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    public function findBuildingByAddressQuery($query)
    {
        $result = GooglePlacesApi::findAddressByQuery($query);

        if($result->getStatus() !== GooglePlacesResponse::STATUS_TYPE__OK) {
            throw new NotFoundException();
        }

        /** @var GoogleResult $firstResult */
        $firstResult = $result->getResults()->first();

        /** @var  $building */
        $building = Building::firstOrCreate([
        	'google_place_id' => $firstResult->getPlaceId(),
	        'user_id'         => 1,
	        'address'         => $firstResult->getFormattedAddress(),
        ]);

        return new JsonResponse($building);
    }
}
