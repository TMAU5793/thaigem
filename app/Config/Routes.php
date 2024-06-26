<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Home::index');
//$routes->get('(:any)', 'Home::relink');
$routes->get('lang/{locale}', 'Language::index');


//Admin path
$routes->get('admin', 'Admin/User::index');
$routes->get('admin/dashboard/', 'Admin/Dashboard::index', ['filter' => 'auth']);
$routes->get('admin/account/', 'Admin/Account::index', ['filter' => 'auth']);
$routes->get('admin/articles/', 'Admin/Articles::index', ['filter' => 'auth']);
$routes->get('admin/member/', 'Admin/Member::index', ['filter' => 'auth']);
$routes->get('admin/productcategory/', 'Admin/Productcategory::index', ['filter' => 'auth']);
$routes->get('admin/business/', 'Admin/Business::index', ['filter' => 'auth']);

$routes->match(['get', 'post'], 'admin/login', 'Admin/User::login', ['filter' => 'noauth']);
$routes->get('admin/logout', 'Admin/User::logout');

//Account path
$routes->get('account/login', 'Account/Account::index',['filter' => 'memberAuth']);
$routes->match(['get', 'post'],'account', 'Account/Account::index',['filter' => 'memberAuth']);
$routes->get('account/event', 'Account/Event::index',['filter' => 'memberAuth']);
$routes->get('account/form', 'Account/Accountform::index',['filter' => 'memberAuth']);
$routes->get('account/form/event', 'Account/Accountform::event',['filter' => 'memberAuth']);
$routes->match(['get', 'post'],'account/form/download', 'Account/Accountform::downloadFiles',['filter' => 'memberAuth']);
$routes->match(['get', 'post'],'account/form/upload', 'Account/Accountform::uploadFiles',['filter' => 'memberAuth']);
$routes->get('account/invoice', 'Account/Invoice::index',['filter' => 'memberAuth']);
$routes->get('account/webboard', 'Account/Webboard::index',['filter' => 'memberAuth']);


$routes->match(['get', 'post'],'account/register', 'Account/Account::register');
$routes->post('account/login', 'Account/Account::login');
$routes->match(['get', 'post'],'loginfacebook', 'Account/Account::loginFacebook');
$routes->match(['get', 'post'],'logingoogle', 'Account/Account::loginGoogle');
$routes->get('account/logout', 'Account/Account::logout');

//Front path
$routes->get('price-update', 'Priceupdate::index');
$routes->get('help-center', 'Thaigem::heplCenter');
$routes->get('privacy', 'Thaigem::privacy');
$routes->get('terms', 'Thaigem::terms');
$routes->get('about/association-board', 'About::associationboard');
$routes->get('member/membership-process', 'Member::membershipProcess');

//Api path
$routes->post('amphureapi', 'Api/LocationApi::getAmphure');
$routes->post('districtapi', 'Api/LocationApi::getDistrict');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
