<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//Admin : user management
$route['users/resetpassword/(:num)'] = 'users/resetpassword/$1';
$route['users/edit/(:num)'] = 'users/edit/$1';
$route['users/delete/(:num)'] = 'users/delete/$1';
$route['users/check/login'] = 'users/check_login';
$route['users/info/(:num)'] = 'users/getPublicInfo/$1';
$route['users'] = 'users';
$route['users/changepassword'] = 'users/changepassword';


//Session management
$route['connection/login'] = 'connection/login';
$route['connection/logout'] = 'connection/logout';
$route['connection/forgetpassword'] = 'connection/forgetpassword';
$route['connection/check/login'] = 'connection/check_login';
$route['connection/register'] = 'connection/register';

//Books management
$route['books/'] = 'books/';
$route['books/add'] = 'books/add';
$route['books/edit/(:num)'] = 'books/edit/$1';

// Books categories
$route['bookcategory/'] = 'bookcategory/';

// Search
$route['search/'] = 'users/';
$route['search/results'] = 'search/results';

//REST API
$route['api/books'] = 'api/getBooks';

$route['default_controller'] = 'account/';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
