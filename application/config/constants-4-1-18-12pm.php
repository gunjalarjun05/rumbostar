<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

//*************************** Path constant*********************************//
define('FRONT_ASSETS_CSS','assets/css/front/');
define('FRONT_ASSETS_JS','assets/js/front/');
define('ASSETS_IMAGES','assets/images/');


//*************************** Path constant for admin*********************************//
define('ADMIN_ASSETS_CSS','assets/css/admin/');
define('ADMIN_ASSETS_JS','assets/js/admin/');
define('ADMIN_BOOTSTRAP','assets/bootstrap/admin/');
define('ADMIN_PLUGINS','assets/plugins/admin/');

//----------------------------------------Admin Folder Path constant --------------//
define('ADMIN_VIEWS','admin/');
define('ADMIN_CONTROLERS','admin/');
define('ADMIN_SESSION','admin_rb_');

//----------------------------------------Agent Folder Path constant --------------//
define('AGENT_VIEWS','agent/');
define('AGENT_CONTROLERS','agent/');

//------------------------------------------------------//
define('USER_SESSION','user_rb_');

define('GENERAL_ERROR_MSG', 'Oops, Something went wrong, Please try again later.');

define('LISTING_PAGE_LIMIT', '5');
define('HOTEL_LISTING_PAGE_LIMIT', '15');
define('TRAIN_LISTING_PAGE_LIMIT', '5');

//table constant
define('PREFIX','rs_');
define('USERS',PREFIX.'users');
define('CUST_INFO_BOOKING_DETAILS',PREFIX.'cust_info_booking_details');
define('PASSENGER_DETAILS',PREFIX.'passenger_details');
define('CUST_HOTEL_BOOKING_DETAILS',PREFIX.'cust_hotel_booking_details');
define('COUNTRIES',PREFIX.'countries');
define('CARDS',PREFIX.'cards');
define('OFFER_MANAGEMENT',PREFIX.'offer_management');


define('AIRLINE_LIST',PREFIX.'airline_list');
define('AIRPORT_LIST',PREFIX.'airport_list');
define('WALLET_HISTORY',PREFIX.'wallet_history');
define('DOMESTIC_AIRLINE_LIST',PREFIX.'domestic_airline_list');


//message content
define('AGENT_ADDED','Agent added successfully.');
define('AGENT_UPDATED','Agent updated successfully.');
define('USER_ADDED','User added successfully.');
define('USER_UPDATED','User updated successfully.');
define('OFFER_ADDED','Offer added successfully.');
define('OFFER_UPDATED','Offer updated successfully.');



//mail contsant
define('ADMIN_MAIL','gaurav.g@exceptionaire.co');
define('USER_REG_SUBJECT','Rumbostar account activation link');
$userbody="<strong>Hello %USER_NAME%,</strong><br><br> You are registered successfully on Rumbostar.<br/>
			Please click the link below url to verify and activate your account.</p><p><a href='%LINK%' target='_blank'>Activate Account</a> <br><br> Thanks and Regards <br> Rumbostar";
define('USER_BODY',$userbody);
define('FORGOT_PSWD', 'Reset Password');

define('FORGOT_PSWD_BODY', '<strong>Hello %USER_NAME%,</strong><br><br> A request has been made to reset your Rumbostar account password. To reset your password Click the below URL and proceed with resetting your password.<br><br> <a href="%LINK%">%LINK%</a><br><br>Thanks and Regards <br> Rumbostar');

define('FORGOT_PSWD_BODY_ADMIN', '<strong>Hello %USER_NAME%,</strong><br><br>This is your new admin credentials please use for admin login.<br><br> 
	New Password:%PASSWORD%<br><br>Thanks and Regards <br> Rumbostar');

define('MIDTRANS_SERVER_KEY', 'VT-server-MCq3qIApXLdYbbMHQrG9g5C8');

///opt/lampp/htdocs/rumbo-star/assets/css/front


