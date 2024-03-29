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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

$config         = config(App\Config\Auth::class);
$reservedRoutes = $config->reservedRoutes;

$routes->get($reservedRoutes['login'], 'AuthController::login', ['as' => $reservedRoutes['login']]);
$routes->post($reservedRoutes['login'], 'AuthController::attemptLogin');
$routes->post($reservedRoutes['logout'], 'AuthController::logout');

$routes->group('', ['filter' => 'login'], function ($routes) {

    $routes->get('/', 'Home::index');

    $routes->group('', ['filter' => 'permission:developer-module'], function ($routes) {
        $routes->get('dashboard', 'Home::dashboard');
        
        $routes->get('company/datatables', 'Company::datatables');
        $routes->resource('company');
        
        $routes->get('store/datatables', 'Store::datatables');
        $routes->resource('store');

        $routes->resource('user');
        $routes->resource('group');
    });
    
    $routes->group('', ['filter' => 'permission:client-module'], function ($routes) {
    
        $routes->get('item/datatables', 'Item::datatables');
        $routes->get('item/item_datatable', 'Item::item_datatable');
        $routes->resource('item');

        $routes->get('group-item/datatables', 'GroupItem::datatables');
        $routes->resource('group-item', ['controller' => 'GroupItem']);
        
        $routes->get('warehouse/datatables', 'Warehouse::datatables');
        $routes->resource('warehouse');
        
        $routes->get('account/datatables', 'Account::datatables');
        $routes->resource('account');
        
        $routes->get('journal/datatables', 'Journal::datatables');
        $routes->resource('journal');
        
        $routes->get('journal/datatables', 'Journal::datatables');
        $routes->resource('journal');
        
        $routes->get('purchase/datatables', 'Purchase::datatables');
        $routes->get('purchase/(:any)/item', 'Purchase::getItem/$1');
        $routes->get('purchase/(:any)/purchase-detail', 'Purchase::purchaseDetail/$1');
        $routes->get('purchase/(:any)/purchase-detailPisan', 'Purchase::getPurchaseDetail/$1');
        $routes->get('purchase/(:any)/journal-detail', 'Purchase::journalDetail/$1');
        $routes->post('purchase/(:any)/check-stock', 'Purchase::checkStock/$1');
        $routes->resource('purchase');
        
        $routes->get('sale/datatables', 'Sale::datatables');
        $routes->get('sale/(:any)/item', 'Sale::getItem/$1');
        $routes->get('sale/(:any)/sales-detail', 'Sale::salesDetail/$1');
        $routes->get('sale/(:any)/journal-detail', 'Sale::journalDetail/$1');
        $routes->resource('sale');
        
        $routes->get('customer/datatables', 'Customer::datatables');
        $routes->resource('customer');
        $routes->get('vendor/datatables', 'Vendor::datatables');
        $routes->resource('vendor');
        
        $routes->get('report', 'Report::index');
    });

    $routes->get('transactions', 'Transaction::index');
});

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
