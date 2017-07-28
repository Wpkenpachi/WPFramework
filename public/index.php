<?php

// Includes and Requies
require __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../App/config.php';
// ==

// Instance of the Framework
$app = new Framework\Core;

// Routes
include __DIR__ . '/../App/routes.php';


// Running the application
$app->run();



