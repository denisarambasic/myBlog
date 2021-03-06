<?php

use MyBlog\Helpers\Route;

$routes = new Route();

/*=== Homepage routes ===*/
$routes->setRoute('GET', '/', 'HomepageController', 'index', []);

/*=== Articles routes ===*/
$routes->setRoute('GET', '/articles', 'ArticleController', 'index', []);
$routes->setRoute('GET', '/articles/count', 'ArticleController', 'getCount', []);
$routes->setRoute('GET', '/articles', 'ArticleController', 'getById', ['id']);
$routes->setRoute('GET', '/articles/page', 'ArticleController', 'getPerPage', ['pageNumber']);

/*=== User article routes ===*/
$routes->setRoute('GET', '/my-articles', 'UserController', 'index', []);
$routes->setRoute('GET', '/my-articles/create', 'UserController', 'createArticleInfo', []);
$routes->setRoute('POST', '/my-articles/create', 'UserController', 'createArticle', []);
$routes->setRoute('OPTIONS', '/my-articles/create', 'UserController', 'createArticle', []);
$routes->setRoute('DELETE', '/my-articles/delete', 'UserController', 'deleteArticle', ['id']);
$routes->setRoute('OPTIONS', '/my-articles/delete', 'UserController', 'deleteArticle', ['id']);

$routes->setRoute('PUT', '/my-articles/update', 'UserController', 'updateArticle', ['id']);
$routes->setRoute('OPTIONS', '/my-articles/update', 'UserController', 'updateArticle', ['id']);

$routes->setRoute('OPTIONS', '/my-articles', 'UserController', 'index', []);
$routes->setRoute('GET', '/check-user', 'UserController', 'checkUser', []);
$routes->setRoute('OPTIONS', '/check-user', 'UserController', 'checkUser', []);

/*=== Register routes ===*/
$routes->setRoute('GET', '/register', 'RegisterController', 'index', []);
$routes->setRoute('POST', '/register', 'RegisterController', 'formData', []);

/*=== Login routes ===*/
$routes->setRoute('GET', '/login', 'LoginController', 'index', []);
$routes->setRoute('POST', '/login', 'LoginController', 'formData', []);

/*=== Call the controller if the request match an existing route ===*/
$routes->callController();