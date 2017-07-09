<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;

class GooglePlacesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return new JsonResponse( [ "adasdas" ] );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $query = "" ) {
		$client   = new Client();
		$baseUri  = env( "APP_GOOGLE_PLACES_BASE_URL" );
		$appKey   = env( "APP_GOOGLE_PLACES_API_KEY" );
		$response = $client->get( "{$baseUri}?key={$appKey}&query={$query}" )->getBody();
		$data     = json_decode( $response, true );

		return new JsonResponse( $data );
	}
}
