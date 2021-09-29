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
// $routes->get('/menu', 'Home::index');
$routes->get('/forgot_password', 'Home::index');
$routes->get('/signin', 'Home::index');
$routes->get('/signup', 'Register::index');
$routes->post('/signup', 'Register::signup');
$routes->get('/menu/(:num)', 'Menu::index/$1');

$routes->post('/login', 'Login::login');
$routes->get('/logout', 'Login::logout');

$routes->get('/line_login', 'Login::line');
$routes->get('/line_login_c', 'Login::linec');









$routes->post('/calendar', 'Calendar::index');



$routes->group('setting', function ($routes) {
    $routes->group('prefix', function ($routes) {
		$routes->get('index', 'Setting\Prefix::index');
		$routes->get('create/', 'Setting\Prefix::create');
		$routes->get('update/(:num)', 'Setting\Prefix::create/$1');
		$routes->get('delete/(:num)', 'Setting\Prefix::delete/$1');
    });
	$routes->group('bank', function ($routes) {
		$routes->get('index', 'Setting\Bank::index');
		$routes->get('create/', 'Setting\Bank::create');
		$routes->get('update/(:num)', 'Setting\Bank::update/$1');
		$routes->get('delete/(:num)', 'Setting\Bank::delete/$1');
    });
	$routes->group('province', function ($routes) {
		$routes->match(['get', 'post'],'/','Setting\Povince::index');
		$routes->get('create/', 'Setting\Povince::create');
		$routes->get('edit/(:num)', 'Setting\Povince::create/$1');
		$routes->get('view/(:num)', 'Setting\Povince::view/$1');
		$routes->post('delete/(:num)', 'Setting\Povince::delete/$1');
		$routes->post('save', 'Setting\Povince::save');
    });
	$routes->group('amphure', function ($routes){
		$routes->match(['get', 'post'],'/','Setting\Amphure::index');
		$routes->get('create/', 'Setting\Amphure::create');
		$routes->get('edit/(:num)', 'Setting\Amphure::create/$1');
		$routes->get('view/(:num)', 'Setting\Amphure::view/$1');
		$routes->post('delete/(:num)', 'Setting\Amphure::delete/$1');
		$routes->post('save', 'Setting\Amphure::save');
	});
	$routes->group('tambon', function ($routes){
		$routes->match(['get', 'post'],'/','Setting\Tambon::index');
		$routes->get('create/', 'Setting\Tambon::create');
		$routes->get('edit/(:num)', 'Setting\Tambon::create/$1');
		$routes->get('view/(:num)', 'Setting\Tambon::view/$1');
		$routes->post('delete/(:num)', 'Setting\Tambon::delete/$1');
		$routes->post('save', 'Setting\Tambon::save');
	});
});

$routes->group('warehouse', function ($routes) {
    $routes->group('warehouse', function ($routes) {
		$routes->get('index', 'Warehouse\Warehouse::index');
		$routes->get('create/', 'Warehouse\Warehouse::create');
		$routes->get('update/(:num)', 'Warehouse\Warehouse::create/$1');
		$routes->get('delete/(:num)', 'Warehouse\Warehouse::delete/$1');
    });
});
$routes->group('product', function ($routes) {
    $routes->group('product_type', function ($routes){
		$routes->match(['get', 'post'],'/','Product\ProductType::index');
		$routes->get('create/', 'Product\ProductType::create');
		$routes->get('edit/(:num)', 'Product\ProductType::create/$1');
		$routes->get('view/(:num)', 'Product\ProductType::view/$1');
		$routes->post('delete/(:num)', 'Product\ProductType::delete/$1');
		$routes->post('save', 'Product\ProductType::save');
    });
	$routes->group('product_tlist', function ($routes){
		$routes->match(['get', 'post'],'/','Product\ProductList::index');
		$routes->get('create/', 'Product\ProductList::create');
		$routes->get('edit/(:num)', 'Product\ProductList::create/$1');
		$routes->get('view/(:num)', 'Product\ProductList::view/$1');
		$routes->post('delete/(:num)', 'Product\ProductList::delete/$1');
		$routes->post('save', 'Product\ProductList::save');
	});
	$routes->group('chemical_group', function ($routes){
		$routes->match(['get', 'post'],'/','Product\ChemicalGroup::index');
		$routes->get('create/', 'Product\ChemicalGroup::create');
		$routes->get('edit/(:num)', 'Product\ChemicalGroup::create/$1');
		$routes->get('view/(:num)', 'Product\ChemicalGroup::view/$1');
		$routes->post('delete/(:num)', 'Product\ChemicalGroup::delete/$1');
		$routes->post('save', 'Product\ChemicalGroup::save');
	});
});

