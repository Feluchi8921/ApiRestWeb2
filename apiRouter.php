<?php
require_once './libs/router.php';
require_once './app/controllers/viajeApiController.php';
require_once './app/controllers/automovilApiController.php';
require_once './app/controllers/authApiController.php';

//Crea el router
$router = new Router();

//Tabla de ruteo
//----------------------------Tabla Viajes --------------------//
$router->addRoute('viajes', 'GET', 'viajeApiController', 'getViajes');
$router->addRoute('viajes/:ID', 'GET', 'viajeApiController', 'getViaje');
$router->addRoute('viajes/:ID', 'DELETE', 'viajeApiController', 'deleteViaje');
$router->addRoute('viajes', 'POST', 'viajeApiController', 'insertViaje'); 
$router->addRoute('viajes/:ID', 'PUT', 'viajeApiController', 'editViaje');
//----------------------------Tabla Automoviles --------------------//
$router->addRoute('automoviles', 'GET', 'automovilApiController', 'getAutomoviles');
$router->addRoute('automoviles/:ID', 'GET', 'automovilApiController', 'getAutomovil');
$router->addRoute('automoviles/:ID', 'DELETE', 'automovilApiController', 'deleteAutomovil');
$router->addRoute('automoviles', 'POST', 'automovilApiController', 'insertAutomovil');
$router->addRoute('automoviles/:ID', 'PUT', 'automovilApiController', 'editAutomovil'); 
//----------------------------Autenticacion --------------------//
$router->addRoute("auth/token", 'GET', 'authApiController', 'getToken');

//Ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);