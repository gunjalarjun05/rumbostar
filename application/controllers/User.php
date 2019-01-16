<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('social_media');
        // Load facebook library
        $this->load->library('template');
       
        //$this->authUrl = $this->facebook->login_url();
    }
    
    public function register($referral_code = null, $user_id = null, $invite_user_id = null){
        
          /*echo $referral_code;
          echo '=========='.$user_id;
          echo '==========='.$invite_user_id;exit;*/
        if(is_front_session_set() == true){
         redirect("/");exit;
        } 
        
        if($this->input->post('regsubmit') == "Register"){

            $this->form_validation->set_rules('first_name', 'first_name', 'required');
            $this->form_validation->set_rules('last_name', 'last_name', 'required');
            //$this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique['.USERS.'.users_email]');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
            $this->form_validation->set_rules('conpassword', 'conpassword', 'required|matches[password]');
            $this->form_validation->set_rules('countries', 'countries', 'required');
            $this->form_validation->set_rules('number', 'number', 'required|numeric|min_length[10]|max_length[14]');
            
            if ($this->form_validation->run()){   
                $first_name=$this->input->post('first_name');
                $last_name=$this->input->post('last_name');
                $country_code=$this->input->post('countries');
                $email=$this->input->post('email');
                $password=$this->input->post('password');
                $number=$this->input->post('number');
                $referral_code = uniqid();
                $friend_referral_id = $this->input->post('referral_code');
                $parent_user_id = $this->input->post('parent_user_id');
                $invite_referral_code_id = $this->input->post('invite_referral_code_id');

                $newpass=md5($password);
                $verificationCode=get_random_string(); 
                $user_updated_date=date("Y-m-d H:i:s");

                $data= array('first_name'=>$first_name,'last_name'=>$last_name,'users_name' => $first_name,'users_email' => $email,'users_psw'=> $newpass,'country_code'=>$country_code,'users_num'=> $number,'users_verification_code'=>$verificationCode,'users_updated_date'=>$user_updated_date,'my_referral_code'=>$referral_code,'friend_referral_id'=>$friend_referral_id,'parent_user_id'=>$parent_user_id, 'invite_referral_code_id'=>$invite_referral_code_id);
               //echo '<pre>';
               // print_r($data);exit;
                if($this->master_db->insert(USERS,$data)){
                    $link=site_url().'user-verification/'.encode_string($verificationCode);
                    $msgbody=str_replace("%USER_NAME%", $first_name, USER_BODY);
                    $msgbody=str_replace("%LINK%", $link, $msgbody);

                    send_email($email,USER_REG_SUBJECT,$msgbody);
                    $msgArr = array(
                        "status"=>"success",
                        "msg"=>"Thank you. You have registered successfully on rumbostar.Please check your mail for account verification"
                        );
                   // print_r($msgArr);exit;
                    $this->session->set_flashdata($msgArr);
                    redirect('user-register');
                }     
            }
            
        }
       
        // $this->load->library('template');
        
        $data = array();
        //$data['auth_url'] = $this->authUrl;
        //sk added following 2 line for show country code in dropbox 21-12-2017
        $countriesdata = $this->master_db->select('*',COUNTRIES);        
        $data['countrries_codedata'] = $countriesdata;
        //echo "<pre>";
       // $this->load->library('session');
       // print_r($this->session->userdata('referral_code'));
        /*if($this->session->userdata('referral_code') != ''){
           $data['referral_code'] = $this->session->userdata('referral_code'); 
        }*/
        if($user_id != '' && $invite_user_id != ''){
          /* $parent_user_id =  ($user_id);
           $invite_user_id = ($invite_user_id);*/
           //echo $parent_user_id;exit;
           $data['parent_user_id'] = $user_id;
           $data['invite_user_id'] = $invite_user_id;
        }
       
        
        $this->template->write('title', 'Register');
        //$this->template->write('headerCss',$css);
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'register', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();  
    }

    public function login() {
   
        $this->load->library('facebook');
        $authUrl = $this->facebook->login_url();
        //echo 'ff : '.$authUrl; 

       if(is_front_session_set() == true){
         redirect("/");exit;
        } 
        
        //echo phpinfo();exit;
      /*  $datas = $this->social_media->facebook_login();
       print_r($datas['authUrl']);exit;*/
        $this->load->library('template');
        $data = array();
        
        $data['auth_url'] = $authUrl;
        $this->template->write('title', 'Login');
        //$this->template->write('headerCss',$css);
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'login', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
    }

    public function checklogin($book = null){
     
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $varlidationError = array();
        $user ='';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
        if($this->form_validation->run() == true){
            $this->load->model('user_model','user');
 
            $chkRes = $this->user->check_user_front($this->input->post('email'),$this->input->post('password'));
            //echo $this->db->last_query();die;
            //print_r($chkRes);die;
            if(isset($chkRes[0]->is_verified) && $chkRes[0]->is_verified !=1){
                $status = 'error';
                $msg ="Please verify email address first.";
            }else if(isset($chkRes[0]->users_status) && $chkRes[0]->users_status =='DACTIVE'){                
                $status = 'error';
                $msg ="Your account has been deactivated. Please contact to admin.";
            }else if($chkRes){
               
                $status = 'success';
                $msg = 'User loggined in successfully.';
                $user = $this->session->userdata(USER_SESSION.'user_type');

            }else{
                $status = 'error';
                $msg = 'Email address or password is incorrect.';
            }            
        }else{ 
            $status = 'error';
            //$msg ='Oops! error please try agin';
            $msg ='';
            $varlidationError["email"] = strip_tags(form_error('email'));
            $varlidationError["password"] = strip_tags(form_error('password'));
        }
        //print_r($status);exit;
        echo json_encode(array("status"=>$status,"msg"=>$msg,"varlidationError"=>$varlidationError,"user"=>$user));die;
    }

    public function verification(){
      $verificationCode = decode_string($this->uri->segment(2));

        if($verificationCode !=''){
            //echo 'hii';exit;
            $dataArr = array(
                                "users_verification_code"=>null,
                                "is_verified" =>'1',
                                "users_status" => 'ACTIVE'
                            );
          
            $statusRes = $this->master_db->select('user_id,users_name,users_email,users_type',USERS,array("users_verification_code"=>$verificationCode));
             
            if(count($statusRes)>0){

                $insRec = $this->master_db->update(USERS,$dataArr,array("users_verification_code"=>$verificationCode));
                $msgArr = array(
                                        'msg'=>'User verified successfully.',
                                        'msg_type'=>'success'
                                    );
            }else{                
                $msg = "User already activated";
                $msg_type = 'error';
                $msgArr = array(
                                    'msg'=>$msg,
                                    'msg_type'=>$msg_type
                                );  
            }
        }else{            
            $msg = GENERAL_ERROR_MSG;
            $msg_type = 'error';
            $msgArr = array(
                                'msg'=>$msg,
                                'msg_type'=>$msg_type
                            );  
        }
        $this->session->set_flashdata($msgArr);
        redirect('user-login');exit;
        // redirect('/');exit;
    }

    public function forgotpassword(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->load->model('user_model');
        if(!isset($_POST['emailid']) && trim($_POST['emailid']) ==''){
                echo "Please enter email address.";die;
        }
        $emailid = trim($_POST['emailid']);
        $checkemilid = $this->user_model->check_user_email($emailid);
        if($checkemilid){
            //upadate password
            if($checkemilid[0]->is_verified !=1){
                echo "Please verify email address first.";die;
            }else if($checkemilid[0]->users_status =='DACTIVE'){
                echo "Your account has been deactivated. Please contact to admin.";die;
            }
            $get_random_string = get_random_string();
            $encodeStr = encode_string($get_random_string);
            $dataArr = array(
                                "users_verification_code"=>$get_random_string,
                                "forgot_link_time"=>date("Y-m-d H:i:s")
                            );
            $res = $this->user_model->update($dataArr,$checkemilid[0]->user_id);
            $link = site_url().'user/reset-password/'.$encodeStr;
            if($res){
                $subject = FORGOT_PSWD; 
                //echo $checkemilid[0]->users_name;die;
                $message =  str_replace('%USER_NAME%', $checkemilid[0]->users_name, FORGOT_PSWD_BODY);
                $message =  str_replace('%LINK%', $link, $message);               
                send_email($emailid,$subject,$message);
                $msg = 'Please check your mail, we have sent password reset link on your mail.';
                $msg_type = 'success';
                $msgArr = array(
                                    'msg'=>$msg,
                                    'msg_type'=>$msg_type
                                );
                $this->session->set_flashdata($msgArr);
            }else{
                $msg ='Oops! error. Please try again.';
                $msg_type = 'error';
                $msgArr = array(
                                    'msg'=>$msg,
                                    'msg_type'=>$msg_type
                                );
                $this->session->set_flashdata($msgArr);
            }
            echo 1;die;
        }else{
            echo "Email address is not registered with us.";die;
        }
    }
    
    public function reset_password($id){
        $verificationCode = decode_string($id);       
        $statusRes = $this->master_db->select('user_id,users_name,users_email,users_type,forgot_link_time',USERS,array("users_verification_code"=>$verificationCode));
          if(isset($statusRes[0]->forgot_link_time) && $statusRes[0]->forgot_link_time !=''){
            $getTime = get_time_diffrence($statusRes[0]->forgot_link_time);
        }
        
        if(count($statusRes)>0 && $getTime<24){
            if($this->input->post('reset_pswd') == 'Update'){
                $this->form_validation->set_rules('newpswd', 'new password', 'required|min_length[6]');
                $this->form_validation->set_rules('cnewpswd', 'confirm password', 'required|matches[newpswd]');
                if ($this->form_validation->run()){
                   $oldPswdRes = $this->master_db->select('user_id,users_psw',USERS,array("user_id"=>$statusRes[0]->user_id,"users_psw"=>md5($this->input->post('newpswd'))));
                   if(count($oldPswdRes)>0){
                        $msg = "Please enter new password different from old password.";
                        $msg_type = 'error';
                        $msgArr = array(
                                            'msg'=>$msg,
                                            'msg_type'=>$msg_type
                                        ); 
                        $this->session->set_flashdata($msgArr);
                        redirect('user/reset-password/'.$id);exit;
                   }
                    $dataArr = array(
                                "users_verification_code"=>null,
                                "users_psw"=>md5($this->input->post('newpswd'))
                            );
                    $insRec = $this->master_db->update(USERS,$dataArr,array("users_verification_code"=>$verificationCode));
                    $msgArr = array(
                                    'msg'=>'Password reset successfully.',
                                    'msg_type'=>'success'
                                );
                    $this->session->set_flashdata($msgArr);
                    redirect('user-login');exit;
                }                
            }                
        }else{
            $msg = "Link has expired.";
                    $msg_type = 'error';
                    $msgArr = array(
                                        'msg'=>$msg,
                                        'msg_type'=>$msg_type
                                    ); 
            $this->session->set_flashdata($msgArr);
            redirect('user-login');exit;
        }
        $this->load->library('template');
        $data = array();
        $this->template->write('title', 'Reset Password');
        //$this->template->write('headerCss',$css);
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'reset-password', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
    }

    public function logout(){
        $this->load->model('user_model','user');
        $this->user->unset_user_session(USER_SESSION);
        redirect('/');exit;
    }
    
     // ---------------- Amol Avantkar 22-12-2016 --------------------//
    public function social_redirect_apply_acc($media){
	
      //facebook start
        $this->load->library('facebook');
        if($media == 'facebook'){          
            
             $userData = array();
              // Check if user is logged in
            if($this->facebook->is_authenticated()){
                // Get user facebook profile details
                $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture'); 
                //echo '<pre>';
                 
                if(isset($userProfile['email']) && $userProfile['email'] !='')
                {
                    $userDataemail = $userProfile['email'];
                }else{                   
                    $userDataemail = '';
                }
                        
                // Preparing data for database insertion
                $userData['oauth_provider'] = 'facebook';
                $userData['oauth_uid'] = $userProfile['id'];
                $userData['first_name'] = $userProfile['first_name'];
                $userData['last_name'] = $userProfile['last_name'];
                $userData['email'] = $userDataemail;
                //$userData['email'] = ($userProfile['email'])? $userProfile['email']: '';
                $userData['gender'] = $userProfile['gender'];
                $userData['locale'] = $userProfile['locale'];
                $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
                $userData['picture_url'] = $userProfile['picture']['data']['url'];    
           
                if(count($userData) > 0)
                {
                    $this->load->model('user_model'); 
                    if(isset($userData['oauth_uid']) && $userData['oauth_uid']!='' && $userData['oauth_provider'] == 'facebook'){ 
                  
                    //sk : select query user for user register/login for fb and enter check in our database if yes fetch values and set session or not in our db go else section 6-12-2017
                   $result = $this->master_db->select('user_id,users_name,users_email,users_num,users_reg_date,users_status,users_type,social_media_id,user_from,my_referral_code,friend_referral_id,users_updated_date',USERS,array('social_media_id'=>$userData['oauth_uid']));
                   

                    if(count($result)>0)
                    {
                        if($result[0]->my_referral_code == ''){
                            $my_referral_code = '';
                        }else{
                            $my_referral_code = $result[0]->my_referral_code;
                        }
                        if(isset($result[0]->country_code) && $result[0]->country_code != ''){
                            $countryCode = $result[0]->country_code;
                        }else{
                            $countryCode = '';
                        }
                        //print_r($result[0]->user_id);exit;
                        $setSessArr = array(
                                        "user_id"=>$result[0]->user_id,
                                        "users_name"=>$result[0]->users_name,
                                        "users_email"=>$result[0]->users_email,
                                        "country_code" =>$countryCode,
                                        "users_num"=>'',
                                        "users_type"=>$result[0]->users_type,
                                        "users_from"=>$result[0]->user_from,
                                       // "my_referral_code"=>$my_referral_code,
                                        "users_updated_date"=>$result[0]->users_updated_date
                                    );
                        //print_r($setSessArr);exit;
                        $this->user_model->set_user_sesssion($setSessArr);

                    }else{
                        // print_r($userData);exit;
                        $updated_date = date('Y-m-d H:i:s');
                        $password = get_random_string();
                        //following if condition use for if facebook login to phone number the email id not in facebook register the go else and pass blank email id. smita - 19-12-2017
                       if($userData['email'] != ''){                        
                             $emailFB = $userData['email'];
                          }else{                            
                            $emailFB = '';
                          }
                          //echo '<pre>';
                         // print_r($this->session->userdata());exit;
                        /*if($this->session->userdata('social_user_type') == 'USER'){
                           $my_referral_code = uniqid();
                        }else{
                           $my_referral_code = ''; 
                        }*/
                         if($this->session->userdata('social_user_type') != ''){
                            $social_userType = $this->session->userdata('social_user_type');
                        }else{
                            $social_userType = 'USER';
                        }

                        $dataArr = array(
                                    "first_name"=>$userData['first_name'],
                                    "last_name" => $userData['last_name'],
                                    "users_name"=>$userData['first_name']." ".$userData['last_name'],
                                     "users_email"=> $emailFB,                               
                                    "users_num"=>'',
                                    "users_updated_date"=>$updated_date,
                                    "users_psw"=>md5($password),
                                    "users_verification_code"=>'',
                                    "users_status"=>'ACTIVE',
                                    "is_verified"=>'1',
                                    "user_from"=>$userData['oauth_provider'],
                                    "users_type"=> $social_userType,
                                    "users_verification_code"=>'',
                                   // "my_referral_code"=> $my_referral_code,
                                    "social_media_id"=>$userData['oauth_uid']
                                );
                        $insRec = $this->master_db->insert(USERS,$dataArr);
                        $setSessArr = array(
                                        "user_id"=>$insRec,
                                        "users_name"=>$userData['first_name']." ".$userData['last_name'],
                                        "users_email"=>$userData['email'],
                                        "users_num"=>'',
                                        "users_type"=>$social_userType,
                                        "users_from"=>$userData['oauth_provider'],
                                        "users_updated_date"=>$updated_date
                                    );
                        //print_r($setSessArr);exit;
                        $this->user_model->set_user_sesssion($setSessArr);
                        
                    }                    
                }  
                    redirect("/");exit;  
                }
                // Get logout URL
               // $data['logoutUrl'] = $this->facebook->logout_url();
            }
        }  //facebook end
        else{

            $this->load->model('user_model'); 
           // google and twitter login code start here 
            if(isset($_GET['error']) && $media == 'facebook' && $_GET['error'] == 'access_denied'){
             redirect('user-login');exit;
            }
            
            if($media == 'google' || $media == 'linkedin' ){
                //print_r('media');

                if(isset($_GET['error']) && $_GET['error']!='' ){
                    redirect('user-login');exit;
                }
            }
        }
      
    if(isset($_GET['denied']) && $media == 'twitter' && $_GET['denied'] != ''){
             redirect('user-login');exit;
        }
        $this->load->library('social_media');
        // print_r($media);
        $user = $this->social_media->login($media);     
       // print_r($user);exit;
        if(isset($user) && count($user)<=0) {       
            redirect('user-login');exit;
        }
     
       if($user['id'] == '')
       {
            $userId = '0';
       }else{
        $userId = $user['id'];
       }
       //echo '==========================';
      // echo $userId;
        $result = $this->master_db->select('user_id,users_name,users_email,users_num,users_reg_date,users_status,users_type,social_media_id,user_from,users_updated_date',USERS,array('social_media_id'=>$userId));
        // echo '<pre>';
         //print_r($result);
        //print_r(count($result));exit;
        if(count($result)<=0){ 
           
               /* twitter is not provided email id thats why set following condition for twitter with redirect 13-12-2017*/ 
                if(isset($user['id']) && $user['id'] != '' && $user['social_name'] == 'twitter_login'){
                   
                  //  print_r($this->session->userdata());exit;
                    if($this->session->userdata('social_user_type') != ''){
                        $social_userType = $this->session->userdata('social_user_type');
                    }else{
                        $social_userType = 'USER';
                    }
                    $updated_date = date('Y-m-d H:i:s');
                    $password = get_random_string();
                    $dataArr = array(
                            "first_name"=>$user['fname'],
                            "last_name"=>$user['lname'],
                            "users_name"=>$user['fname']." ".$user['lname'],
                            "users_email"=>$user['email'], //sk add twitter email issue resolved
                            "users_num"=>'',
                            "users_updated_date"=>$updated_date,
                            "users_psw"=>md5($password),
                            "users_verification_code"=>'',
                            "users_status"=>'ACTIVE',
                            "is_verified"=>'1',
                            "user_from"=>$user['oauth_provider'],
                            "users_type"=>$social_userType,
                            "users_verification_code"=>'',
                            "social_media_id"=>$user['id']
                        );
                $insRec = $this->master_db->insert(USERS,$dataArr);
                $setSessArr = array(
                                "user_id"=>$insRec,
                                "users_name"=>$user['fname']." ".$user['lname'],
                                "users_email"=>$user['email'],
                                "users_num"=>'',
                                "users_type"=>$social_userType,
                                "users_from"=>'twitter',
				"country_code"=>'',
                                "users_updated_date"=>$updated_date
                            );
                //print_r($setSessArr);exit;
                $this->user_model->set_user_sesssion($setSessArr);
                redirect("/");exit; 
                }else if(isset($user['id']) && $user['id'] != '' && $user['social_name'] == 'google_login'){
                    
                    if($this->session->userdata('social_user_type') != ''){
                        $social_userType = $this->session->userdata('social_user_type');
                    }else{
                        $social_userType = 'USER';
                    }

                    $updated_date = date('Y-m-d H:i:s');
                    $password = get_random_string();
                    $dataArr = array(
                                "first_name"=>$user['fname'],
                                "last_name"=>$user['lname'],
                                "users_name"=>$user['fname']." ".$user['lname'],
                                "users_email"=>$user['email'],
                                "users_num"=>'',
                                "users_updated_date"=>$updated_date,
                                "users_psw"=>md5($password),
                                "users_verification_code"=>'',
                                "users_status"=>'ACTIVE',
                                "is_verified"=>'1',
                                "user_from"=>$user['oauth_provider'],
                                "users_type"=>$social_userType,
                                "users_verification_code"=>'',
                                "social_media_id"=>$user['id']
                            );
                    
                    $insRec = $this->master_db->insert(USERS,$dataArr);
                    $setSessArr = array(
                                    "user_id"=>$insRec,
                                    "users_name"=>$user['fname']." ".$user['lname'],
                                    "users_email"=>$user['email'],
                                    "users_num"=>'',
                                    "users_type"=>$social_userType,
                                    "users_from"=>'google',
                                    "users_updated_date"=>$updated_date
                                );
                    //print_r($setSessArr);exit;
                    $this->user_model->set_user_sesssion($setSessArr);
                    redirect("/");exit; 
                }
                else{    

                    redirect('user-login');exit;
                }
                // twitter end 
                echo 'bueee';exit;  
				if(isset($user['email']) && $user['email']==''){ 
					$user['media'] = $media;
					$this->session->set_userdata('temp_social_user_data',$user);
					redirect('user/create_social_account');exit;
				}else{                    
						$result = $this->master_db->select('user_id,users_name,users_email,users_num,users_reg_date,users_status,users_type,social_media_id,user_from,users_updated_date',USERS,array('users_email'=>$user['email']));
				}				
        }  
        
        if(isset($result[0]->users_status) && $result[0]->users_status =='DACTIVE'){
                $status = 'error';
                $msg ="Your account has been deactivated. Please contact to admin.";
                $msgArr = array(
								'msg'=>$msg,
								'msg_type'=>$status
							);
				$this->session->set_flashdata($msgArr);
				redirect('user-login');exit;
		}
        
         $this->load->model('user_model');
        if(count($result)>0){

            if(isset($result[0]->country_code) && $result[0]->country_code != ''){
                            $countryCode = $result[0]->country_code;
                        }else{
                            $countryCode = '';
                        }

             $setSessArr = array(
                                    "user_id"=>$result[0]->user_id,
                                    "users_name"=>$result[0]->users_name,
                                    "users_email"=>$result[0]->users_email,
                                    "users_num"=>$result[0]->users_num,
                                    "country_code"=>$countryCode,
                                    "users_type"=>$result[0]->users_type,
                                    "users_from"=>$result[0]->user_from,
                                    //"refferal_code"=> $result[0]->referral_code,
                                    "users_updated_date"=>$result[0]->users_updated_date
                                );
             //print_r($setSessArr);exit;
            $this->user_model->set_user_sesssion($setSessArr);

        }else{
            $updated_date = date('Y-m-d H:i:s');
            $password = get_random_string();
            $dataArr = array(
                                "users_name"=>$user['fname']." ".$user['lname'],
                                "users_email"=>$user['email'],
                                "users_updated_date"=>$updated_date,
                                "users_psw"=>md5($password),
                                "users_verification_code"=>'',
                                "users_status"=>'ACTIVE',
                                "is_verified"=>'1',
                                "user_from"=>$media,
                                "users_type"=>$this->session->userdata('social_user_type'),
                                "users_verification_code"=>'',
                                "social_media_id"=>$user['id']
                            );
            $insRec = $this->master_db->insert(USERS,$dataArr);
            $setSessArr = array(
                                    "user_id"=>$insRec,
                                    "users_name"=>$user['fname']." ".$user['lname'],
                                    "users_email"=>$user['email'],
                                    "users_num"=>'',
                                    "users_type"=>$this->session->userdata('social_user_type'),
                                    "users_updated_date"=>$updated_date
                                );
            $this->user_model->set_user_sesssion($setSessArr);
        }
        redirect("/");exit;        
    }
    
    public function create_social_account(){
			$this->load->library('template');
			$this->load->model('user_model','user');
			$data = array();
			$user = $this->session->userdata('temp_social_user_data');
			if($this->input->post('userdata') == "save"){
				$this->form_validation->set_rules('phone', 'phone', 'required|numeric|min_length[12]|max_length[12]');
				$this->form_validation->set_rules('emailid', 'email address', 'trim|required');
				if ($this->form_validation->run()){
					$number=$this->input->post('phone'); 
					$emailid=$this->input->post('emailid'); 	 				
					$updated_date = date('Y-m-d H:i:s');
					$password = get_random_string();
					$result = $this->master_db->select('user_id,users_name,users_email,users_num,users_reg_date,users_status,users_type,social_media_id,user_from,users_updated_date',USERS,array('users_email'=>$emailid)); 
                    // sk print_r($result);exit;
					if(count($result)>0){
						$setSessArr = array(
                                    "user_id"=>$result[0]->user_id,
                                    "users_name"=>$result[0]->users_name,
                                    "users_email"=>$result[0]->users_email,
                                    "users_num"=>$result[0]->users_num,
                                    "users_type"=>$result[0]->users_type,
                                    "users_updated_date"=>$result[0]->users_updated_date
                                );
						$this->user->set_user_sesssion($setSessArr); 
					}else{
						$dataArr = array(
										"users_name"=>$user['fname']." ".$user['lname'],
											"users_email"=>$emailid,
											"users_num"=>$number,
											"users_updated_date"=>$updated_date,
											"users_psw"=>md5($password),
											"users_verification_code"=>'',
											"users_status"=>'ACTIVE',
											"is_verified"=>'1',
											"user_from"=>$user['media'],
											"users_type"=>"USER",
											"users_verification_code"=>'',
											"social_media_id"=>$user['id']
										);
						$insRec = $this->master_db->insert(USERS,$dataArr);
						$setSessArr = array(
												"user_id"=>$insRec,
												"users_name"=>$user['fname']." ".$user['lname'],
												"users_email"=>$emailid,
												"users_num"=>$number,
												"users_type"=>'USER',
												"users_updated_date"=>$updated_date
											);
						$this->user->set_user_sesssion($setSessArr);
						
						$adminMailData = array();
						$subject = "Password for Rumbostar";
						$adminMailData['welcomemsg'] = 'Hi <b>'.$user['fname'].' '.$user['lname'].'</b>,<br/>Your account is created on rumbostar.<br/>';
						$adminMailData['mailInfoKey'] = array(
															'Email_ID'=>$emailid,
															"Password"=>$password,
														);
						$adminMailBody = $this->load->view('mail-template/email-temp-new',$adminMailData,TRUE);
						$sendMail = send_email($emailid,$subject,$adminMailBody);  
					
						$msgArr = array(
								"status"=>"success",
								"msg"=>"Account created sucessfully. Please check your email for password."
								);
						$this->session->set_flashdata($msgArr);
					}					
					redirect('user-profile');
				}else{
						echo validation_errors();
				}     
			}
			$data['userinfo'] = $user;
			$this->template->write('title','Rumbostar Social account creation');
			$this->template->write_view('header','includes/header', '', TRUE);
			$this->template->write_view('content','social-profile', $data, TRUE);
			$this->template->write_view('footer','includes/footer', '', TRUE);
			$this->template->render();
	}

     public function userprofile(){
        
        if(is_front_session_set() == false){
         redirect("user-login");exit;
        } 
  
        $this->load->library('template');
        $this->load->library('form_validation');
        $this->load->model('user_model','user');
        $data = array();
        // echo '<pre>'; 
   
        if($this->input->post('userdata') == "Save"){ 
                 
            $this->form_validation->set_rules('first_name', 'first_name', 'required');
            $this->form_validation->set_rules('last_name', 'last_name', 'required');           
			//$this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
             $this->form_validation->set_rules('countries', 'countries', 'required');
			$this->form_validation->set_rules('phone', 'phone', 'required|numeric|min_length[10]|max_length[14]');
             $this->form_validation->set_rules('birth_date', 'birth_date', 'required');

             $this->form_validation->set_rules('gender', 'gender', 'required');
             $this->form_validation->set_rules('passport_no', 'passport_no', 'required');
             $this->form_validation->set_rules('card_type', 'card_type', 'required');
             $this->form_validation->set_rules('card_number', 'card_number', 'required');
             $this->form_validation->set_rules('card_holder_name', 'card_holder_name', 'required');
             $this->form_validation->set_rules('expiry', 'expiry', 'required');

//print_r($this->input->post());exit;



            //echo '<pre>';
           //print_r($this->form_validation->run());exit;
            if ($this->form_validation->run()){ 
                 //print_r($this->form_validation->run());exit;
                $first_name=$this->input->post('first_name');
                $last_name=$this->input->post('last_name');
                $name=$this->input->post('first_name');
                $email=$this->input->post('email');
                $country_code=$this->input->post('countries');
                $number=$this->input->post('phone'); 
                $birth_date=$this->input->post('birth_date');
                $gender=$this->input->post('gender');
                $passport_no=$this->input->post('passport_no');
                $card_id=$this->input->post('card_type');
                $card_number=$this->input->post('card_number');
                $card_holder_name=$this->input->post('card_holder_name');
                $card_expiry_date=$this->input->post('expiry');
                $user_updated_date=date("Y-m-d H:i:s");

                $data= array('first_name' => $first_name,'last_name' => $last_name,'users_name' => $name, 'users_email'=>$email, 'country_code'=>$country_code, 'users_num'=> $number,'birth_date'=>$birth_date,'gender'=>$gender,'passport_no'=>$passport_no,'card_id'=>$card_id,'card_number'=>$card_number,'card_holder_name'=>$card_holder_name,'card_expiry_date'=>$card_expiry_date,'users_updated_date'=>$user_updated_date);
            //print_r($data);exit;
                $this->user->updateuser_info($data);
                $msgArr = array(
                        "status"=>"success",
                        "msg"=>"User account details updated sucessfully."
                        );

                $this->session->set_flashdata($msgArr);
                redirect('user-profile');
                }     
            }
            //echo 'hiii';
             //print_r($this->user->get_userinfop());exit;
        $data['userinfo'] = $this->user->get_userinfop();
        $data['userinfoView'] = $this->user->get_userinfobyId();
        //print_r($data);
        //print_r($data);exit;
        //sk added following 2 line for show country code in dropbox 21-12-2017
        $countriesdata = $this->master_db->select('*',COUNTRIES);   
        $cardsDetails = $this->master_db->select('*',CARDS);

        $data['countrries_codedata'] = $countriesdata;
        $data['cardsDetails'] = $cardsDetails;
        $data['blhistory'] = $this->master_db->select('*',WALLET_HISTORY,array("userid"=>$this->session->userdata(USER_SESSION.'user_id')));
        $this->template->write('title','Rumbostar');
        $this->template->write_view('header','includes/header', $data, TRUE);
        $this->template->write_view('content','user-profile', $data, TRUE);
        $this->template->write_view('footer','includes/footer', '', TRUE);
        $this->template->render();
    }

    /* @author : Smita
     * @function use : myprofileView function use for show My profile  details
     * @date : 22-12-2017
    */
    public function myprofileView(){        

        if(is_front_session_set() == false){
         redirect("user-login");exit;
        } 
  
        $this->load->library('template');
        $this->load->model('user_model','user');
        $data = array();
        $data['userinfoView'] = $this->user->get_userinfobyId();
        $data['blhistoryView'] = $this->master_db->select('*',WALLET_HISTORY,array("userid"=>$this->session->userdata(USER_SESSION.'user_id')));

        $this->template->write('title','Rumbostar');
        $this->template->write_view('header','includes/header', $data, TRUE);
        $this->template->write_view('content','my-profile-view', $data, TRUE);
        $this->template->write_view('footer','includes/footer', '', TRUE);
        $this->template->render();
    }

    /* author : Smita
     * function use : my_wallet function use for show wallet from
     * date : 29-12-2017
    */

    public function my_wallet(){

        if(is_front_session_set() == false){
            redirect("user-login");exit;
        }
            $this->load->library('template');
            $data = array();           

            $this->template->write('title','Rumbostar');
            $this->template->write_view('header','includes/header', $data, TRUE);
            $this->template->write_view('content','my-wallet', $data, TRUE);
            $this->template->write_view('footer','includes/footer', '', TRUE);
            $this->template->render();
    }
       
    /* author : Smita
     * function use : change_password_setting function use for show change password  from
     * date : 29-12-2017
     */
    public function change_password_setting(){

       if(is_front_session_set() == false){
            redirect("user-login");exit;
        } 

        $this->load->library('template');
        $data = array();         

        $this->template->write('title','Rumbostar');
        $this->template->write_view('header','includes/header', $data, TRUE);
        $this->template->write_view('content','change-password', $data, TRUE);
        $this->template->write_view('footer','includes/footer', '', TRUE);
        $this->template->render();
    }     
    

    public function add_balance(){
        if(is_front_session_set() == false){
            redirect("user-login");exit;
        } 
        if($this->input->post('add_balance_submit') == "add_balance"){
            
            $this->form_validation->set_rules('add_balance', 'balance', 'required|numeric');
            if ($this->form_validation->run()){
                $this->load->library('veritrans');
                 $this->load->model('user_model','user');
                  $params = array('server_key' => 'your_server_key', 'production' => false);
                $this->veritrans->config($params);
                $balance=$this->input->post('add_balance');
                $userinfo = $this->user->get_userinfop();
                    $transaction_details = array(
                        'order_id' => uniqid(),
                        'gross_amount'=>str_replace(',','',$balance),
                    );
                    // Populate customer's Info
                    $customer_details = array(
                        'first_name' => $userinfo[0]->users_name,
                        'email' => $userinfo[0]->users_email,
                        'phone' => $userinfo[0]->users_num,
                        );
                    $transaction_data = array(
                        'payment_type' => 'vtweb', 
                        'vtweb' => array(
                        "notification_url" => "http://exceptionaire.co/rumbostar/bookings/notification",
                        "finish_redirect_url" => "http://exceptionaire.co/rumbostar/bookings/notification",
                        "unfinish_redirect_url" => "http://exceptionaire.co/rumbostar/bookings/notification",
                        "error_redirect_url" => "http://exceptionaire.co/rumbostar/bookings/notification"
                        ),
                        'transaction_details'=> $transaction_details,
                        'customer_details' => $customer_details,
                        'custom_field1' => $userinfo[0]->user_id,
                        'custom_field2' => 'add_balance'
                    );
                    try
                    {
                        $vtweb_url = $this->veritrans->vtweb_charge($transaction_data);
                        header('Location: ' . $vtweb_url);
                    } 
                    catch (Exception $e) 
                    {
                        echo $e->getMessage();  
                    }
                }     
            }
    }

    public function change_password(){
        $this->load->model('user_model','user');
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = $dataheader = $datafooter = array();
        if(trim($_POST['hform']) == '1'){
            $oldpass = $_POST['oldpassword'];
            $newpass = $_POST['newpassword'];
            $oldPassRes = $this->user->check_old_pass($oldpass,$this->session->userdata(USER_SESSION.'user_id'));
            if($oldPassRes){    
                $dataArr = array(
                                    'users_psw'=>md5($newpass)
                                );
                $insRec = $this->user->update_passworduser($dataArr);
                $msg = 'your password has been changed successfully.';
                if($insRec){
                    $msg = $msg;
                    $msg_type = 'success';
                    $msgArr = array(
                                        'msg'=>$msg,
                                        'msg_type'=>$msg_type
                                    );
                    $this->session->set_flashdata($msgArr);
                }else{
                    $msg ='Opps! error please try agin.';
                    $msg_type = 'error';
                    $msgArr = array(
                                        'msg'=>$msg,
                                        'msg_type'=>$msg_type
                                    );
                    $this->session->set_flashdata($msgArr);
                }
            }else{
                $msg_type = 'error';
                $msg ='Old password not matched.';
            }
            echo json_encode(array("status"=>$msg_type,"msg"=>$msg));die;                   
        }
    }

    /* @author : Smita
     * @function use : mytransation use for show  
     * @date : 22-12-2017
     */

    public function mytransation(){
         if(is_front_session_set() == false){
            redirect("user-login");exit;
        } 
       // echo 'welcome';exit;
        $data = array();
        $this->load->library('template'); 
        $this->template->write('title', 'My Transation');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'my-transation', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
    }


    /* @author : Smita
     * @function use : referred_code use for show list of referal user
     * @date : 22-12-2017
     */

    public function referred_code(){
         if(is_front_session_set() == false){
            redirect("user-login");exit;
        } 
        $data = array();
        $user_id = $this->session->userdata(USER_SESSION.'user_id');
        $myFriends = $this->master_db->fetchMyReferFriends($user_id);
       
        $data['myFriends'] = $myFriends;
        $this->load->library('template'); 
        $this->template->write('title', 'Referred Code');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'referred-code', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
    }

    /* @author : Smita
     * @function use : customer_details use for show customer details via agent
     * @date : 22-12-2017
     */

    public function customer_details(){
      if(is_front_session_set() == false){
            redirect("user-login");exit;
        } 
      $data = array();
       $customer_details =  $this->master_db->select('*',CUSTOMER_DETAILS);
       $this->load->library("pagination");
        $config = array();
        $config["base_url"] = base_url() . "user/customer-details";
        $config["total_rows"] = count($customer_details);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3; 
       $this->pagination->initialize($config);
       $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["customer_details"] = $this->master_db->fetch_customer($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();


     // print_r($this->input->post());
      if($this->input->post('customerbookdata') == 'Save'){
              //echo '<pre>';
        $exitcustomer = $this->master_db->fetchCustomerbyId($this->input->post('cust_id'));
            
            //print_r($exitcustomer);exit;
            if(isset($exitcustomer) && count($exitcustomer)>0){
            //  echo '<pre>';
            // print_r($_POST);exit;
            $booking_date = $this->input->post('booking_date');
            $date=date_create($booking_date);
            $bkDate=  date_format($date,"Y-m-d H:i:s");

            $data1 = array(
                'cust_dtl_id' =>$exitcustomer[0]->id,
                'travelling_type' =>$this->input->post('travelling_way'),
                'no_of_passenger' =>$this->input->post('no_of_passenger'),
                'date_of_booking' =>$bkDate,

                );
              $insertIdnew =  $this->master_db->insert(CUSTOMER_TRAVELLING_DETAILS,$data1);

            $msgArr = array(
                "status"=>"success",
                "msg"=>"Booking details add successfully."
                );
           // print_r($msgArr);exit;
            $this->session->set_flashdata($msgArr);
            redirect('user/customer-details');
        }

      }
     

        

         
       
    
     
      
      // echo '<pre>';
        // print_r($data['customer_details']);exit;
        $this->load->library('template'); 
        $this->template->write('title', 'Customer Details');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'customer-details', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();  
    } 

    /* @author : Smita
     * @function use : new_customer use for the add new customer form 
     * @date : 22-12-2017
     */

    public function new_customer(){
         if(is_front_session_set() == false){
            redirect("user-login");exit;
        } 
       $data = array();
         

       if($this->input->post('customerdata') == 'Save'){
         
            $exitcustomer = $this->master_db->fetchCustomerbyEmailId($this->input->post('email'));
          
            if(isset($exitcustomer) && count($exitcustomer)>0){

               //  echo '<pre>';
            // print_r($_POST);exit;
         /*   $booking_date = $this->input->post('booking_date');
            $date=date_create($booking_date);
            $bkDate=  date_format($date,"Y-m-d H:i:s");

            $data1 = array(
                'cust_dtl_id' =>$exitcustomer[0]->id,
                'travelling_type' =>$this->input->post('travelling_way'),
                'no_of_passenger' =>$this->input->post('no_of_passenger'),
                'date_of_booking' =>$bkDate,

                );
              $insertIdnew =  $this->master_db->insert(CUSTOMER_TRAVELLING_DETAILS,$data1);*/

            $msgArr = array(
                "status"=>"success",
                "msg"=>"Customer alredy Exist."
                );
           // print_r($msgArr);exit;
            $this->session->set_flashdata($msgArr);
            redirect('user/add-customer');

            }else{
               // echo '<pre>';
           // print_r($this->input->post('phone'));
             $data = array(
                'cust_first_name' =>$this->input->post('first_name'),
                'cust_last_name ' =>$this->input->post('last_name'),
                'cust_email_id' => $this->input->post('email'),
                'country_id' =>$this->input->post('countries'),
                'contact_no' =>$this->input->post('phone'),
                );
             // print_r($data);exit;
             $insertId =  $this->master_db->insert(CUSTOMER_DETAILS,$data);
                
                $booking_date = $this->input->post('booking_date');
                $date=date_create($booking_date);
                $bkDate=  date_format($date,"Y-m-d H:i:s");
                //print_r($bkDate);exit;
              $data1 = array(
                'cust_dtl_id' =>$insertId,
                'travelling_type' =>$this->input->post('travelling_way'),
                'no_of_passenger' =>$this->input->post('no_of_passenger'),
                'date_of_booking' =>$bkDate,

                );
              $insertIdnew =  $this->master_db->insert(CUSTOMER_TRAVELLING_DETAILS,$data1);

              if($insertIdnew >0){

                $msgArr = array(
                        "status"=>"success",
                        "msg"=>"Customer Add successfully."
                        );
                   // print_r($msgArr);exit;
                    $this->session->set_flashdata($msgArr);
                    redirect('user/add-customer');
              }
          }
       }



        $countriesdata = $this->master_db->select('*',COUNTRIES);        
        $data['countrries_codedata'] = $countriesdata;
        $this->load->library('template'); 
        $this->template->write('title', 'New Customer');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'add-customer', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();   
    }

   /* @author : Smita
    * @function use : customer_travelling_detail function use for show customer travelling details
    * @date : 12-2-2018
    */

    public function customer_travelling_detail(){
      
        $travelling_data = $this->master_db->select('*',CUSTOMER_TRAVELLING_DETAILS,array('cust_dtl_id'=>$_POST['cust_id']),'','','','','',array('date_of_booking'=>'ASC'));
       
        echo json_encode($travelling_data);exit;
       
    }


   /* @author : Smita
    * @function use : refer_a_friend function use for show refer to friend form
    * @date : 25-1-2018
    */

    public function refer_a_friend(){
        if(is_front_session_set() == false){
            redirect("user-login");exit;
        } 
       
         $data = array();
        $this->load->library('template'); 
        $this->template->write('title', 'Refer A Friend');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'user_refer_a_friend', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render(); 
    }


   /*@author: Smita
   * @ function use: my_friend_list function use for save my google contact person
   * @date : 29-1-2018
   */

    public function my_friend_list(){

        print_r($_POST);exit;
        /*if(is_front_session_set() == false){
            redirect("user-login");exit;
        } */
    }

  /* @author: Smita
   * @ function use: referral_code function use for save referal user email id in DB
   * @date : 29-1-2018
   */

    public function referral_code(){   
        if(isset($_POST['invite_id']) && $_POST['invite_id'] != ''){

             $myfriend = $this->master_db->fetchfriendsById($_POST['invite_id']);
            // print_r($myfriend);
            if($_POST['invite_id'] >0){

                    $link= site_url().'user-register/'.$myfriend[0]->referral_code.'/'.($myfriend[0]->user_id).'/'.($myfriend[0]->id);
                       // $msgbody = str_replace("%MY_REFERAL_CODE%", $_POST['refferal_code'], FRIEND_BODY);
                    //echo $link;exit;
                     //echo '<pre>';    print_r();exit;
                     $sender_name = $this->session->userdata(USER_SESSION.'name');
                    $msgbody = str_replace("%USER_NAME%", $myfriend[0]->first_name, FRIEND_BODY);
                    $msgbody1 = str_replace("%LINK%", $link, $msgbody);
                    $msgbody = str_replace("%SENDER_NAME%", $sender_name, $msgbody1);  
               // print_r($msgbody);exit;
                    $email= $myfriend[0]->email_id;
                    send_email($email,FRIEND_REG_SUBJECT,$msgbody); 


                    $msgArr = array(
                        "status"=>"success",
                        "msg"=>"You mail send successfully."
                        );                       
                    echo json_encode($msgArr);exit;                      
                }else{
                        echo 'error';exit;              
                }
             
        }else{
           
                $data =  array(
                    'user_id' => $_POST['user_id'],
                    'referral_code'=> uniqid(), //$_POST['refferal_code']
                    'first_name' =>$_POST['first_name'],
                    'last_name' =>$_POST['last_name'],
                    'email_id' =>$_POST['email_id'],
                 ); 
                $result = $this->master_db->fetchFriendByEmailId($_POST['email_id']);
               if(isset($result) && count($result)>0){
                $msgArr = array(
                            "status"=>"fail",
                            "msg"=>"You are alredy send mail for this user"
                            );                
                echo json_encode($msgArr);exit;
                       
               }else{
                    
                    $insertId =  $this->master_db->insert(USER_INVITE_REFERRAL_CODE,$data);

                    if($insertId >0){
                        $link= site_url().'user-register/'.$_POST['refferal_code'].'/'.($_POST['user_id'].'/'.($insertId));
                       // $msgbody = str_replace("%MY_REFERAL_CODE%", $_POST['refferal_code'], FRIEND_BODY);
                        /*$msgbody = str_replace("%USER_NAME%", $_POST['first_name'], FRIEND_BODY);
                        $msgbody = str_replace("%LINK%", $link, $msgbody);*/
                         $sender_name = $this->session->userdata(USER_SESSION.'name');
                        $msgbody = str_replace("%USER_NAME%", $_POST['first_name'], FRIEND_BODY);
                        $msgbody1 = str_replace("%LINK%", $link, $msgbody);
                        $msgbody = str_replace("%SENDER_NAME%", $sender_name, $msgbody1);  
                       // print_r($msgbody);exit;
                        $email= $_POST['email_id'];
                        send_email($email,FRIEND_REG_SUBJECT,$msgbody); 
                         $msgArr = array(
                            "status"=>"success",
                            "msg"=>"You mail send successfully."
                            );
                       // print_r($msgArr);exit;
                        echo json_encode($msgArr);exit;
                        exit;
                      }else{
                        echo 'error';exit;              
                    }
                }
               
            }        
      
       }      
      
     public function userTypeSession(){  
     //print_r($_POST);exit;   
        $this->load->library('session');    
       $res = $this->session->set_userdata(array('social_user_type' => $_POST['user_type']));
       print_r($this->session->userdata());exit;
       
        exit;
     } 
    

    public function flight_commission(){

        if(is_front_session_set() == false){
            redirect("user-login");exit;
        } 
       
         $data = array();
        $this->load->library('template'); 
        $this->template->write('title', 'My Flight Commission');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'my_flight_commission', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render(); 

    }

    public function hotel_commission(){

        if(is_front_session_set() == false){
            redirect("user-login");exit;
        } 
       
         $data = array();
        $this->load->library('template'); 
        $this->template->write('title', 'My Hotel Commission');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'my_hotel_commission', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render(); 

    }

    public function train_commission(){

        if(is_front_session_set() == false){
            redirect("user-login");exit;
        } 
       
         $data = array();
        $this->load->library('template'); 
        $this->template->write('title', 'My Train Commission');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'my_train_commission', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render(); 

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */
