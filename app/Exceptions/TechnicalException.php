<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class TechnicalException extends Exception
{
	public function report() {
		//Here you can send an email to report a bug
	}


	public function render( $request ) {
		return new JsonResponse( [
			"code"    => 500,
			"message" => "Technical Error",
		], 500 );
	}
}
