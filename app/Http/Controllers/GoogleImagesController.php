<?php

namespace App\Http\Controllers;

class GoogleImagesController extends Controller {
	const IMAGES_SIZE_WIDTH = 1600;
	const IMAGES_SIZE_HEIGHT = 300;

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $address = "" ) {
		$address  = urlencode( $address );
		$width    = self::IMAGES_SIZE_WIDTH;
		$height   = self::IMAGES_SIZE_HEIGHT;
		$base_uri = env( "APP_GOOGLE_STREET_BASE_URI" );

		$path  = "{$base_uri}?size={$width}x{$height}&location={$address}";
		$image = file_get_contents( $path );

		header( 'Content-type:image/jpeg' );

		if(!$image) {
			return response()->file(public_path() . "/img/not_found.jpg");
		}

		$fp = fopen( 'image.png', 'w+' );

		fputs( $fp, $image );
		fclose( $fp );
		echo $image;
	}
}
