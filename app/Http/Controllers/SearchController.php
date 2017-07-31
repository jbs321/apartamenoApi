<?php

namespace App\Http\Controllers;

use App\Building;
use App\Exceptions\NotFoundException;
use App\Managers\GooglePlacesManager;
use App\Types\GooglePlacesResponse;
use App\Types\GoogleResult;
use Exception;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    /** @var GooglePlacesManager  $gp*/
    protected $gp;

    public function __construct(GooglePlacesManager $gp) {

        if(!isset($gp)) {
            throw new Exception("Google Places Instance isn't set");
        }

        $this->gp = $gp;
    }

    public function findBuildingByAddressQuery($query)
    {
        $result = $this->gp->findAddressByQuery($query);

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
