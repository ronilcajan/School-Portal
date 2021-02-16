<?php namespace Config;

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
$routes->set404Override(function(){
	return view('404');
});
$routes->setAutoRoute(true);


/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('admin', ['filter' => 'role:admin'], function($routes) {

	$routes->add('', 'Admin\Dashboard::index');
	$routes->get('dashboard', 'Admin\Dashboard::index');
	$routes->get('register', 'Admin\Dashboard::register');
	$routes->post('delete-user', 'Admin\Dashboard::delete_users');
	$routes->post('changeRole', 'Admin\Dashboard::changeRole');

	$routes->get('students', 'Admin\Student::index');
	$routes->get('create-student', 'Admin\Student::create');
	$routes->post('submitStudent', 'Admin\Student::submitStudent');
	$routes->post('editStudent', 'Admin\Student::editStudent');
	$routes->post('studentProfile/(:num)', 'Admin\Student::studentProfile/$1');

	$routes->get('faculty', 'Admin\Faculty::index');
	$routes->get('create-faculty', 'Admin\Faculty::create');
	$routes->post('submit-faculty', 'Admin\Faculty::submitCreate');
	$routes->post('update-faculty', 'Admin\Faculty::updateCreate');
	$routes->post('selectSection', 'Admin\Faculty::selectSection');
	$routes->post('facultyInfo/(:num)', 'Admin\Faculty::facultyInfo/$1');

	$routes->get('section', 'Admin\Sections::index');
	$routes->post('create_section', 'Admin\Sections::create_section');
	$routes->post('getSection', 'Admin\Sections::getSection');
	$routes->post('update_section', 'Admin\Sections::update');
	$routes->post('specificSection/(:num)/(:any)', 'Admin\Sections::specificSection/$1/$2');

	$routes->get('my-profile', 'Admin\Profile::index');
	$routes->post('update-profile', 'Admin\Profile::update');
	
	$routes->post('create-subject', 'Admin\Subject::create');
	$routes->post('getSubject', 'Admin\Subject::getSubject');
	$routes->post('updateSubject', 'Admin\Subject::updateSubject');

	$routes->post('create-clearance', 'Admin\Clearance::createClearance');
	$routes->post('clearanceDone', 'Admin\Clearance::clearanceDone');
	$routes->post('updateClearance', 'Admin\Clearance::updateClearance');

	$routes->add('activity', 'Admin\Dashboard::activity');
	$routes->add('grades', 'Admin\Dashboard::grades');
});

$routes->group('student', function($routes) {
	$routes->get('dashboard', 'Student::dashboard');
	$routes->get('my-profile', 'Profile::profile');
	$routes->get('clearance', 'Student::clearance');
	$routes->post('changeActiStatus','Student::changeActiStatus');
	$routes->post('getFaculty','Student::getFaculty');
});

$routes->group('faculty', function($routes) {
	$routes->get('dashboard', 'Faculty::dashboard');
	$routes->get('my-profile', 'Profile::profile');
	$routes->get('students', 'Faculty::students');
	$routes->get('activity', 'Faculty::activity');
	$routes->get('grades', 'Faculty::grades');
	$routes->get('new-activity', 'Faculty::newActivity');
	$routes->post('create-activity', 'Faculty::submitActivty');
	$routes->add('delete-activity/(:num)', 'Faculty::deleteActivity/$1');
	$routes->post('getActivity', 'Faculty::getActivity');
	$routes->post('update-activity','Faculty::editActivty');
	$routes->post('assignActivity', 'Faculty::assignActivity');
	$routes->post('changeActiStatus', 'Faculty::changeActiStatus');
	$routes->add('myStudent/(:num)', 'Faculty::myStudents/$1');
	$routes->post('saveGrade', 'Faculty::saveGrade');
	$routes->post('getStudenttotal', 'Faculty::getStudenttotal');
	$routes->post('create-clearance', 'Faculty::createClearance');
	$routes->post('deleteClearance/(:num)', 'Faculty::deleteClearance/$1');
	$routes->post('clearanceDone', 'Faculty::clearanceDone');
	$routes->post('notifyGrade', 'Faculty::notifyGrade');
	$routes->post('notifyParents', 'Faculty::notifyParents');
});

$routes->group('portal', function($routes) {
	$routes->get('student/login', 'Student::index');
	$routes->get('faculty/login', 'Faculty::index');
});

$routes->post('loginAttempt', 'Login::loginAttempt');
$routes->post('update-profile', 'profile::updateProfile');
$routes->post('update-img', 'profile::updateImg');
$routes->post('update-pass', 'profile::changePass');
$routes->post('update-family', 'profile::updateFam');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
