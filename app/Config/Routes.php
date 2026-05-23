<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load system routes first
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
// FIX: remove unsupported method in your CI version
// $routes->setTranslateURIDashes(false);
$routes->set404Override();

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// HOME
$routes->get('/', 'Home::index');

// PUBLIC LOGIN
$routes->get('/login', 'Auth::login');
$routes->post('/process-login', 'Auth::processLogin');
$routes->get('/logout', 'Auth::logout');

//PROTECTED ROUTES
$routes->group('', ['filter' => 'auth'], function($routes) {

    // DASHBOARD
    $routes->get('/dashboard', 'Dashboard::index');

    //PROFILE MANAGEMENT (ALL ROLES)
        $routes->get('/profile', 'Users::profile');
        $routes->post('/profile/update', 'Users::updateProfile');
        $routes->get('/change-password', 'Users::changePassword');
        $routes->post('/change-password/update', 'Users::updatePassword');

    //TRANSACTIONS ROUTES
    $routes->get('/transactions', 'Transactions::index');
    $routes->get('/transactions/create', 'Transactions::create');
    $routes->post('/transactions/store', 'Transactions::store');

    $routes->get('/transactions/edit/(:num)', 'Transactions::edit/$1');
    $routes->post('/transactions/update/(:num)', 'Transactions::update/$1');

    $routes->get('/transactions/delete/(:num)', 'Transactions::delete/$1');
    
    //REPORT
    $routes->get('/reports/monthly', 'Reports::monthly');

    //BUDGETS ROUTES
    $routes->get('/budgets', 'Budgets::index');
    $routes->get('/budgets/create', 'Budgets::create');
    $routes->post('/budgets/store', 'Budgets::store');
    $routes->get('/budgets/edit/(:num)', 'Budgets::edit/$1');
    $routes->post('/budgets/update/(:num)', 'Budgets::update/$1');
    $routes->get('/budgets/delete/(:num)', 'Budgets::delete/$1');

    //BILLS ROUTES
    $routes->get('/bills', 'Bills::index');
    $routes->get('/bills/create', 'Bills::create');
    $routes->post('/bills/store', 'Bills::store');
    $routes->get('/bills/edit/(:num)', 'Bills::edit/$1');
    $routes->post('/bills/update/(:num)', 'Bills::update/$1');
    $routes->get('/bills/delete/(:num)', 'Bills::delete/$1');
    $routes->get('/bills/mark-paid/(:num)', 'Bills::markPaid/$1');
    $routes->get('/bills/mark-unpaid/(:num)', 'Bills::markUnpaid/$1');

    //SUPERADMIN-ONLY ROUTES
    $routes->group('', ['filter' => 'superadmin'], function($routes) {

        $routes->get('/users', 'Users::index');
        $routes->get('/users/create', 'Users::create');
        $routes->post('/users/store', 'Users::store');

        $routes->get('/users/edit/(:num)', 'Users::edit/$1');
        $routes->post('/users/update/(:num)', 'Users::update/$1');

        $routes->get('/users/delete/(:num)', 'Users::delete/$1');
        $routes->get('/users/reset-password/(:num)', 'Users::resetPassword/$1');

    });

});

/*
 * --------------------------------------------------------------------
 * ENVIRONMENT ROUTES
 * --------------------------------------------------------------------
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}