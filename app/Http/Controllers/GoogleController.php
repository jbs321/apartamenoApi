<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;

class GoogleController extends Controller
{
	public function index() {
		$client = new Client(); //GuzzleHttp\Client

		$response = $client->get('https://maps.googleapis.com/maps/api/place/textsearch/json?key=AIzaSyC8MNTUqpiblJMTFaAhndAL_nVS8axPEqc&query=vancouver');

		$data = $response->getBody();
		$data = json_decode($data, true);

		return new JsonResponse($data);

	}
}
