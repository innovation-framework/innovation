<?php
/**
 * This is init file of application
 */

// Start session
ob_start();
session_start();

// Define App Root directory constant
define('APP_ROOT', __DIR__);

// Load library
require_once APP_ROOT . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'bootstrap.php';


// Bootstarp application
$app = require_once __DIR__.'/bootstrap/app.php';

// Include routes
require 'routes.php';