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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['index.php/(:any)'] = '$1';

// Admin
$route['adminmaster'] = 'adminHomeMaster';
$route['adminlogin'] = 'adminloginMaster'; // Admin Login
$route['admin-questions'] = 'adminQuestionsList';
$route['admin-questions/remove'] = 'adminQuestionsList/remove';
$route['admin-tests'] = 'adminTestList';
$route['admin-results'] = 'adminResultList';
$route['admin-test-results'] = 'AdminTestResultList';
$route['admin-test-results/detail'] = 'AdminTestResultList/detail';
$route['admin-test-results/display-graph'] = 'AdminTestResultList/graphCompare';
$route['admin-users'] = 'adminUserList';
$route['admin-users/detail'] = 'adminUserList/detail';
$route['admin-results/change'] = 'adminResultList/change';
$route['admin-results/add-type'] = 'adminResultList/addType';
$route['admin-results/update-type'] = 'adminResultList/updateType';
$route['admincareeritem'] = 'adminCareerItemMaster';
$route['adminapplication'] = 'adminCareerApplicationMaster';
$route['adminapplicationitem'] = 'adminCareerApplicationItemMaster';
$route['adminapplicationitem/download'] = 'adminCareerApplicationItemMaster/download';
$route['adminservicesrow1'] = 'adminServiceRowOneMaster';
$route['adminservicesrow1/change'] = 'adminServiceRowOneMaster/change';
$route['adminservicesrow2'] = 'adminServiceRowTwoMaster';
$route['adminservicesrow2/change'] = 'adminServiceRowTwoMaster/change';
$route['adminservicesrow2/add'] = 'adminServiceRowTwoMaster/add';
$route['adminservicesrow2/delete'] = 'adminServiceRowTwoMaster/delete';
$route['adminservicesrow3'] = 'adminServiceRowThreeMaster';
$route['adminservicesrow4'] = 'adminServiceRowFourMaster';
$route['adminservicesrow4/delete'] = 'adminServiceRowFourMaster/delete';
$route['adminclient'] = 'adminClientMaster';
$route['adminclient/change'] = 'adminClientMaster/change';
$route['adminclient/add'] = 'adminClientMaster/add';
$route['adminclient/delete'] = 'adminClientMaster/delete';
$route['adminteam'] = 'AdminMemberListMaster';
$route['adminmember'] = 'AdminMemberMaster';
$route['adminmember/remove'] = 'adminMemberMaster/remove';
$route['adminhome'] = 'adminHomeMaster';

$route['services'] = 'services';

//User
$route['home'] = 'Home';
$route['career'] = 'careerList';
$route['services'] = 'services';
$route['career/detail'] = 'careerList/detail';
$route['career/add'] = 'careerList/add';
$route['career/search'] = 'careerList/search';

$route['users/create'] = 'User/create';
$route['users'] = 'User/getAll';
$route['users/login'] = 'User/login';

// HOtel
$route['hotels'] = 'Hotel/getListHotelInCity';
$route['hotels/rooms/count'] = 'Hotel/countUserBookWithRoomId';
$route['hotels/save'] = 'Hotel/create';
$route['hotels/images/save'] = 'Hotel/insertHotelImage';
$route['hotels/rooms'] = 'Room/getListRoomsFromHotelId';
$route['hotels/addview'] = 'Hotel/addHotelView';
$route['hotels/recommended'] = 'Hotel/getListHotelRecommended';
// Room
$route['rooms/save'] = 'Room/create';
$route['rooms/images/save'] = 'Room/insertRoomImage';
$route['room/info'] = 'Room/getRoomInfo';

// Book
$route['book'] = 'Room/bookRoom';
$route['book/list'] = 'User/getListBook';

//remove
$route['admincareeritem/remove'] = 'adminCareerItemMaster/remove';
