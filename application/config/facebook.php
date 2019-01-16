<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Facebook API Configuration
| -------------------------------------------------------------------
|
| To get an facebook app details you have to create a Facebook app
| at Facebook developers panel (https://developers.facebook.com)
|
|  facebook_app_id               string   Your Facebook App ID.
|  facebook_app_secret           string   Your Facebook App Secret.
|  facebook_login_type           string   Set login type. (web, js, canvas)
|  facebook_login_redirect_url   string   URL to redirect back to after login. (do not include base URL)
|  facebook_logout_redirect_url  string   URL to redirect back to after logout. (do not include base URL)
|  facebook_permissions          array    Your required permissions.
|  facebook_graph_version        string   Specify Facebook Graph version. Eg v2.6
|  facebook_auth_on_load         boolean  Set to TRUE to check for valid access token on every page load.
*/

$config['facebook_app_id']              = '305550129959595';
$config['facebook_app_secret']          = '4d5f9fc7b48dd582d18c0aefc588cc3b';

//$config['facebook_app_id']              = '150711062129929';
//$config['facebook_app_secret']          = 'd387e07217539baa43959d81e2638662';
$config['facebook_login_type']          = 'web';

$config['facebook_login_redirect_url']  = 'user/social_redirect_apply_acc/facebook';
//$config['facebook_login_redirect_url']  = 'user';

$config['facebook_logout_redirect_url'] = 'user/logout';

$config['facebook_permissions']         = array('email');
$config['facebook_graph_version']       = 'v2.6';
$config['facebook_auth_on_load']        = TRUE;

?>
