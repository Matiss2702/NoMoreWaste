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
$routes->setDefaultController('HomeController');
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
$routes->get('/', 'HomeController::index');
$routes->post('/contact', 'HomeController::contact');
$routes->get('/recette', 'HomeController::recette');
$routes->post('/add_image', 'UploadController::add_image');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/register', 'RegisterController::register');
$routes->get('/confirm/(:hash)', 'RegisterController::confirm/$1');
$routes->get('/job/(:id)', 'RegisterController::job/$1');
$routes->post('/condition', 'RegisterController::condition');
$routes->post('/forgot', 'ForgotPasswordController::forgot');
$routes->get('/reset/(:hash)', 'ForgotPasswordController::reset/$1');
$routes->post('/reset_confirm', 'ForgotPasswordController::reset_confirm');
$routes->get('/profile', 'ProfileController::profile');
$routes->post('/update','ProfileController::update');
$routes->get('/administrator', 'AdminAuthController::administrator');
$routes->post('/login_admin', 'AdminAuthController::login');
$routes->get('/logout_admin', 'AdminAuthController::logout');

//Routes Admin
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'Admin\HomeController::index');
    $routes->presenter('admins', ['controller' => 'Admin\AdminsController', 'except' => 'new,edit,remove']);
    $routes->presenter('benevoles', ['controller' => 'Admin\BenevolesController', 'except' => 'new,edit,remove']);
    $routes->presenter('conditions', ['controller' => 'Admin\ConditionsController', 'except' => 'new,edit,remove']);
    $routes->presenter('disponibilitys', ['controller' => 'Admin\DisponibilitysController', 'except' => 'new,edit,remove']);
    $routes->presenter('has_conditions', ['controller' => 'Admin\Has_ConditionsController', 'except' => 'new,edit,remove']);
    $routes->presenter('jobs', ['controller' => 'Admin\JobsController', 'except' => 'new,edit,remove']);
    $routes->presenter('necessitys', ['controller' => 'Admin\NecessitysController', 'except' => 'new,edit,remove']);
    $routes->presenter('plannings', ['controller' => 'Admin\PlanningsController', 'except' => 'new,edit,remove']);
    $routes->presenter('tasks', ['controller' => 'Admin\TasksController', 'except' => 'new,edit,remove']);
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
