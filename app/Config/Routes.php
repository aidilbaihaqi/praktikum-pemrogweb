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

// Auth routes (only for guests)
$routes->group('', ['filter' => 'guest'], function($routes) {
    $routes->get('/login', 'Auth::login');
    $routes->post('/login', 'Auth::attemptLogin');
    $routes->get('/forgot-password', 'Auth::forgotPassword');
    $routes->post('/forgot-password', 'Auth::forgotPassword');
    $routes->get('/reset-password/(:segment)', 'Auth::resetPassword/$1');
    $routes->post('/reset-password/(:segment)', 'Auth::resetPassword/$1');
});

// Auth logout (accessible for authenticated users)
$routes->get('/logout', 'Auth::logout', ['filter' => 'auth']);

// Profile routes (only for authenticated users)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/profile', 'Profile::index');
    $routes->post('/profile', 'Profile::update');
    $routes->post('/profile/change-password', 'Profile::changePassword');
    $routes->delete('/profile/avatar', 'Profile::deleteAvatar');
});

// Dashboard routes (only for authenticated users)
$routes->group('dashboard', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('create', 'Dashboard::create');
    $routes->post('store', 'Dashboard::store');
    $routes->get('edit/(:num)', 'Dashboard::edit/$1');
    $routes->put('update/(:num)', 'Dashboard::update/$1');
    $routes->delete('delete/(:num)', 'Dashboard::delete/$1');
    $routes->post('toggle-status/(:num)', 'Dashboard::toggleStatus/$1');
});

// Test route for session debugging (accessible for everyone)
$routes->get('/test-session', function() {
    return view('test_session');
});
