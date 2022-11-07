<?php
require_once './libs/router.php';
require_once './app/controllers/viajeApiController.php';
require_once './app/controllers/automovilApiController.php';
require_once './app/controllers/authApiController.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('viajes', 'GET', 'viajeApiController', 'getViajes');
$router->addRoute('viajes/:ID', 'GET', 'viajeApiController', 'getViaje');
$router->addRoute('viajes/:ID', 'DELETE', 'viajeApiController', 'deleteViaje');
$router->addRoute('viajes', 'POST', 'viajeApiController', 'insertViaje'); 
$router->addRoute('automoviles', 'GET', 'automovilApiController', 'getAutomoviles');
$router->addRoute('automoviles/:ID', 'GET', 'automovilApiController', 'getAutomovil');
$router->addRoute('automoviles/:ID', 'DELETE', 'automovilApiController', 'deleteAutomovil');
$router->addRoute('automoviles', 'POST', 'automovilApiController', 'insertAutomovil'); 
$router->addRoute("auth/token", 'GET', 'AuthApiController', 'getToken');

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);