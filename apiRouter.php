<?php
require_once './libs/router.php';
require_once './app/controllers/viajeApiController.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('viajes', 'GET', 'viajeApiController', 'getViajes');
$router->addRoute('viajes/:ID', 'GET', 'viajeApiController', 'getViaje');
$router->addRoute('viajes/:ID', 'DELETE', 'viajeApiController', 'deleteViaje');
$router->addRoute('viajes', 'POST', 'viajeApiController', 'insertViaje'); 

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);