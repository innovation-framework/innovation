<?php
/**
 * This file will permit we config all url|route of this application
 */
use Light\Router as Route;
$route = new Route;

/**
 * This is api routes group
 */
$route->add('api/user', ['controller' => 'Api\User', 'action' => 'index']);
$route->add('api/user/signup', ['controller' => 'Api\User', 'action' => 'signup']);
$route->add('api/user/signin', ['controller' => 'Api\User', 'action' => 'signin']);
$route->add('api/user/logout', ['controller' => 'Api\User', 'action' => 'logout']);

/**
 * This is url for UI group
 */
$route->add('home/index', ['controller' => 'Home', 'action' => 'index']);


/**
 * Transformer all errors -> json
 */
try {
    $route->dispatch($_SERVER['QUERY_STRING']);
} catch (Exception $e) {
    header('Content-Type: application/json');
    $errors = [
        'error' => ['message' => $e->getMessage()],
        'code' => $e->getCode()
    ];
    echo json_encode($errors);
}