<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidUserException extends Exception {

	public function report() {
		//Here you can send an email to report a bug
	}

	public function render( $request ) {
		return new JsonResponse( [
			"code"    => 400,
			"message" => "Bad Request, User has no permission to update this resource",
			"parameters" => $request->all()
		], 400 );
	}
}
