<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class NotFoundException extends Exception {

	public function report() {
		//Here you can send an email to report a bug
	}

	public function render( $request ) {
		return new JsonResponse( [
			"code"    => 404,
			"message" => "Not Found",
			"parameters" => $request->all()
		], 404 );
	}
}
