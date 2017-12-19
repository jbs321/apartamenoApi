<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use Google\Facades\Google;
use Google\Types\GooglePlacesResponse;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller {
	public function showStreetViewImage( $address = "", $width = 640, $height = 250 ) {
		Log::error("XXXXXXXX: $address");

		$imageBinary = Google::streetView()->findImageByAddress( $address, $width, $height );

		return response( $imageBinary )->header( 'Content-type', 'image/jpeg' );
	}

	public function showStaticMapImage( $address = "", $width = 640, $height = 640 ) {
		Log::error("XXXXXXXX: $address");

		$imageBinary = Google::staticMaps()->findImageByAddress( $address, $width, $height );

		return response( $imageBinary )->header( 'Content-type', 'image/jpeg' );
	}

	public function searchPlace( $query ) {

		/** @var GooglePlacesResponse $result */
		$result = Google::places()->findAddressByQuery( $query );

		if ( ! $result->isFound() ) {
			throw new NotFoundException($query);
		}

		return $result->toArray();
	}
}
