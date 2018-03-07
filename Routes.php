<?php

use MyBlog\Helpers\Route;

$routes = new Route();

/*=== Homepage routes ===*/
$routes->setRoute('GET', '/', 'HomepageController', 'index', []);


/*=== Call the controller if the request match an existing route ===*/
$routes->callController();