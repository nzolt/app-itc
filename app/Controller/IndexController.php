<?php

namespace App\Controller;

use App\Data\NameValidator;
use App\Data\Validators\Exceptions\InvalidDateException;
use App\Data\Validators\Exceptions\InvalidNameException;
use App\Services\RetrieveData;
use Josantonius\Session\Session;
use Nette\Http\RequestFactory;
use Jenssegers\Blade\Blade;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\Data\SessionManager;
use App\Data\DTOdateTime;

class IndexController
{
    protected $sessionManager;
    protected $dateError;
    protected $nameError;

    /**
     * IndexController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $_SESSION['time'] = [];
    }

    /**
     * Genrate initial page
     * @return array
     */
    public function index()
    {
        $list = new RetrieveData();
        $data = $list->getData();var_export($data);
        return ['data' => $data];
    }

    /**
     * @param $id
     */
    public function details($id)
    {
        $list = new RetrieveData('detail', $id);
        $data = $list->getData();
        return ['data' => $data];
    }
}