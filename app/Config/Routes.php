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
$routes->get('/artikel', 'Article::index');
$routes->get('/artikel/cari', 'Article::search');
$routes->get('/artikel/kategori/(:segment)', 'Article::category/$1');
$routes->get('/artikel/(:segment)', 'Article::show/$1');
