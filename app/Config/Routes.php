<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
// $routes->setAutoRoute(true);
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->post('/logar', 'Logar::signin');

$routes->get('/mailteste', 'Home::mailTeste');
$routes->get('/', 'Home::index'); //,['filter' => 'authFilter']);
$routes->get('/services', 'Home::services');
$routes->get('/assinar/(:any)', 'Home::assinar/$1');
// $routes->get('/api', 'Home::api');
$routes->post('/api', 'Home::api'); //,['filter' => 'authFilter']);
$routes->post('/api/cep', 'Home::getCEP'); //,['filter' => 'authFilter']);
$routes->get('/minha-conta', 'MyAccount::index', ['filter' => 'authFilter']);
$routes->get('/minha-conta/assinaturas', 'MyAccount::assinaturas', ['filter' => 'authFilter']);
$routes->get('/minha-conta/assinatura/(:any)', 'MyAccount::assinatura/$1', ['filter' => 'authFilter']);
$routes->get('/minha-conta/cartao/(:any)', 'MyAccount::cartao/$1', ['filter' => 'authFilter']);
$routes->get('/minha-conta/cartoes', 'MyAccount::cartoes', ['filter' => 'authFilter']);
$routes->get('/minha-conta/pet/(:any)', 'MyAccount::pet/$1', ['filter' => 'authFilter']);
$routes->get('/minha-conta/meus-pets', 'MyAccount::pets', ['filter' => 'authFilter']);
$routes->get('/minha-conta/meus-dados', 'MyAccount::account', ['filter' => 'authFilter']);
$routes->post('/minha-conta/pet/save', 'MyAccount::savePet', ['filter' => 'authFilter']);
$routes->post('/minha-conta/pet/remover', 'MyAccount::removePet', ['filter' => 'authFilter']);
$routes->post('/minha-conta/user/save', 'MyAccount::saveMyData', ['filter' => 'authFilter']);
$routes->post('/minha-conta/user/np/save', 'MyAccount::saveNewPass', ['filter' => 'authFilter']);

$routes->post('/register', 'RegisterController::store');
$routes->post('/check-cEmail', 'RegisterController::checkCustomerMail');
$routes->post('/check-code', 'RegisterController::code_verify');
// $routes->post('/api', 'Home::index');

$routes->get("/minha-conta/login", 'MyAccount::login');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
