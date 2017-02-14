<?php

use Zend\Mvc\Application;
use Zend\Stdlib\ArrayUtils;

ini_set('display_errors', 'on');

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
  if (__FILE__ !== $path && is_file($path)) {
    return false;
  }
    unset($path);
}

// Composer autoloading
include __DIR__ . '/../vendor/autoload.php';

/*
if (class_exists(SpaceIdle::class) == false) {
    throw new RuntimeException("Unable to load SpaceIdle application.\n");
}
 */

// Retrieve configuration
$appConfig = require __DIR__ . '/../config/application.config.php';
if (file_exists(__DIR__ . '/../config/development.config.php')) {
    $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/../config/development.config.php');
}

// Set up DB adpater
// $adapter = new Zend\Db\Adapter\Adapter($appConfig['db_dsn']);


// Run the application!
Application::init($appConfig)->run();
