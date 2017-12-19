<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class NotFoundException extends Exception
{

    public function report()
    {
    }

    public function render($request)
    {
        return new JsonResponse([
            "message" => "Not Found",
            "parameters" => $request->all()
        ], 204);
    }
}
