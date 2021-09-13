<?php


namespace App\Data\Validators;

use App\Data\Validators\Exceptions\InvalidDateException;

/**
 * Class DateValidator
 * @package App\Data
 */
class DateValidator
{
    /**
     * @param string $date
     * @param string $format
     * @return bool
     * @throws InvalidDateException
     */
    public static function validateDate($date, $format = 'Y/m/d H:i'): bool
    {
        if(strlen($date) == 10){
            $date = $date . ' 00:00';
        }

        if(self::validateFormat($date) && self::validateDateCreate($date, $format)){
            return true;
        } else {
            throw new InvalidDateException('The submited date is invalid!');
        }

        return false;
    }

    /**
     * @param string $date
     * @param string $format
     * @return bool
     * @throws InvalidDateException
     */
    protected static function validateDateCreate($date, string $format): bool
    {
        $bd = \DateTime::createFromFormat($format, $date);
        $cd = new \DateTime();
        if($bd->getTimestamp() > $cd->getTimestamp()){
            return false;
        }
        return ($bd && $bd->format($format) === $date);
    }

    /**
     * Validate string DateTime format "Y-m-d H:i:s"
     * @param string $date
     * @return bool
     */
    public static function validateFormat($date): ?bool
    {
        if (preg_match("/(\d{4})\/(\d{2})\/(\d{2}) (\d{2}):(\d{2})/", $date)) {
            return true;
        }

        return false;
    }
}