//ระบบลงเวลาปฏิบัติงาน 
$routes->group('attendance', function ($routes) {
	$routes->group('setting', function ($routes) {
		$routes->group('holiday', function ($routes) {
			$routes->match(['get', 'post'],'/','Attendance\Setting\Holiday::index');
			$routes->get('create/', 'Attendance\Setting\Holiday::create');
			$routes->get('edit/(:num)', 'Attendance\Setting\Holiday::create/$1');
			$routes->get('view/(:num)', 'Attendance\Setting\Holiday::view/$1');
			$routes->post('save/', 'Attendance\Setting\Holiday::save');
			$routes->post('delete/(:num)', 'Attendance\Setting\Holiday::delete/$1');
			$routes->post('import/', 'Attendance\Setting\Holiday::import');
			


		});
		$routes->group('time', function ($routes) {
			$routes->match(['get', 'post'],'/','Attendance\Setting\Time::index');
			$routes->get('create/', 'Attendance\Setting\Time::create');
			$routes->get('edit/(:num)', 'Attendance\Setting\Time::create/$1');
			$routes->get('view/(:num)', 'Attendance\Setting\Time::view/$1');
			$routes->post('save/', 'Attendance\Setting\Time::save');
			$routes->post('delete/(:num)', 'Attendance\Setting\Time::delete/$1');
		});
	});
});


$routes->group('back-end', function ($routes) {
	$routes->group('menu', function ($routes) {
		$routes->get('/', 'Back_end\Menu::index');
		$routes->get('move/', 'Back_end\Menu::move');
		$routes->get('rename/', 'Back_end\Menu::rename');
		$routes->get('remove/', 'Back_end\Menu::remove');
		$routes->get('add/', 'Back_end\Menu::add');
		$routes->get('detail', 'Back_end\Menu::detail');
		$routes->post('save', 'Back_end\Menu::save');
	});
	$routes->group('table_list', function ($routes) {
		$routes->get('/', 'Back_end\TableList::index');
		$routes->get('create/', 'Back_end\TableList::create');
		$routes->get('edit/(:num)', 'Back_end\TableList::create/$1');
		$routes->get('field/(:num)', 'Back_end\TableList::field/$1');
		$routes->get('excel/', 'Back_end\TableList::excel');
		$routes->get('import', 'Back_end\TableList::import');
		$routes->post('delete/(:num)', 'Back_end\TableList::delete/$1');
		$routes->post('save/', 'Back_end\TableList::save');
		$routes->get('add_field/', 'Back_end\TableList::add_field'); 
		$routes->post('save_field/', 'Back_end\TableList::save_field'); 
	});
});
$routes->group('back-end', function ($routes) {
	$routes->group('group_list', function ($routes) {
		$routes->get('/', 'Back_end\GroupList::index');
		$routes->get('create/', 'Back_end\GroupList::create');
		$routes->get('update/(:num)', 'Back_end\GroupList::create/$1');
		$routes->get('delete/(:num)', 'Back_end\GroupList::delete/$1');
		$routes->post('save/', 'Back_end\GroupList::save');
	});
});
$routes->group('user_account', function ($routes){
	$routes->group('aut_user', function ($routes){
		$routes->match(['get', 'post'],'/','UserAccount\AutUser::index');
		$routes->get('create/', 'UserAccount\AutUser::create');
		$routes->get('edit/(:num)', 'UserAccount\AutUser::create/$1');
		// $routes->get('view/(:num)', 'UserAccount\AutUser::view/$1');
		$routes->post('save/', 'UserAccount\AutUser::save');
		$routes->post('delete/(:num)', 'UserAccount\AutUser::delete/$1');
		$routes->get('menu/(:num)', 'UserAccount\AutUser::menu/$1');
		$routes->post('save_menu/', 'UserAccount\AutUser::save_menu');
	});
});
$routes->group('user_account', function ($routes){
	$routes->group('aut_group', function ($routes){
		$routes->get('/', 'UserAccount\AutGroup::index');
		$routes->post('/', 'UserAccount\AutGroup::index');
		$routes->get('create/', 'UserAccount\AutGroup::create');
		$routes->get('edit/(:num)', 'UserAccount\AutGroup::create/$1');
		$routes->get('view/(:num)', 'UserAccount\AutGroup::view/$1');
		$routes->post('save/', 'UserAccount\AutGroup::save');
		$routes->post('delete/(:num)', 'UserAccount\AutGroup::delete/$1');
		$routes->get('menu/(:num)', 'UserAccount\AutGroup::menu/$1');
		$routes->post('save_menu/', 'UserAccount\AutGroup::save_menu');
	});
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
