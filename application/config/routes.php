<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route = array(
				'default_controller'	=> 'pages_loader',

				'admin/login'			=> 'admin/admin/login',
				'admin'					=> 'admin/admin',

				'acts/(:any)'			=> 'general/acts',
				'acts'					=> 'general/acts',

				'contacts/(:any)'		=> 'general/contacts',
				'contacts'				=> 'general/contacts',

				'employments/(:any)'	=> 'general/employments',
				'employments'			=> 'general/employments',
				
				'events/(:any)'			=> 'general/events',
				'events'				=> 'general/events',

				'faqs/(:any)'			=> 'general/faqs',
				'faqs'					=> 'general/faqs',

				'health/(:any)'			=> 'general/health',
				'health'				=> 'general/health',

				'notices/(:any)'		=> 'general/notices',
				'notices'				=> 'general/notices',

				'pages/(:any)'			=> 'general/pages',
				'pages'					=> 'general/pages',

				'press/(:any)'			=> 'general/press',
				'press'					=> 'general/press',

				'polls/(:any)'			=> 'general/polls',
				'polls'					=> 'general/polls',

				'news/(:any)'			=> 'general/news',
				'news'					=> 'general/news',

				'en'					=> 'pages_loader/set_language',
				'np'					=> 'pages_loader/set_language',

				'404_override'			=> '',
		);

/* End of file routes.php */
/* Location: ./application/config/routes.php */
