<?php

namespace App\Http\Controllers;

use Google\Facades\Google;

class GoogleController extends Controller
{
	public function showStreetViewImage($address = "",  $width = 640, $height = 250) {
		$imageBinary = Google::streetView()->findImageByAddress($address, $width, $height);
		return response($imageBinary)->header('Content-type', 'image/jpeg');
	}

	public function showStaticMapImage($address = "", $width = 640, $height = 640) {
		$imageBinary = Google::staticMaps()->findImageByAddress($address, $width, $height);
		return response($imageBinary)->header('Content-type', 'image/jpeg');
	}
}
