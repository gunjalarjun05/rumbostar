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
    
    public function register() {
           
        if(is_front_session_set() == true){
         redirect("/");exit;
        } 
         //echo '<pre>';
        
        if($this->input->post('regsubmit') == "Register"){
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique['.USERS.'.users_email]');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
            $this->form_validation->set_rules('conpassword', 'conpassword', 'required|matches[password]');
            $this->form_validation->set_rules('number', 'number', 'required|numeric|min_length[10]|max_length[14]');
            
            if ($this->form_validation->run()){
                
                $name=$this->input->post('name');
                $email=$this->input->post('email');
                $password=$this->input->post('password');
                $number=$this->input->post('number');
                $newpass=md5($password);
                $verificationCode=get_random_string(); 
                $user_updated_date=date("Y-m-d H:i:s");

                $data= array('users_name' => $name,'users_email' => $email,'users_psw'=> $newpass,'users_num'=> $number,'users_verification_code'=>$verificationCode,'users_updated_date'=>$user_updated_date);
                
                if($this->master_db->insert(USERS,$data)){
                    $link=site_url().'user-verification/'.encode_string($verificationCode);
                    $msgbody=str_replace("%USER_NAME%", $name, USER_BODY);
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

    public function checklogin(){
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
		
      
        $this->load->library('facebook');
        if($media == 'facebook'){
             $userData = array();
              // Check if user is logged in
            if($this->facebook->is_authenticated()){
                // Get user facebook profile details
                $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture'); 
                //echo '<pre>';
                // print_r($userProfile);      
                if(isset($userProfile['email']) &&  $userProfile['email'] !='')
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
                //print_r($userData);  
                if(count($userData) > 0)
                {
                    $this->load->model('user_model'); 
                    if(isset($userData['email']) || $userData['email']!='' && $userData['oauth_provider'] == 'facebook'){ 
                   
                    //sk select query user for user register/login for fb and enter check in our database if yes fetch values and set session or not in our db go else section 6-12-2017
                   $result = $this->master_db->select('user_id,users_name,users_email,users_num,users_reg_date,users_status,users_type,social_media_id,user_from,users_updated_date',USERS,array('users_email'=>$userData['email']));
                    if(count($result)>0)
                    {
                        //print_r($result[0]->user_id);exit;
                        $setSessArr = array(
                                        "user_id"=>$result[0]->user_id,
                                        "users_name"=>$result[0]->users_name,
                                        "users_email"=>$result[0]->users_email,
                                        "users_num"=>'',
                                        "users_type"=>'USER',
                                        "users_from"=>$userData['oauth_provider'],
                                        "users_updated_date"=>$result[0]->users_updated_date
                                    );
                        //print_r($setSessArr);exit;
                        $this->user_model->set_user_sesssion($setSessArr);

                    }else{
                //print_r($userData);exit;
                        $updated_date = date('Y-m-d H:i:s');
                        $password = get_random_string();
                        //following if condition use for if facebook login to phone number the email id not in facebook register the go else and pass blank email id. smita - 19-12-2017
                       if($userData['email'] != ''){                        
                             $emailFB = $userData['email'];
                          }else{                            
                            $emailFB = '';
                          }
                        $dataArr = array(
                                    "users_name"=>$userData['first_name']." ".$userData['last_name'],
                                     "users_email"=> $emailFB,                               
                                    "users_num"=>'',
                                    "users_updated_date"=>$updated_date,
                                    "users_psw"=>md5($password),
                                    "users_verification_code"=>'',
                                    "users_status"=>'ACTIVE',
                                    "is_verified"=>'1',
                                    "user_from"=>$userData['oauth_provider'],
                                    "users_type"=>"USER",
                                    "users_verification_code"=>'',
                                    "social_media_id"=>$userData['oauth_uid']
                                );
                        $insRec = $this->master_db->insert(USERS,$dataArr);
                        $setSessArr = array(
                                        "user_id"=>$insRec,
                                        "users_name"=>$userData['first_name']." ".$userData['last_name'],
                                        "users_email"=>$userData['email'],
                                        "users_num"=>'',
                                        "users_type"=>'USER',
                                        "users_from"=>$userData['oauth_provider'],
                                        "users_updated_date"=>$updated_date
                                    );
                        //print_r($setSessArr);exit;
                        $this->user_model->set_user_sesssion($setSessArr);
                        
                    }
                    //$user['media'] = $media;
                    //$this->session->set_userdata('temp_social_user_data',$user);
                    //redirect('user/create_social_account');exit;
                    }/*else{
                            $result = $this->master_db->select('user_id,users_name,users_email,users_num,users_reg_date,users_status,users_type,social_media_id,user_from,users_updated_date',USERS,array('users_email'=>$user['email']));
                    }*/

                    redirect("/");exit;  
                }
                // Get logout URL
               // $data['logoutUrl'] = $this->facebook->logout_url();
            }
        }
        else{
            $this->load->model('user_model'); 
           // google and twitter login code start here 
            if(isset($_GET['error']) && $media == 'facebook' && $_GET['error'] == 'access_denied'){
             redirect('user-login');exit;
            }
            if($media == 'google' || $media == 'linkedin' ){
                if(isset($_GET['error']) && $_GET['error']!='' ){
                    redirect('user-login');exit;
                }
            }
        }
      
	if(isset($_GET['denied']) && $media == 'twitter' && $_GET['denied'] != ''){
             redirect('user-login');exit;
        }
        $this->load->library('social_media');
         //print_r($media);
        $user = $this->social_media->login($media);     
        //print_r($user);
        if(isset($user) && count($user)<=0) {       
            redirect('user-login');exit;
        }
      
       if($user['id'] == '')
       {
            $userId = '';
       }else{
        $userId = $user['id'];
       }

        $result = $this->master_db->select('user_id,users_name,users_email,users_num,users_reg_date,users_status,users_type,social_media_id,user_from,users_updated_date',USERS,array('social_media_id'=>$userId));
      //print_r($result);exit;
        if(count($result)<=0){ 
               /* twitter is not provided email id thats why set following condition for twitter with redirect 13-12-2017*/             

                if(isset($user['id']) && $user['id'] != '' && $user['social_name'] == 'twitter_login'){

                $updated_date = date('Y-m-d H:i:s');
                $password = get_random_string();
                $dataArr = array(
                            "users_name"=>$user['fname']." ".$user['lname'],
                            "users_email"=>'',
                            "users_num"=>'',
                            "users_updated_date"=>$updated_date,
                            "users_psw"=>md5($password),
                            "users_verification_code"=>'',
                            "users_status"=>'ACTIVE',
                            "is_verified"=>'1',
                            "user_from"=>$user['oauth_provider'],
                            "users_type"=>"USER",
                            "users_verification_code"=>'',
                            "social_media_id"=>$user['id']
                        );
                $insRec = $this->master_db->insert(USERS,$dataArr);
                $setSessArr = array(
                                "user_id"=>$insRec,
                                "users_name"=>$user['fname']." ".$user['lname'],
                                "users_email"=>'',
                                "users_num"=>'',
                                "users_type"=>'USER',
                                "users_from"=>'twitter',
                                "users_updated_date"=>$updated_date
                            );
                //print_r($setSessArr);exit;
                $this->user_model->set_user_sesssion($setSessArr);
                redirect("/");exit; 
                }else{
                    //echo 'else';exit;
                    redirect('user-login');exit;
                }
                // twitter end 
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

             $setSessArr = array(
                                    "user_id"=>$result[0]->user_id,
                                    "users_name"=>$result[0]->users_name,
                                    "users_email"=>$result[0]->users_email,
                                    "users_num"=>$result[0]->users_num,
                                    "users_type"=>$result[0]->users_type,
                                    "users_from"=>$result[0]->user_from,
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
                                "users_type"=>"USER",
                                "users_verification_code"=>'',
                                "social_media_id"=>$user['id']
                            );
            $insRec = $this->master_db->insert(USERS,$dataArr);
            $setSessArr = array(
                                    "user_id"=>$insRec,
                                    "users_name"=>$user['fname']." ".$user['lname'],
                                    "users_email"=>$user['email'],
                                    "users_num"=>'',
                                    "users_type"=>'USER',
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
        $this->load->model('user_model','user');
        $data = array();
        if($this->input->post('userdata') == "save"){ 
			$this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('phone', 'phone', 'required|numeric|min_length[10]|max_length[14]');
            if ($this->form_validation->run()){ 
                $name=$this->input->post('name');
                $email=$this->input->post('email');
                $number=$this->input->post('phone'); 
                $user_updated_date=date("Y-m-d H:i:s");
                $data= array('users_name' => $name, 'users_email'=>$email, 'users_num'=> $number,'users_updated_date'=>$user_updated_date);
                $this->user->updateuser_info($data);
                $msgArr = array(
                        "status"=>"success",
                        "msg"=>"User account details updated sucessfully."
                        );

                $this->session->set_flashdata($msgArr);
                redirect('user-profile');
                }     
            }
        $data['userinfo'] = $this->user->get_userinfop();
        $data['blhistory'] = $this->master_db->select('*',WALLET_HISTORY,array("userid"=>$this->session->userdata(USER_SESSION.'user_id')));
        $this->template->write('title','Rumbostar');
        $this->template->write_view('header','includes/header', $data, TRUE);
        $this->template->write_view('content','user-profile', $data, TRUE);
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

    
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */
