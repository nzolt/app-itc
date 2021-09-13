<?php


namespace App\Data\Validators;


use App\Data\Validators\Exceptions\InvalidNameException;

/**
 * Class NameValidator
 * @package App\Data
 */
class NameValidator
{
    /**
     * @param string $name
     * @return bool
     * @throws InvalidNameException
     */
    public static function validateName($name): bool
    {
        if (preg_match("/^[a-zA-Z ?.]*$/", $name) && $name != '' && strlen($name) <= 64) {
            return true;
        } else {
            throw new InvalidNameException();
        }

        return false;
    }
}
