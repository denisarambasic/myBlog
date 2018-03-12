<?php

use MyBlog\Helpers\Route;

$routes = new Route();

/*=== Homepage routes ===*/
$routes->setRoute('GET', '/', 'HomepageController', 'index', []);

/*=== Articles routes ===*/
$routes->setRoute('GET', '/articles', 'ArticleController', 'index', []);
$routes->setRoute('GET', '/articles', 'ArticleController', 'getById', ['id']);
$routes->setRoute('GET', '/articles/page', 'ArticleController', 'getPerPage', ['pageNumber']);

/*=== Register routes ===*/
$routes->setRoute('GET', '/register', 'RegisterController', 'index', []);
$routes->setRoute('POST', '/register', 'RegisterController', 'formData', []);

/*=== Login routes ===*/
$routes->setRoute('GET', '/login', 'LoginController', 'index', []);
$routes->setRoute('POST', '/login', 'LoginController', 'formData', []);

/*=== Call the controller if the request match an existing route ===*/
$routes->callController();