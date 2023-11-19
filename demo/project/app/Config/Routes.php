<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/hello', 'Hello::index');

$routes->get('/login', 'Login::index');
$routes->get('/login/logout', 'Login::logout');
$routes->get('/login/default_page', 'Login::default_page');
$routes->get('/login/new_thread', 'Login::new_thread');
$routes->get('/login/no_thread', 'Login::no_thread');
$routes->get('/login/star_thread', 'Login::star_thread');
$routes->get('/login/profile', 'Login::profile');
$routes->get('/login/profile_photo', 'Login::profile_photo');

$routes->post('/login/open_thread', 'Login::open_thread');
$routes->post('/login/check_login', 'Login::check_login');
$routes->post('/login/update_profile', 'Login::update_profile');
$routes->post('/login/update_course', 'Login::update_course');
$routes->post('/login/check_post', 'Login::check_post');
$routes->get('/login/check_post', 'Login::check_post');
$routes->post('/login/check_comment', 'Login::check_comment');
$routes->post('/login/show_post', 'Login::show_post');
$routes->post('/login/show_favorite', 'Login::show_favorite');
$routes->post('/login/show_comment', 'Login::show_comment');
$routes->post('/login/get_like', 'Login::get_like');
$routes->post('/login/get_star', 'Login::get_star');
$routes->post('/login/upload_file', 'Login::upload_file');
$routes->post('/login/upload_image', 'Login::upload_image');
$routes->post('/login/process_image', 'Login::process_image');
$routes->post('/login/upload_image', 'Login::upload_image');
$routes->post('/login/search', 'Login::search');
$routes->get('/login/search', 'Login::search');


$routes->post('/upload/upload_file', 'Upload::upload_file');
$routes->get('/upload', 'Upload::index');

$routes->get('/sign_up', 'Sign_up::index');
$routes->post('/sign_up/check_sign_up', 'Sign_up::check_sign_up');

$routes->get('/verification', 'Verification::index');
$routes->post('/verification/verify', 'Verification::verify');

$routes->get('/reset', 'Reset::index');
$routes->post('/reset/forgot_password', 'Reset::forgot_password');
$routes->add('/reset/verify_token/(:any)', 'Reset::verify_token/$1');
$routes->post('/reset/reset_password', 'Reset::reset_password');
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
