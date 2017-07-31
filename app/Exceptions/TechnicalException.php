<?php

namespace App\Exceptions;

use Exception;

class TechnicalException extends Exception
{
    /**
     * Create a new authentication exception.
     *
     * @param  string  $message
     * @param  int $code
     * @return void
     */
    public function __construct($message = 'Technical Exception')
    {
        parent::__construct($message);
    }
}
