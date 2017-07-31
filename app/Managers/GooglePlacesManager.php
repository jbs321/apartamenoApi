<?php
namespace App\Managers;

use App\Exceptions\TechnicalException;
use App\Types\GooglePlacesResponse;
use GuzzleHttp\Client as Client;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class GooglePlacesManager
 * @Documentation Google Places API - https://developers.google.com/places/web-service/search
 */
class GooglePlacesManager
{
    const BASE_URI = "https://maps.googleapis.com/maps/api/place/textsearch";



    protected $appKey;
    protected $client;

    public function __construct()
    {
        $this->client = new Client();

        if (!config("app.app_google_places_api_key")) {
            throw new Exception("Google Places App key is missing");
        }

        $this->appKey = config("app.app_google_places_api_key");
    }

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

    public function makeApiQuery($query = "", $returnType = GooglePlacesResponse::KEY__RESPONSE_TYPE_JSON)
    {
        $query = join("/", [self::BASE_URI, $returnType]) . "?key={$this->appKey}&query={$query}";
        return $query;
    }
}