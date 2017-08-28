<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;

class GoogleController extends Controller
{
	public function showStreetViewImage($address = "") {
		$imageBinary = Google::streetView()->findImageByAddress($address);
		return response($imageBinary)->header('Content-type', 'image/jpeg');
	}

	public function showStaticMapImage($address = "") {

	}
}
