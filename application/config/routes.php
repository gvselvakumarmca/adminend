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
$route['default_controller'] = 'admin';
$route['404_override'] = 'admin/error_404';
$route['translate_uri_dashes'] = FALSE;

$route['QuestionsAsked']	= 'admin/QuestionsAsked';
$route['QuestionsAnswered']	= 'admin/QuestionsAnswered';
$route['refund']	= 'admin/refund';
$route['refundamt']	= 'admin/refundamt';
$route['UniqueClicks']	= 'admin/UniqueClicks';
$route['RefundRequest']	= 'admin/RefundRequest';
$route['refstatus']	= 'admin/refstatus';

$route['LawyerRatings']	= 'admin/LawyerRatings';

$route['manageprices']	= 'admin/GeneralSettings';
$route['admin/GeneralSettingsList']	= 'admin/GeneralSettingsList';

$route['UserManagement']	= 'admin/UserManagement';
$route['admin/UserManagementList']	= 'admin/UserManagementList';
$route['admin/UserActive']	= 'admin/UserActive';
$route['admin/UserBalance']	= 'admin/UserBalance';
$route['viewuser']	= 'admin/viewuser';

$route['LawyerManagement']	= 'admin/LawyerManagement';
$route['admin/LawyersManagementList']	= 'admin/LawyersManagementList';
$route['admin/LawyerPrimary']	= 'admin/LawyerPrimary';
$route['admin/LawyerActive']	= 'admin/LawyerActive';

$route['lawfirm']	= 'admin/lawfirm';
$route['admin/lawfirmstatus']	= 'admin/lawfirmstatus';
$route['ConsultationRequests']	= 'admin/ConsultationRequests';

$route['topics']	= 'admin/topics';
$route['topicdelete']	= 'admin/topicdelete';
$route['topicorder']	= 'admin/topicorder';
$route['createtopic']	= 'admin/createtopic';
$route['edittopic']	= 'admin/edittopic';

$route['news']	= 'admin/news';
$route['newsdelete']	= 'admin/newsdelete';
$route['createnews']	= 'admin/createnews';
$route['editnews']	= 'admin/editnews';

$route['feedback']	= 'admin/feedback';
$route['contact']	= 'admin/contact';

$route['LawfirmRequest']	= 'admin/LawfirmRequest';
$route['lawreqdelete']	= 'admin/lawreqdelete';
$route['regemail']	= 'admin/regemail';

$route['createlawrequest']	= 'admin/createlawrequest';
$route['editlawrequest']	= 'admin/editlawrequest';

