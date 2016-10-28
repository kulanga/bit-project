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

$route['default_controller'] = "login";
$route['404_override'] = '';
$route['studentx/testxxx'] = "student/home/test";
$route['student/(:any)'] = "student/$1";

//admin routes
$route['admin/staff'] = "admin/admin_manage_user/index";
$route['admin/manage/staff/?(:num)?'] = "admin/admin_manage_user/staff/$1";
$route['admin/staff/new'] = "admin/admin_manage_user/create_staff";
$route['admin/staff/update/(:num)'] = "admin/admin_manage_user/create_staff/$1";
$route['admin/staff/edit/(:num)'] = "admin/admin_manage_user/edit_staff/$1";

$route['admin/student/list'] =  'admin/admin_manage_user/list_students';

$route['admin/course'] = "admin/admin_manage_course/index";
$route['admin/course/new'] = "admin/admin_manage_course/save_course";
$route['admin/course/edit/(:num)'] = "admin/admin_manage_course/edit/$1";
$route['admin/course/settings/(:num)'] = "admin/admin_manage_course/settings/$1";
$route['admin/course/save_semster'] = "admin/admin_manage_course/save_semster";

$route['admin/subject'] = "admin/admin_manage_subject/index";
$route['admin/subject/save/?(:num)?'] = "admin/admin_manage_subject/save/$1";
$route['admin/subject/index'] = "admin/admin_manage_subject/index";

$route['admin/timetable'] = "admin/admin_manage_timetable/index";

//staff routes
$route['staff/my-timetable'] =  'staff/staff_timetable/index';
$route['staff/assignment'] = 'staff/staff_assignment/index';
$route['staff/assignment/create'] = 'staff/staff_assignment/create';
$route['staff/assignment/edit/(:num)'] = 'staff/staff_assignment/create/$1';

//student routes
$route['student/signup'] = 'student/student_signup/signup'; 
$route['student/welcome'] = 'student/student_home/welcome';
$route['student/home'] = 'student/student_home/index'; 
$route['student/timetable'] = 'student/student_home/view_timetable';
$route['student/assignment'] = 'student/student_assignment/index';
$route['student/assignment/submit/(:num)'] = 'student/student_assignment/submit/$1';


$route['assets/(:any)'] = 'assets/$1';


$route['(:any)'] = "$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */
