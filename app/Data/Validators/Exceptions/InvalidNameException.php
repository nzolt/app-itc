<?php


namespace App\Data\Validators\Exceptions;

use Throwable;

class InvalidNameException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Invalid name format. Can\'t contain special caracters and can not be empty!', 1002, $previous);
    }
}