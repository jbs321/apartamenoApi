<?php

namespace App\Http\Controllers;

use Google\Facades\Google;

class GoogleController extends Controller
{
	public function showStreetViewImage($address = "") {
		$imageBinary = Google::streetView()->findImageByAddress($address);
		return response($imageBinary)->header('Content-type', 'image/jpeg');
	}

	public function showStaticMapImage($address = "") {
		$imageBinary = Google::staticMaps()->findImageByAddress($address);
		return response($imageBinary)->header('Content-type', 'image/jpeg');
	}
}
