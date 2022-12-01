<?php
require_once './libs/router.php';
require_once './app/controllers/bikeApiController.php';


// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('bikes', 'GET', 'bikeApiController', 'getBikes');
$router->addRoute('bikes/:ID', 'GET', 'bikeApiController', 'getBike');
$router->addRoute('bikes/:ID', 'DELETE', 'bikeApiController', 'deleteBike');
$router->addRoute('bike', 'POST', 'bikeApiController', 'insertBike'); 
$router->addRoute('bikes/:ID', 'PUT', 'bikeApiController', 'editBike');

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);