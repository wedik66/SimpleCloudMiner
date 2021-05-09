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
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['ajax_auth']['post'] = 'Ajaxauth/index';
$route['ajax_auth/recoverpassword']['post'] = 'Ajaxauth/recoverpassword';
$route['auth/reset_password/(:any)'] = 'Welcome/reset_password/$1';
$route['logout'] = 'Welcome/logout';
$route['affiliate'] = 'Welcome/affiliate';
$route['r/(:num)'] = 'Welcome/referral/$1';
$route['faq'] = 'Welcome/faq';
$route['payouts'] = 'Welcome/payouts';
$route['contact'] = 'Welcome/contact';

$route['dashboard'] = 'Account/index';
$route['withdrawal']['get'] = 'Account/withdrawal';
$route['withdrawal']['post'] = 'Account/withdrawal';
$route['account'] = 'Account/history';
$route['purchase/(:num)'] = 'Account/purchase/$1';
$route['invoice/(:any)'] = 'Account/invoice/$1';

$route['ipn']['post'] = 'GatewayIpn/coinpayments';

//Admin
include_once __DIR__.'/admin_prefix.php';
$adminPrefix = $config['admin_route_prefix'];
if($adminPrefix !== 'admin'){
	$route['admin/(:any)'] = 404;
}
$route[$adminPrefix] = 'admin/Home/index';
$route[$adminPrefix.'/login'] = 'admin/Login/index';
$route[$adminPrefix.'/logout'] = 'admin/Logout/index';

$route[$adminPrefix.'/plans'] = 'admin/Plans/index';
$route[$adminPrefix.'/plans/(:num)'] = 'admin/Plans/index/$1';
$route[$adminPrefix.'/plans/create'] = 'admin/Plans/create';
$route[$adminPrefix.'/plans/edit/(:num)'] = 'admin/Plans/edit/$1';
$route[$adminPrefix.'/plans/delete/(:num)'] = 'admin/Plans/delete/$1';

$route[$adminPrefix.'/urlchains'] = 'admin/Urlchains/index';
$route[$adminPrefix.'/urlchains/(:num)'] = 'admin/Urlchains/index/$1';
$route[$adminPrefix.'/urlchains/create'] = 'admin/Urlchains/create';
$route[$adminPrefix.'/urlchains/edit/(:num)'] = 'admin/Urlchains/edit/$1';
$route[$adminPrefix.'/urlchains/delete/(:num)'] = 'admin/Urlchains/delete/$1';

$route[$adminPrefix.'/users'] = 'admin/Users/index';
$route[$adminPrefix.'/users/(:num)'] = 'admin/Users/index/$1';
$route[$adminPrefix.'/users/view/(:num)'] = 'admin/Users/view/$1';

$route[$adminPrefix.'/settings'] = 'admin/Settings/index';

$route[$adminPrefix.'/withdrawals'] = 'admin/Withdrawals/index';
$route[$adminPrefix.'/withdrawals/(:num)'] = 'admin/Withdrawals/index/$1';
$route[$adminPrefix.'/withdrawals/edit/(:num)'] = 'admin/Withdrawals/edit/$1';

$route[$adminPrefix.'/contact'] = 'admin/Contact/index';
$route[$adminPrefix.'/contact/(:num)'] = 'admin/Contact/index/$1';
$route[$adminPrefix.'/contact/edit/(:num)'] = 'admin/Contact/edit/$1';

$route[$adminPrefix.'/transactions'] = 'admin/Transactions/index';
$route[$adminPrefix.'/transactions/(:num)'] = 'admin/Transactions/index/$1';

$route[$adminPrefix.'/ipnlogs'] = 'admin/Ipnlogs/index';
$route[$adminPrefix.'/ipnlogs/(:num)'] = 'admin/Ipnlogs/index/$1';
$route[$adminPrefix.'/ipnlogs/view/(:num)'] = 'admin/Ipnlogs/view/$1';

$route[$adminPrefix.'/admins'] = 'admin/Admins/index';
$route[$adminPrefix.'/admins/(:num)'] = 'admin/Admins/index/$1';
$route[$adminPrefix.'/admins/create'] = 'admin/Admins/create';
$route[$adminPrefix.'/admins/edit/(:num)'] = 'admin/Admins/edit/$1';
$route[$adminPrefix.'/admins/promove/(:num)'] = 'admin/Admins/promove/$1';
$route[$adminPrefix.'/admins/remove/(:num)'] = 'admin/Admins/remove/$1';

//Install Wizard
include_once __DIR__.'/smartyscripts.php';
$installed = $config['installed'];
if($installed){
	$route['install/:any'] = 404;
}else{
	$route['install'] = 'install/Home/index';
	$route['install/step1'] = 'install/Home/step1';
	$route['install/step2'] = 'install/Home/step2';
	$route['install/step3'] = 'install/Home/step3';
	$route['install/step4'] = 'install/Home/step4';
	$route['install/step5'] = 'install/Home/step5';
	$route['install/step6'] = 'install/Home/step6';
}

//Autoload plugins routes
foreach (glob(__DIR__."/plugins/*.php") as $filename)
{
	include_once $filename;
}
