<?php
namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Http\Response;

class GoogleImagesController extends Controller
{
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
	public function show( $address = "" ) {
		$path = "https://maps.googleapis.com/maps/api/streetview?size=600x300&location=" + "{$address}";
		$image = file_get_contents($path);
		$fp  = fopen('image.png', 'w+');

		fputs($fp, $image);
		fclose($fp);

		header('Content-type:image/jpeg');
		echo $image;
	}
}
