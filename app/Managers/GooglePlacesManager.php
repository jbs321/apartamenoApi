<?php
namespace App\Managers;

use app\Traits\GuzzleHttpClientTrait;
use App\Types\GooglePlacesResponse;
use Exception;

/**
 * Class GooglePlacesManager
 * @Documentation Google Places API - https://developers.google.com/places/web-service/search
 */
class GooglePlacesManager
{
	use GuzzleHttpClientTrait;

    const BASE_URI = "https://maps.googleapis.com/maps/api/place/textsearch";

    protected $appKey;


	/**
	 * GooglePlacesManager constructor.
	 *
	 * @param string $appKey
	 *
	 * @throws Exception
	 */
    public function __construct($appKey)
    {
        $this->client = new Client();
        $this->appKey = $appKey;
    }

	/**
	 * @param string $query
	 *
	 * @return GooglePlacesResponse
	 */
    public function findAddressByQuery(string $query)
    {
        $fullQuery = $this->makeApiQuery($query);

        try{
            $googleResponse = $this->client->get($fullQuery)->getBody();
        } catch (Exception $te) {
            abort(500, "Technical Issue please contact System Admin");
        }

        $data = new GooglePlacesResponse($googleResponse);
        return $data;
    }

	/**
	 * @param string $query
	 * @param string $returnType
	 *
	 * @return string
	 */
    public function makeApiQuery($query = "", $returnType = GooglePlacesResponse::KEY__RESPONSE_TYPE_JSON)
    {
        $query = join("/", [self::BASE_URI, $returnType]) . "?key={$this->appKey}&query={$query}";
        return $query;
    }


}