<?php
session_set_cookie_params(3600);
session_start();
// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

use Bramus\Router\Router;
use Nette\Http\RequestFactory;
use App\Controller\IndexController;
use Jenssegers\Blade\Blade;

// Load config from .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Create Request instance
$factory = new RequestFactory;
$request = $factory->fromGlobals();
// Create Router instance
$router = new Router();
$controller = new IndexController();
// Create template engine
$blade = new Blade(__DIR__ . '/../views', 'cache');
$router->setNamespace('\App\Controllers');
// Define routes authentication
// Define routes
$router->get('/', function() use($controller, $blade) {
    //echo 'Welcome!<br/> <a href="/oldhours">Get hours</a>';
    echo $blade->make('list', $controller->index())->render();
});
$router->get('/list/', function() use($controller, $blade) {
    //echo 'Welcome!<br/> <a href="/oldhours">Get hours</a>';
    echo $blade->make('list', $controller->index())->render();
});
$router->get('/details/{id}', function($id) use($controller, $blade) {
    //echo 'Welcome!<br/> <a href="/oldhours">Get hours</a>';
    echo $blade->make('detail', $controller->details($id))->render();
});
// Run it!
$router->run();