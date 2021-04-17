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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = "welcome";
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
// $route['survey'] = "/surveys/process/";
// $route['word'] = "/words/process/";
// $route['money'] = "ninja/process_money";
// $route['course'] = "/courses/process_add_course/";
// $route['ninjas/(:any)'] = "/main/ninjas/$1/";
// $route['add'] = "/products/create";
// $route['edit/(:any)'] = "/products/update/$1";
// $route['register'] = "/students/create_user";
// $route['login'] = "/students/login";
// $route['order/(:any)'] = "/shops/order/$1";
// $route['save_order'] = "/shops/save_order/";
// $route['create_view'] = "/main/create/";
// $route['display/(:any)/(:any)'] = "/users/say/$1/$2/";
// $route['search'] = "sports/search/";
$route['register'] = "usersdashboard/add_user/";
$route['new'] = "usersdashboard/new_user/";
$route['login'] = "usersdashboard/authentication/";
$route['show/(:any)'] = "usersdashboard/showuser/$1";
$route['save_info'] = "usersdashboard/save_info/";
$route['changepass/(:any)'] = "usersdashboard/changepass/$1/";
$route['update_profile'] = "usersdashboard/update_profile/";
$route['update_desc'] = "usersdashboard/update_desc/";
$route['send_msg'] = "usersdashboard/send_msg/";
$route['send_comment'] = "usersdashboard/send_comment/";
$route['default_controller'] = "usersdashboard";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
