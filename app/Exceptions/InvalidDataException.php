<?php

namespace App\Exceptions;

use Throwable;

class InvalidDataException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'Data error';
        parent::__construct($message, $code, $previous);
    }
}