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
$routes->get('/webgl', 'HomeController::webgl');
$routes->get('/faq', 'HomeController::faq');
$routes->post('/contact', 'HomeController::contact');
$routes->post('/cart', 'CartController::index');
$routes->post('/checkout', 'CartController::checkout');
$routes->post('/remove_cart', 'CartController::remove');
$routes->post('/update_cart', 'CartController::update');
$routes->post('/add_image', 'UploadController::add_image');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/register', 'RegisterController::register');
$routes->get('/confirm/(:hash)', 'RegisterController::confirm/$1');
$routes->post('/forgot', 'ForgotPasswordController::forgot');
$routes->get('/reset/(:hash)', 'ForgotPasswordController::reset/$1');
$routes->post('/reset_confirm', 'ForgotPasswordController::reset_confirm');
$routes->get('/profile', 'ProfileController::profile');
$routes->post('/update','ProfileController::update');
$routes->post('/add_cart/(:num)','ProductController::add_cart/$1');


$routes->get('/administrator', 'admin\AuthController::administrator');
$routes->presenter('/admins', ['controller' => 'admin\AdminsController', 'except' => 'new,edit,remove']);
$routes->presenter('/benevoles', ['controller' => 'admin\BenevolesController', 'except' => 'new,edit,remove']);
$routes->presenter('/conditions', ['controller' => 'admin\ConditionsController', 'except' => 'new,edit,remove']);
$routes->presenter('/disponibilitys', ['controller' => 'admin\DisponibilitysController', 'except' => 'new,edit,remove']);
$routes->presenter('/has_conditions', ['controller' => 'admin\Has_ConditionsController', 'except' => 'new,edit,remove']);
$routes->presenter('/jobs', ['controller' => 'admin\JobsController', 'except' => 'new,edit,remove']);
$routes->presenter('/necessitys', ['controller' => 'admin\NecessitysController', 'except' => 'new,edit,remove']);
$routes->presenter('/plannings', ['controller' => 'admin\PlanningsController', 'except' => 'new,edit,remove']);
$routes->presenter('/tasks', ['controller' => 'admin\TasksController', 'except' => 'new,edit,remove']);
//Routes Api
// $routes->group('api', function ($routes) {
//     $routes->post('login', 'Api\LoginController::index');
//     $routes->get('profile','Api\ProfileController::index',['filter'=>'api-auth']);
//     $routes->resource('product', ['controller' => 'Api\ProductController', 'except' => 'new,edit,remove']);
//     $routes->resource('benevoles', ['controller' => 'Api\UserController', 'except' => 'new,edit,remove']);
//     $routes->resource('group', ['controller' => 'Api\GroupController', 'except' => 'new,edit,remove']);
//     $routes->resource('subscription', ['controller' => 'Api\SubscriptionController', 'except' => 'new,edit,remove']);
//     $routes->resource('company', ['controller' => 'Api\CompanyController', 'except' => 'new,edit,remove']);
//     $routes->resource('partner', ['controller' => 'Api\PartnerController', 'except' => 'new,edit,remove']);
//     $routes->resource('warehouse', ['controller' => 'Api\WarehouseController', 'except' => 'new,edit,remove']);
//     $routes->resource('stock', ['controller' => 'Api\StockController', 'except' => 'new,edit,remove']);
//     $routes->resource('type_product', ['controller' => 'Api\ProductTypeController', 'except' => 'new,edit,remove']);
//     $routes->resource('order', ['controller' => 'Api\OrderController', 'except' => 'new,edit,remove']);
//     $routes->resource('order_product', ['controller' => 'Api\OrderProductController', 'except' => 'new,edit,remove']);
// });
//Routes Admin
// $routes->group('admins', ['filter' => 'admins'], function ($routes) {
//     $routes->get('/', 'Admin\HomeController::index');
// });




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
