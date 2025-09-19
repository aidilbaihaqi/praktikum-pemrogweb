<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
$routes->post('/contact', 'Home::submitContact');

// Article routes
$routes->get('/article', 'Home::article');
$routes->get('/article/(:any)', 'Home::articleDetail/$1');
