<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Headers: Authorization");

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
$route['default_controller'] = 'Welcome';

// $route['addtion']='Welcome/addtion';
// $route['find']['get']='Product/find_all';
// $route['create'] = 'Product/create';
// $route['findbyid/(:num)'] = 'Product/find/$1';
// $route['update'] = 'Product/update';
// $route['delete/(:num)'] = 'Product/delete/$1';

$route['signup']='Register/signup';
$route['signin']='Login/signin';
$route['logoff']='Logout/logoff';
$route['forgot'] = 'Login/forgot';
$route['getEmailId'] = 'Login/getEmailId';
$route['resetPassword'] = 'Login/resetPassword'; 
$route['addNote'] = 'Note/addNote';
$route['displayNote'] = 'Note/displayNote';
//$route['addRemainder'] = 'Remainder/addRemainder';
//$route['displayRemainder'] = 'Remainder/displayRemainder';
$route['delNote'] = 'Note/delNote';
//$route['deleteRemainder'] = 'Remainder/deleteRemainder';
$route['changeColor'] = 'Note/changeColor';
$route['editNote'] = 'Note/editNote';
$route['changeDate'] = 'Note/changeDate';
$route['archive'] = 'Note/archive';
$route['fetcharchive'] = 'Archive/fetcharchive';
$route['unarchive'] = 'Archive/unarchive';
$route['fetchTrash'] = 'Trash/fetchTrash';
$route['delete'] = 'Trash/delete';
$route['restore'] = 'Trash/restore';
$route['addLabels'] = 'Label/addLabels';
$route['getLabel'] = 'Label/getLabel';
$route['socialLogin'] = 'Login/socialLogin';
$route['addUImage'] = 'Register/addUImage';
$route['getImage'] = 'Register/getImage';
$route['addUImageNote'] = 'Note/addUImageNote';
$route['fetchReminder'] = 'Remainder/fetchReminder';
$route['pinNotes'] = 'Note/pinNotes';
$route['deletelname'] = 'Label/deletelname';
$route['addLtoN'] = 'Label/addLtoN';

$route['get'] = 'A/get';

// $route['delete']['delete']='Product/find_all';
// $route['product/(:any)'] = 'index.php/product';
// $route['product/(:num)'] = 'product/find/$1';
// $route['product']['get'] = 'product/find_all';
// $route['delete/(:num)'] = 'Product/delete';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
