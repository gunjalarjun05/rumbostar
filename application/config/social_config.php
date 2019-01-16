<?php

$config['google']['clientId'] = '338528685431-btuog5cb45ltljmk6bitdvkb6ebrrcfo.apps.googleusercontent.com'; //Google CLIENT ID
$config['google']['clientSecret'] = '1s90tkDlQjYsm-vXx7ASSBWm'; //Google CLIENT SECRET
$config['google']['redirectUrl'] = 'http://exceptionaire.co/rumbostar/user/social_redirect_apply_acc/google';  //return url (url to script)
$config['google']['homeUrl'] = 'http://exceptionaire.co/rumbostar/';  //return to home

// $config['facebook']['appId'] = '442288292615529'; //Facebook App ID
// $config['facebook']['appSecret'] = 'bb2b8f6590713eaa4e4aa3dffac4b824'; // Facebook App Secret
$config['facebook']['appId'] = '150711062129929'; //Facebook App ID
$config['facebook']['appSecret'] = 'd387e07217539baa43959d81e2638662';
$config['facebook']['facebook_login_type']   = 'web'; //sk add line
$config['facebook']['facebook_graph_version']   = 'v2.6'; //sk add line
$config['facebook']['homeurl'] = 'user/social_redirect_apply_acc/facebook'; //return to home
$config['facebook']['fbPermissions'] = array('email'); //Required facebook permissions
$config['facebook']['facebook_auth_on_load']  = TRUE;
// $config['facebook']['homeurl'] = 'http://exceptionaire.co/rumbostar/user/social_redirect_apply_acc/facebook';  //return to home
// sk $config['facebook']['homeurl'] = 'http://exceptionaire.co/rumbostar/user/social_redirect_apply_acc/facebook';  //return to home


//$config['twitter']['apiKey'] = 'M19AVsiDJF5Gxz4iT1QSfeU3u'; //twitter App ID
//$config['twitter']['apiSecret'] = 'FBnzY3pHoBfX8Iqjjr6cEcHzSo1jcWHsPbBUof0RGBZaZebIJu'; // twitter App Secret
// localhost api details sk 
 //$config['twitter']['apiKey'] = 'DAD5DPxMz53LzUBOvH0X0N218'; //twitter App ID localhost sk
 //$config['twitter']['apiSecret'] = 'BsGcU6Fq3Ky3G1ahRp7PsKKKqd0BtU5vAT2sgC09Cbmwr413rN'; // twitter App Secret localhost sk
// $config['twitter']['redirectUrl'] = 'http://localhost/rumbostar/user/social_redirect_apply_acc/twitter';  //return to home  sk local api

//$config['twitter']['redirectUrl'] = 'http://exceptionaire.co/rumbostar/user/social_redirect_apply_acc/twitter';  //return to home 

//server side api details sk
$config['twitter']['apiKey'] = 'M19AVsiDJF5Gxz4iT1QSfeU3u'; //twitter App ID 
$config['twitter']['apiSecret'] = 'FBnzY3pHoBfX8Iqjjr6cEcHzSo1jcWHsPbBUof0RGBZaZebIJu'; // twitter App Secret 
$config['twitter']['redirectUrl'] = 'http://exceptionaire.co/rumbostar/user/social_redirect_apply_acc/twitter';  //return to home 

?>
