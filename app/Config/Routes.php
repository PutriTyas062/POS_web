<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Dashboard
$routes->get('/', 'Home::index');

// Auth
$routes->get('/auth', 'Auth::index');
$routes->get('/auth/login', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');

// Kasir (POS)
$routes->get('/kasir', 'Kasir::index');
$routes->post('/kasir/add-item', 'Kasir::addItem');
$routes->post('/kasir/remove-item', 'Kasir::removeItem');
$routes->get('/kasir/get-cart', 'Kasir::getCart');
$routes->post('/kasir/checkout', 'Kasir::checkout');
$routes->get('/kasir/categories', 'Kasir::getCategories');
$routes->get('/kasir/products-by-category', 'Kasir::getProductsByCategory');

// Riwayat
$routes->get('/riwayat', 'Riwayat::index');
$routes->get('/riwayat/detail/(:num)', 'Riwayat::detail/$1');

// Products (Admin)
$routes->get('/products', 'Products::index');
$routes->get('/products/create', 'Products::create');
$routes->post('/products/store', 'Products::store');
$routes->get('/products/edit/(:num)', 'Products::edit/$1');
$routes->post('/products/update/(:num)', 'Products::update/$1');
$routes->get('/products/delete/(:num)', 'Products::delete/$1');
$routes->post('/products/toggle-status/(:num)', 'Products::toggleStatus/$1');

// Expenses (Admin)
$routes->get('/expenses', 'Expenses::index');
$routes->get('/expenses/create', 'Expenses::create');
$routes->post('/expenses/store', 'Expenses::store');
$routes->get('/expenses/edit/(:num)', 'Expenses::edit/$1');
$routes->post('/expenses/update/(:num)', 'Expenses::update/$1');
$routes->get('/expenses/delete/(:num)', 'Expenses::delete/$1');

// Users (Admin)
$routes->get('/users', 'Users::index');
$routes->get('/users/create', 'Users::create');
$routes->post('/users/store', 'Users::store');
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->post('/users/update/(:num)', 'Users::update/$1');
$routes->get('/users/delete/(:num)', 'Users::delete/$1');
$routes->post('/users/toggle-status/(:num)', 'Users::toggleStatus/$1');

// Settings (Admin)
$routes->get('/settings', 'Settings::index');
$routes->post('/settings/save', 'Settings::save');
$routes->post('/settings/backup', 'Settings::backup');
$routes->post('/settings/restore', 'Settings::restore');
$routes->post('/settings/clear', 'Settings::clear');

// Reports (Admin)
$routes->get('/reports', 'Reports::index');
$routes->get('/reports/data', 'Reports::data');
$routes->get('/reports/sales', 'Reports::sales');
$routes->get('/reports/expenses', 'Reports::expenses');
