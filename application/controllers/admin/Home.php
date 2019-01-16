<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {


	public function __construct(){
		parent:: __construct();	
		$params = array('default_template' => 'admin_index');
		$this->load->library('template',$params);	
	}

	 /**
	 * Index Page for this controller.
	 *
	 */
	public function index(){
		$data = array();
        if($this->session->userdata(ADMIN_SESSION.'is_logged_in') == false && ($this->session->userdata(ADMIN_SESSION.'is_logged_in') == '') || $this->session->userdata(ADMIN_SESSION.'is_logged_in') !=1){
		$this->load->view(ADMIN_VIEWS.'includes/header-login', $data);
	    $this->load->view(ADMIN_VIEWS.'login', $data);
	   	$this->load->view(ADMIN_VIEWS.'includes/footer-login');
        } 
        else
        {
            redirect(ADMIN_CONTROLERS.'dashboard');
                exit();
        } 
	}

	public function checkadminlogin(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $varlidationError = array();
        $user ='';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');
        if($this->form_validation->run() == true){
            $this->load->model('user_model','user');
            $chkRes = $this->user->check_user($this->input->post('email'),$this->input->post('password'));
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
                $user = $this->session->userdata(ADMIN_SESSION.'user_type');
            }else{
                $status = 'error';
                $msg = 'Email address or password is incorrect.';
            }            
        }else{ 
            $status = 'error';
            $msg ='Oops! error please try agin';
            $varlidationError["email"] = strip_tags(form_error('email'));
            $varlidationError["password"] = strip_tags(form_error('password'));
        }
        echo json_encode(array("status"=>$status,"msg"=>$msg,"varlidationError"=>$varlidationError,"user"=>$user));die;
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
            $newstring=md5($get_random_string);
            $dataArr = array(
                                "users_psw"=>$newstring
                            );
            $res = $this->user_model->update($dataArr,$checkemilid[0]->user_id);
            if($res){
                $subject = FORGOT_PSWD; 
                //echo $checkemilid[0]->users_name;die;
                $message =  str_replace('%USER_NAME%', $checkemilid[0]->users_name, FORGOT_PSWD_BODY_ADMIN);
                $message =  str_replace('%PASSWORD%', $get_random_string, $message);               
                send_email($emailid,$subject,$message);
                $msg = 'Please check your mail, we have sent new password on your mail.';
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
    
    public function logout(){
        $this->load->model('user_model','user');
        $this->user->unset_user_session(ADMIN_SESSION);
        redirect(ADMIN_CONTROLERS);exit;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */
