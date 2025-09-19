<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');

// Article routes
$routes->get('/article', 'Article::index');
$routes->get('/article/(:any)', 'Article::show/$1');
