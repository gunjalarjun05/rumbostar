<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent_management extends CI_Controller {

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
		$usertype="Agent";
		//$data['userRes'] = $this->master_db->select('user_id,users_name,users_email,users_num,users_status,users_updated_date,users_type',USERS,array("users_type"=>$usertype));

		$data['userRes'] = $this->master_db->selectQuery('user_id,users_name,users_email,users_num,users_status,users_updated_date,users_type,agent_id',USERS,array('users_type'=>$usertype),array('user_id'=>'desc'));

		/*echo '<pre>';
		print_r($this->db->last_query());
		print_r($data['userRes']);

		exit;*/
		//$data['country_code_data'] = 
		$data['usertype'] = $usertype;
		$this->template->write('title','Agent Management', TRUE);
        $this->template->write_view('header', ADMIN_VIEWS.'includes/header', $datah, TRUE);
        $this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
        $this->template->write_view('content', ADMIN_VIEWS.'agent_management', $data, TRUE);
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
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('mobile_no', 'Phone Number', 'trim|required|numeric|min_length[10]|max_length[14]');			
			if(!$id){
				$this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[8]');
				$this->form_validation->set_rules('cpass', 'Confirm Password', 'trim|required|matches[pass]');
				$this->form_validation->set_rules('emailid', 'Email', 'trim|required|valid_email|is_unique['.USERS.'.users_email]');
			}
						
			if ($this->form_validation->run() == true){//check validation
				$name = $this->input->post('name');
				$emailid = $this->input->post('emailid');
				$password = $this->input->post('pass');
				$mono = $this->input->post('mobile_no');
				$usertype = $this->input->post('usertype');
				$updated_date = date('Y-m-d H:i:s');
				$dataArr = array(
									'users_name'=>$name,								
									'users_num'=>$mono,
									'users_type'=>$usertype,
									'is_verified'=>'1',
									'users_status'=>'ACTIVE',
									'users_updated_date'=>$updated_date
								);
				if(!$id){
						$dataArr['users_psw'] = md5($password);
						$dataArr['users_email'] = $emailid;
				}
				if($id){
					$insRec = $this->master_db->update(USERS,$dataArr,array("user_id"=>$id));
					$msg = AGENT_UPDATED;
				}else{
						$insRec = $this->master_db->insert(USERS,$dataArr);
						$msg = AGENT_ADDED;
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
											"name"=>strip_tags(form_error('name')),
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
		$statusRes = $this->master_db->select('users_name,users_email,users_num,',USERS,array("user_id"=>$userid));
		
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
		$first_name = $this->input->post('username');
		$email = $this->input->post('emailid');
		$agent_code = $this->input->post('agentcode');
		if($status == 'DACTIVE'){			
			$is_verified = '0';				 
		}else{
			$is_verified = '1'; //sk add line for active user/agent admin side 27-12-2017		
		}
		if($agent_code == ''){
			$agent_id = 'ag_'.uniqid();
		}else{
			$agent_id = $agent_code; 
		}

		/*echo $userid.'======';
		echo $status.'===========';
		echo $user.'==========';
		echo $first_name.'==========';
		echo $email.'==========';
		echo $is_verified.'==========';
		echo $agent_id.'==========';
		exit;*/
		$statusRes = $this->master_db->update(USERS,array("users_status"=>$status,'is_verified'=>$is_verified, 'agent_id'=>$agent_id),array("user_id"=>$userid,"users_type"=>$user));
		if($statusRes){

			$link=site_url('user-login');
            $msgbody=str_replace("%USER_NAME%", $first_name, ACTIVE_AGENT_BODY);
            $msgbody=str_replace("%LINK%", $link, $msgbody);

            send_email($email,AGENT_REG_SUBJECT,$msgbody);
			$msg = 'Agent status has been changed successfully.';
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
			$msg = 'Agent deleted successfully.';
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

	/* @author : Smita
	 * @function use : countryinfo function use for fetch all country code for agent registrtion form
	 * @date : 14-12-2017
	 */
	public function countryinfo(){
		//echo 'hiii';exit;
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$data['countriesdata'] = $this->master_db->select('*',COUNTRIES);
			
		if($data['countriesdata']){
			$msg = '';
			$msg_type = 'success';						
		}else{
			$msg = GENERAL_ERROR_MSG;
			$msg_type = 'general_error';			
		}

		echo json_encode(array("status"=>$msg_type,"msg"=>$msg,"countriesinfo"=>$data['countriesdata']));die;
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
