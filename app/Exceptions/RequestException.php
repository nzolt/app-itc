<?php

namespace App\Exceptions;

use Throwable;

class RequestException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'Error during request';
        parent::__construct($message, $code, $previous);
    }
}