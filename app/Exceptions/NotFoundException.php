<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    /**
     * Create a new authentication exception.
     *
     * @param  string  $message
     * @param  int $code
     * @return void
     */
    public function __construct($message = 'Not Found.')
    {
        parent::__construct($message);
    }
}
