<?php

require_once(__DIR__ . '/vendor/autoload.php');

$routes = [];

/**
 * Bind the action handler to Controller's method.
 */
function route(string $action, string $controller, string $method)
{

    global $routes;
    $routes[$action] = [
        'controller' => $controller,
        'method' => $method
    ];
}

/**
 * Function to fire controller method.
 */
function dispatch(string $action)
{
    global $routes,$twig;

    //collect all params in one params
    $requestParams = array_merge($_GET, $_POST, $_SERVER);


    if (!isset($routes[$action])) {
        throw new Exception('Route does not exist.');
    }
    $controllerName = "App\\Controllers\\" .  $routes[$action]['controller'];

    if (!class_exists($controllerName)) {
        throw new Exception('Controller does not exist.');
    }
    $method =  $routes[$action]['method'];

    $controller = new $controllerName($requestParams,$twig);
    $controller->$method();
}

$action = explode('/',$_SERVER['REQUEST_URI'])[2];


require_once(__DIR__ .'/routes.php');


dispatch($action);
