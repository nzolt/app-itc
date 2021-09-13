<?php


namespace App\Data\Validators\Exceptions;

use Throwable;

class InvalidDateException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Invalid DateTime string format', 1001, $previous);
    }
}