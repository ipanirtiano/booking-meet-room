<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');


$routes->group('views', ['filter' => 'login'], function ($routes) {
	$routes->add('/', 'Dashboard::index');
	$routes->add('booking-room/(:any)/(:any)', 'Booking::booking_room/$1/$2');
	$routes->add('list-booking/(:any)', 'Booking::list_booking/$1');
	$routes->add('ruang-meeting', 'Ruangan::index');

	$routes->add('my-booking/(:any)', 'Booking::my_booking/$1');
	$routes->add('edit-booking/(:any)', 'Booking::edit_booking/$1');
	$routes->add('cancel-booking/(:any)', 'Booking::cancel_booking/$1');
	$routes->add('jam-bentrok/(:any)/(:any)', 'Booking::bentrok/$1/$2');
});

$routes->group('admin', ['filter' => 'admin'], function ($routes) {
	$routes->add('departemen', 'Departemen::index');
	$routes->add('update-dept/(:any)', 'Departemen::update_dept/$1');
	$routes->add('delete-dept/(:any)', 'Departemen::hapus/$1');

	$routes->add('users/', 'Guest::index');
	$routes->add('update-user/(:any)', 'Guest::update_user/$1');
	$routes->add('delete-user/(:any)', 'Guest::hapus/$1');

	$routes->add('cabang', 'Cabang::index');
	$routes->add('update-cabang/(:any)', 'Cabang::update_cabang/$1');
	$routes->add('delete-cabang/(:any)', 'Cabang::hapus/$1');

	$routes->add('update-room/(:any)', 'Ruangan::update_room/$1');
	$routes->add('delete-room/(:any)', 'Ruangan::hapus/$1');

	$routes->add('booking-in/(:any)/(:any)/(:any)', 'Booking::booking_in/$1/$2/$3');
	$routes->add('booking-out/(:any)/(:any)/(:any)', 'Booking::booking_out/$1/$2/$3');

	$routes->add('list-cancel/(:any)', 'Booking::list_cancel_booking/$1');
	$routes->add('resepsionis', 'Booking::resepsionis');
	$routes->add('resepsionis-list/(:any)', 'Booking::resepsionis_list/$1');

	$routes->add('report', 'PrintOut::index');
	$routes->add('print/(:any)/(:any)', 'PrintOut::print/$1/$2');
});



/**
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
