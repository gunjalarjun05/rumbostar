<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Library Name : Social_media
	Description	: This library containg social media login,sharing post using php sdk and restfull api
*/

class Social_media{
	var $CI;
	public function __construct(){
		 $this->CI =& get_instance();
		  $this->CI->load->library('session');
		//  $this->load->library('facebook'); //sk add line
	}
	public function login_url($socialMediaName=false){
		switch ($socialMediaName) {
			case 'facebook':
				return $this->facebook_login_url();
				break;
			case 'google':
				return $this->google_login_url();
				break;
			case 'linkedin':
				return $this->linkedin_login_url();
				break;
			case 'twitter':
				return $this->twitter_login_url();
				break;
			default:
				return '';
		}
	}
	public function facebook_login_url(){
		require(APPPATH.'config/social_config.php');
		//include_once("facebook-php-sdk/facebook.php");
		include_once(APPPATH."third_party/inc/facebook.php");
		$fbConfArr = $config['facebook'];
		$facebook = new Facebook(array(
		  'appId'  => $fbConfArr['appId'],
		  'secret' => $fbConfArr['appSecret']
		));
		return $loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$fbConfArr['homeurl'],'scope'=>$fbConfArr['fbPermissions']));
	}
	public function google_login_url(){
		require(APPPATH.'config/social_config.php');
		include_once(APPPATH."third_party/src/Google_Client.php");
		include_once(APPPATH."third_party/src/contrib/Google_Oauth2Service.php");
		$gClient = new Google_Client();
		$gClient->setApplicationName('Login to codexworld.com');
		$gClient->setClientId($config['google']['clientId']);
		$gClient->setClientSecret($config['google']['clientSecret']);
		$gClient->setRedirectUri($config['google']['redirectUrl']);
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		return $gClient->createAuthUrl();
	}
	public function linkedin_login_url(){
		require(APPPATH.'config/social_config.php');
		return 'https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id='.$config['linkedin']['Client_ID'].'&redirect_uri='.$config['linkedin']['callback_url'].'&state=98765EeFWf45A53sdfKef4233&scope=r_basicprofile r_emailaddress';
	}

	public function twitter_login_url($type=false){
		require(APPPATH.'config/social_config.php');
		require(APPPATH.'third_party/twitter-inc/twitteroauth.php');
		//require_once(APPPATH.'third_party/twitter-inc/autoload.php');
		$twitterConfArr = $config['twitter'];
		//print_r($twitterConfArr);exit;
		$connection = new TwitterOAuth($twitterConfArr['apiKey'], $twitterConfArr['apiSecret']);
		$request_token = $connection->getRequestToken($twitterConfArr['redirectUrl'].'?type='.$type);

		$_SESSION['token'] 			= $request_token['oauth_token'];
		$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
		
		//Any value other than 200 is failure, so continue only if http code is 200
		if($connection->http_code == '200'){
			//redirect user to twitter
			$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
			return $twitter_url; 
		}else{
			return '';
		}
	}
	public function login($socialMediaName=false){

		switch ($socialMediaName) {
			case 'facebook':
				return $this->facebook_login();
				break;
			case 'google':
				return $this->google_login();
				break;
			case 'linkedin':
				return $this->linkedin_login();
				break;
			case 'twitter':
				return $this->twitter_login();
				break;
			default:
				return array("error"=>"Please provide social media name");
		}
	}
	public function facebook_login(){
		//echo 'welcome';exit;
		 $ci =& get_instance();
		$ci->load->library('Facebook');
		$user_profile = array();
		print_r($ci->facebook->is_authenticated());
		//$fbuser = $ci->facebook->request();
		
       /* $userData = array();
        // Check if user is logged in
        if($ci->facebook->is_authenticated()){
            // Get user facebook profile details
            $userProfile = $ci->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
				print_r($userProfile);die();
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
            $userData['gender'] = $userProfile['gender'];
            $userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
            $userData['picture_url'] = $userProfile['picture']['data']['url'];

            // Insert or update user data
            $userID = $this->user->checkUser($userData);

            // Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            }else{
               $data['userData'] = array();
            }

            // Get logout URL
            $data['logoutUrl'] = $ci->facebook->logout_url();
        }else{
            $fbuser = '';

            // Get login URL
            $data['authUrl'] =  $ci->facebook->login_url();
        }
        return $data;*/


        //print_r($data);exit;
        // Load login & profile view
        //$ci->load->view('http://localhost/rumbostar',$data);

		/*if($fbuser){
			$User = $ci->facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
			$user_profile['id']             = isset($User['id']) ? $User['id'] : '';
			$user_profile['fname']      = isset($User['first_name']) ? $User['first_name'] : '';
			$user_profile['lname']       = isset($User['last_name']) ? $User['last_name'] : '';
			$user_profile['email']   = isset($User['email']) ? $User['email'] : '';
			$user_profile['pictureUrls']    = isset($User['picture']['data']['url']) ? $User['picture']['data']['url'] : '';	
			//echo  '<pre>===sk'; 
			//print_r($user_profile);exit;				
			return $user_profile;
		}else{
			// $loginUrl = $ci->facebook->getLoginUrl(array('redirect_uri'=>$fbConfArr['homeurl'],'scope'=>$fbConfArr['fbPermissions']));
			// header("location:".$loginUrl);
			// $this->facebook_login();
			// $loginUrl = $ci->facebook->getLoginUrl(array ( 
			  //       'display' => 'popup',
			  //       'redirect_uri' => 'http://exceptionaire.co/rumbostar'
			  //       ));
			  //       $this->facebook_login();
		}*/
		
	}
	private function google_login(){
		require(APPPATH.'config/social_config.php');
		include_once(APPPATH."third_party/src/Google_Client.php");
		include_once(APPPATH."third_party/src/contrib/Google_Oauth2Service.php");
		$gClient = new Google_Client();
		$gClient->setApplicationName('Login to codexworld.com');
		$gClient->setClientId($config['google']['clientId']);
		$gClient->setClientSecret($config['google']['clientSecret']);
		$gClient->setRedirectUri($config['google']['redirectUrl']);
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		if(isset($_GET['code']) && $_GET['code'] !=''){
			$gClient->authenticate();
			$_SESSION['token'] = $gClient->getAccessToken();
		}
		if ($_SESSION['token']) {
			$User = $google_oauthV2->userinfo->get();
			$user_profile['id']             = isset($User['id']) ? $User['id'] : '';
			$user_profile['fname']      = isset($User['given_name']) ? $User['given_name'] : '';
			$user_profile['lname']       = isset($User['family_name']) ? $User['family_name'] : '';
			$user_profile['email']   = isset($User['email']) ? $User['email'] : '';
			$user_profile['social_name']   =  'google_login';
			$user_profile['oauth_provider'] = 'google';
			$user_profile['pictureUrls']    = isset($User['link']) ? $User['link'] : '';		
			return $user_profile;
		}else{
			return array("error"=>"Somethnig went wrong.");
		}

	}
	private function linkedin_login(){
		require(APPPATH.'config/social_config.php');
		
		if(isset($_GET['code']) && $_GET['code'] !=''){
			$url    = 'https://www.linkedin.com/uas/oauth2/accessToken';
			$param  = 'grant_type=authorization_code&code='.$_GET['code'].'&redirect_uri='.$config['linkedin']['callback_url'].'&client_id='.$config['linkedin']['Client_ID'].'&client_secret='.$config['linkedin']['Client_Secret'];
			$return = (json_decode($this->post_curl($url,$param),true));
			if(isset($return['error']) && $return['error'] !=''){
				return array("error"=>$return['error_description']);
			}else{
				$linkedinUser = array();
				$url    = 'https://api.linkedin.com/v1/people/~:(id,firstName,lastName,pictureUrls::(original),headline,publicProfileUrl,location,industry,positions,email-address)?format=json&oauth2_access_token='.$return['access_token'];
				$User   = json_decode($this->post_curl($url));
				$linkedinUser['id']             = isset($User->id) ? $User->id : '';
				$linkedinUser['fname']      = isset($User->firstName) ? $User->firstName : '';
				$linkedinUser['lname']       = isset($User->lastName) ? $User->lastName : '';
				$linkedinUser['email']   = isset($User->emailAddress) ? $User->emailAddress : '';
				$linkedinUser['pictureUrls']    = isset($User->pictureUrls->values[0]) ? $User->pictureUrls->values[0] : '';
				$linkedinUser['location']       = isset($User->location->name) ? $User->location->name : '';				
				$linkedinUser['publicProfileUrl'] = isset($User->publicProfileUrl) ? $User->publicProfileUrl : '';
				return $linkedinUser;
			}
		}else{
			return array("error"=>"Somethnig went wrong.");
		}
		
	}

	private function twitter_login(){ 
		
		if(isset($_GET['type']) && $_GET['type'] == 'share'){
			require_once(APPPATH.'config/social_config.php');
			require_once(APPPATH.'third_party/twitter-inc/twitteroauth.php');
			//require_once(APPPATH.'third_party/twitter-inc/update_with_media.php');
			$twitterConfArr = $config['twitter'];
			$connection = new TwitterOAuth($twitterConfArr['apiKey'], $twitterConfArr['apiSecret'], $_SESSION['token'] , $_SESSION['token_secret']);
			$access_token = $connection->getAccessToken($_GET['oauth_verifier']);
			if($access_token){
				$media1 = $connection->upload('media/upload', ["media" => "assets/images/logo-main.png"]);

				$parameters = [
					'status' => 'This is new file '.site_url(),
				
				];
				
				$result = $connection->post('statuses/update_with_media', $parameters);
				print_r($result);die;
			}
			//$this->share_on_twitter($access_token);
		}
		
		if(isset($_GET['oauth_token']) && $_SESSION['token']  !== $_GET['oauth_token']) {

			//If token is old, distroy session and redirect user to index.php
			return false;
			
		}elseif(isset($_GET['oauth_token']) && $_SESSION['token'] == $_GET['oauth_token']) {
			
			//Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
			require_once(APPPATH.'config/social_config.php');
			require_once(APPPATH.'third_party/twitter-inc/twitteroauth.php');
			$twitterConfArr = $config['twitter'];
			
			$connection = new TwitterOAuth($twitterConfArr['apiKey'], $twitterConfArr['apiSecret'], $_SESSION['token'] , $_SESSION['token_secret']);
			
			$access_token = $connection->getAccessToken($_GET['oauth_verifier']);
			
			
			if($connection->http_code == '200')
			{
				//Redirect user to twitter
				$_SESSION['status'] = 'verified';
				$_SESSION['request_vars'] = $access_token;
				//Insert user into the database
				$user_info = $connection->get('account/verify_credentials',['include_email' => 'true']); 
				//echo '<pre>';
				//print_r($user_info);exit;
				unset($_SESSION['token']);
				unset($_SESSION['token_secret']);
				$name = explode(" ",$user_info->name);
				$user_profile['id']             = isset($user_info->id) ? $user_info->id : '';
				$user_profile['fname']      = isset($name[0]) ? $name[0] : '';
				$user_profile['lname']       = isset($name[1]) ? $name[1] : '';
				$user_profile['email']  = ($user_info->email)?$user_info->email:'';
				$user_profile['social_name']   =  'twitter_login';
				$user_profile['oauth_provider'] = 'twitter';
				$user_profile['pictureUrls']    = isset($user_info->profile_image_url) ? $user_info->profile_image_url : '';
				$user_profile['location']       = isset($user_info->location) ? $user_info->location: '';	
					//print_r($user_profile);exit;		
				return $user_profile; 

			}else{
				
				die("error, try again later!");
			}
		}
	}
	
	public function share_on_twitter($type=false){
		
		
		
		
		$url = $this->twitter_login_url('share');
		if(!$type){
			header('Location:'.$url);exit;
		}else{
			
			
		} 
		
		
		
			//header('Location:'.$url);
		//Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
			
			
		$twitterConfArr = $config['twitter'];
			
			$connection = new TwitterOAuth($twitterConfArr['apiKey'], $twitterConfArr['apiSecret'], $_SESSION['token'] , $_SESSION['token_secret']);
			
			$access_token = $connection->getAccessToken($_GET['oauth_verifier']);
			print_r($access_token);die; 
			
			if($connection->http_code == '200')
			{
				//Redirect user to twitter
				$_SESSION['status'] = 'verified';
				$_SESSION['request_vars'] = $access_token;
				//Insert user into the database
				$user_info = $connection->get('account/verify_credentials'); 
				unset($_SESSION['token']);
				unset($_SESSION['token_secret']);
				$name = explode(" ",$user_info->name);
				$user_profile['id']             = isset($user_info->id) ? $user_info->id : '';
				$user_profile['fname']      = isset($name[0]) ? $name[0] : '';
				$user_profile['lname']       = isset($name[1]) ? $name[1] : '';
				$user_profile['email']   =  '';
				$user_profile['pictureUrls']    = isset($user_info->profile_image_url) ? $user_info->profile_image_url : '';
				$user_profile['location']       = isset($user_info->location) ? $user_info->location: '';				
				return $user_profile; 

			}else{
				die("error, try again later!");
			}


	}
	
	//funciton for curl call
	private function post_curl($url,$param=false){	
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		if($param!=false){
			curl_setopt($ch,CURLOPT_POSTFIELDS,$param);
		}			
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

}
?>
