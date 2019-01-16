<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_management extends CI_Controller {

	public function __construct(){
		parent:: __construct();		
		is_admin_session_set();
		$this->load->model('user_model','user');	
	    $params = array('default_template' => 'admin_index');
        $this->load->library('template',$params);
	}
	
	//---------------------------------------------------------- functinality for user management -----------------------------------------//
	// function for display user
	public function index()
	{
		$datah = array();
		$data = array();
		$dataf = array();
		$datal = array();
		$data['css'] = load_css('admin/dataTables.bootstrap.css');
		$data['js'] = load_js(array('admin/jquery.dataTables.min.js','admin/dataTables.bootstrap.min.js','admin/custome/comman_functions.js','admin/custome/manage_user.js'));
		$data['enduser'] = 1;
		$usertype="USER";
		$data['userRes'] = $this->master_db->select('user_id,users_name,users_email,users_num,my_referral_code,users_status,users_updated_date,users_type',USERS,array("users_type"=>$usertype),'','','','','',array('user_id'=>'desc'));
		//print_r($data['userRes']);
		$data['usertype'] = $usertype;
		$this->template->write('title','Users Management', TRUE);
        $this->template->write_view('header', ADMIN_VIEWS.'includes/header', $datah, TRUE);
        $this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
        $this->template->write_view('content', ADMIN_VIEWS.'users_management', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
        $this->template->render();		
	}
	//--------------------------------------------- add edit user submit function ----------------------------//
	public function add(){
		
		$data = array();
		if (!$this->input->is_ajax_request()) {
		  exit('No direct script access allowed');
		}
		$id = $this->input->post('userid');
		if($this->input->post('add_form') == 'add' || $this->input->post('add_form') == 'update'){ 
			$this->load->library('form_validation');
			$msg ='';
			$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('mobile_no', 'Phone Number', 'trim|required|numeric');			
			if(!$id){
				$this->form_validation->set_rules('pass', 'Password', 'trim|required');
				$this->form_validation->set_rules('cpass', 'Confirm Password', 'trim|required|matches[pass]');
				$this->form_validation->set_rules('emailid', 'Emailid', 'trim|required|valid_email|is_unique[imeg_users.email]');
			}
						
			if ($this->form_validation->run() == true){//check validation
				$fname = $this->input->post('fname');
				$lname = $this->input->post('lname');
				$emailid = $this->input->post('emailid');
				$password = $this->input->post('pass');
				$mono = $this->input->post('mobile_no');
				$usertype = $this->input->post('usertype');
				$updated_date = date('Y-m-d H:i:s');
				$dataArr = array(
									'fname'=>$fname,
									'lname'=>$lname,									
									'mobile_no'=>$mono,
									'user_type'=>$usertype,
									'is_verified'=>'1',
									'updated_date'=>$updated_date
								);
				if(!$id){
						$dataArr['password'] = md5($password);
						$dataArr['email'] = $emailid;
				}
				if($id){
					$insRec = $this->master_db->update(USERS,$dataArr,array("ID"=>$id));
					$msg = USER_UPDATED;
				}else{
						$insRec = $this->master_db->insert(USERS,$dataArr);
						$msg = USER_ADDED;
				}
				if($insRec){
					$msg = $msg;
					$msg_type = 'success';
					$msgArr = array(
										'msg'=>$msg,
										'msg_type'=>$msg_type
									);
					$this->session->set_flashdata($msgArr);
					
				}else{
					$msg = GENERAL_ERROR_MSG;
					$msg_type = 'general_error';
					$msgArr = array(
										'msg'=>$msg,
										'msg_type'=>$msg_type
									);
					//$this->session->set_flashdata($msgArr);
				}
				$validationError = array();
			}else{
				$msg_type = 'error';
				$validationError = array(
											"fname"=>strip_tags(form_error('fname')),
											"lname"=>strip_tags(form_error('lname')),
											"email"=>strip_tags(form_error('emailid')),
											"mobile_no"=>strip_tags(form_error('mobile_no')),
											"pass"=>strip_tags(form_error('pass')),
											"cpass"=>strip_tags(form_error('cpass'))
										);
					
			}
			echo json_encode(array("status"=>$msg_type,"msg"=>$msg,"validationError"=>$validationError));die;
		}		
	}
	
	//function for user information by using user id
	public function userinfo(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$userid = $this->input->post('id');
		$statusRes = $this->master_db->select('fname,lname,email,mobile_no,',USERS,array("ID"=>$userid));
		
		if($statusRes){
			$msg = '';
			$msg_type = 'success';						
		}else{
			$msg = GENERAL_ERROR_MSG;
			$msg_type = 'general_error';			
		}
		echo json_encode(array("status"=>$msg_type,"msg"=>$msg,"userinfo"=>$statusRes[0]));die;
	}
	
	//function for change user status
	public function change_user_status(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$userid = $this->input->post('id');
		$status = $this->input->post('status');
		$user = $this->input->post('user');
		$statusRes = $this->master_db->update(USERS,array("users_status"=>$status),array("user_id"=>$userid,"users_type"=>$user));
		if($statusRes){
			$msg = 'User status has been changed successfully.';
			$msg_type = 'success';
			$msgArr = array(
								'msg'=>$msg,
								'msg_type'=>$msg_type
							);
			$this->session->set_flashdata($msgArr);
			//$this->session->flashdata('msg');
			echo 1;die;
		}else{
			$msg ='OOps! error try again';
			$msg_type = 'error';
			$msgArr = array(
								'msg'=>$msg,
								'msg_type'=>$msg_type
							);
			$this->session->set_flashdata($msgArr);
			echo 0;exit();
		}
	} 
	
	//funciton for delete user for table
	public function delete(){
		$userid = $_POST['id'];
		$delRes = $this->master_db->delete(USERS,array("user_id"=>$userid));
		if($delRes){
			$msg = 'User deleted successfully.';
			$msg_type = 'success';
			$msgArr = array(
								'msg'=>$msg,
								'msg_type'=>$msg_type
							);
			$this->session->set_flashdata($msgArr);
			$this->session->flashdata('msg');
			
		}else{
			$msg ='Oops! error try again.';
			$msg_type = 'error';
			$msgArr = array(
								'msg'=>$msg,
								'msg_type'=>$msg_type
							);
			$this->session->set_flashdata($msgArr);
			
		}
		echo 1;
		exit();
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
