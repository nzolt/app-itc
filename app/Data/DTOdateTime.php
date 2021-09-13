<?php


namespace App\Data;

use App\Data\Validators\DateValidator;
use App\Data\Validators\NameValidator;
use App\Data\Validators\Exceptions\InvalidNameException;
use App\Data\Validators\Exceptions\InvalidDateException;

/**
 * Class DTOdateTime
 * @package App\Data
 */
class DTOdateTime
{
    protected $birthDate = '';
    protected $currentDate = '';
    protected $diffYears = 0;
    protected $diffDays = 0;
    protected $diffHours = 0;
    protected $name = '';

    /**
     * DTOdateTime constructor.
     * @param string $date
     * @param string $format
     * @throws \Exception
     */
    public function __construct($date, $name, string $format = 'Y/m/d H:i', string $currentDate = null)
    {
        if(DateValidator::validateDate($date, $format) && NameValidator::validateName($name)){
            if($currentDate == null){
                $current = new \DateTime();
            } else {
                $current = new \DateTime($currentDate);
            }

            $this->setCurrentDate($current->format($format));
            $birthDate = new \DateTime($date);
            $this->setBirthDate($birthDate->format($format));
            // Get dates difference
            $diff = $current->diff($birthDate);
            // Years
            $this->setDiffYears($diff->y);
            // Days
            $days = $diff->d;
            $days = $days + ($diff->y * 365);
            $this->setDiffDays(floor($days));
            // Hours
            $hours = $diff->h;
            $hours = $hours + ($diff->days*24);
            $this->setDiffHours(floor($hours));

            $this->setName($name);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    /**
     * @param string $birthDate
     */
    public function setBirthDate(string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getCurrentDate(): string
    {
        return $this->currentDate;
    }

    /**
     * @param string $currentDate
     */
    public function setCurrentDate(string $currentDate): void
    {
        $this->currentDate = $currentDate;
    }

    /**
     * @return int
     */
    public function getDiffYears(): int
    {
        return $this->diffYears;
    }

    /**
     * @param int $diffYears
     */
    public function setDiffYears(int $diffYears): void
    {
        $this->diffYears = $diffYears;
    }

    /**
     * @return int
     */
    public function getDiffDays(): int
    {
        return $this->diffDays;
    }

    /**
     * @param int $diffDays
     */
    public function setDiffDays(int $diffDays): void
    {
        $this->diffDays = $diffDays;
    }

    public function getHours()
    {
        return $this->getDiffHours();
    }

    /**
     * @return int
     */
    public function getDiffHours(): int
    {
        return $this->diffHours;
    }

    /**
     * @param int $diffHours
     */
    public function setDiffHours($hours): void
    {
        $this->diffHours = $hours;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Class vars to Array
     * @return array
     */
    public function __toArray()
    {
        return [
            'Name' => (string)$this->getName(),
            'Currentdate' => (string)$this->getCurrentDate(),
            'Birthdate' => (string)$this->getBirthDate(),
            'Years' => (string)$this->getDiffYears(),
            'Days' => (string)$this->getDiffDays(),
            'Hours' => (string)$this->getDiffHours(),
        ];
    }
}