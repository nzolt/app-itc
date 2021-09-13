<?php


namespace App\Data;

use Josantonius\Session\Session;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class SessionManager
{
    public function __construct(bool $init = true)
    {
    }

    /**
     * @param string $csrf
     */
    public function setCsrf(string $csrf): void
    {
        Session::set('CSRFT', $csrf);
    }

    /**
     * @return string|null
     */
    public function getCsrf(): ?string
    {
        return Session::get('CSRFT');
    }

    /**
     * @param array $date
     * @throws \Exception
     * @return void
     */
    public function addDate(array $date): void
    {
        $uuid1 = Uuid::uuid1();
        $uuid = $uuid1->toString();
        $dates = Session::get('dates');
        if(is_array($dates)){
            // Truncate Dates list if contains 100 or more elements
            if(count($dates) >= 100){
                $dates = array_slice($dates, 0, 99);
            }
        } else {
            $dates = [];
        }
        // Add new date to the beginning of list (Array)
        array_unshift($dates, $date);

        Session::set('dates', $dates);
    }

    /**
     * @return array|null
     */
    public function getDates(): ?array
    {
        return Session::get('dates');
    }
}