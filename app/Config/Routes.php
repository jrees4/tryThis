<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// These redirects seem to break everything ;-; by parsing %5 into the url.
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');

// $routes->get('index', 'Home::index');

// Food list
$routes->get('food', 'Foods::index');
$routes->match(['get', 'post'], 'create', 'Foods::create');
$routes->get('index/food', 'Foods::index');
// $routes->addRedirect('index/food', 'Foods::index');
// Basket/List
$routes->get('list', 'Lists::index');
$routes->match(['get', 'post'], 'listcreate', 'Lists::create');
// $routes->addRedirect('lists', 'Lists::index');

$routes->get('list/(:segment)', 'Lists::delete/$1');
// $routes->post('foodAdd', 'Lists::foodAdd');
// $routes->post('public/foodAdd', 'Lists::foodAdd');
$routes->get('foodAdd/(:segment)', 'Lists::foodAdd/$1');
$routes->get('public/foodAdd/(:segment)', 'Lists::foodAdd/$1');
$routes->get('delete', 'Lists::delete');

$routes->addRedirect('index', 'home');
$routes->addRedirect('index/food', 'food');
$routes->addRedirect('index/create', 'food');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
