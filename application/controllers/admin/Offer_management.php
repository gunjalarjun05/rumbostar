<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer_management extends CI_Controller {

	public function __construct(){
		parent:: __construct();		
		is_admin_session_set();
		$this->load->model('user_model','user');	
		$params = array('default_template' => 'admin_index');
		$this->load->library('template',$params);
	}
	
	//---------------------------------------------------------- functinality for Hotel/Flight/Train Offer management -----------------------------------------//
	// function for display user
	public function flight_offer()
	{
		$datah = array();
		$data = array();
		$dataf = array();
		$datal = array();
		$data['css'] = load_css('admin/dataTables.bootstrap.css');
		$data['js'] = load_js(array('admin/jquery.dataTables.min.js','admin/dataTables.bootstrap.min.js','admin/custome/comman_functions.js','admin/custome/manage_user.js'));
		$data['enduser'] = 1;
		$offertype='0';
		$data['offerRes'] = $this->master_db->select('*',OFFER_MANAGEMENT,array("offer_type"=>$offertype),'','','','','',array("added_date"=>'DESC'));
		$this->template->write('title','Flight Offer Management', TRUE);
		$this->template->write_view('header', ADMIN_VIEWS.'includes/header', $datah, TRUE);
		$this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
		$this->template->write_view('content', ADMIN_VIEWS.'flight_offer_management', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
		$this->template->render();		
	}
	
	
	public function hotel_offer()
	{
		$datah = array();
		$data = array();
		$dataf = array();
		$datal = array();
		$data['css'] = load_css('admin/dataTables.bootstrap.css');
		$data['js'] = load_js(array('admin/jquery.dataTables.min.js','admin/dataTables.bootstrap.min.js','admin/custome/comman_functions.js','admin/custome/manage_user.js'));
		$data['enduser'] = 1;
		$offertype='1';
		$data['offerRes'] = $this->master_db->select('*',OFFER_MANAGEMENT,array("offer_type"=>$offertype));
		$this->template->write('title','Hotel Offer Management', TRUE);
		$this->template->write_view('header', ADMIN_VIEWS.'includes/header', $datah, TRUE);
		$this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
		$this->template->write_view('content', ADMIN_VIEWS.'hotel_offer_management', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
		$this->template->render();		
	}

	public function train_offer(){
		$datah = array();
		$data = array();
		$dataf = array();
		$datal = array();
		$data['css'] = load_css('admin/dataTables.bootstrap.css');
		$data['js'] = load_js(array('admin/jquery.dataTables.min.js','admin/dataTables.bootstrap.min.js','admin/custome/comman_functions.js','admin/custome/manage_user.js'));
		$data['enduser'] = 1;
		$offertype='1';
	//	$data['offerRes'] = $this->master_db->select('*',OFFER_MANAGEMENT,array("offer_type"=>$offertype));
		$this->template->write('title','Hotel Offer Management', TRUE);
		$this->template->write_view('header', ADMIN_VIEWS.'includes/header', $datah, TRUE);
		$this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
		$this->template->write_view('content', ADMIN_VIEWS.'train_offer_management', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
		$this->template->render();		
	}
	
	//--------------------------------------------- add edit Flight Offer submit function ----------------------------//
	public function add_flight_offer($id=false){
		
		$datah = array();
		$data = array();
		$dataf = array();
		$datal = array();
		$data['css'] = load_css('admin/jquery-ui.css');
		$data['js'] = load_js('admin/jquery-ui.js');
		$data['arr_flight_name'] = $this->master_db->select('*',AIRLINE_LIST);
		if($this->input->post('flight_setting') == 'Add' || $this->input->post('flight_setting') == 'Update'){ 
			$this->load->library('form_validation');
			$msg ='';
			$this->form_validation->set_rules('flight_name', 'flight name', 'trim|required');
			$this->form_validation->set_rules('offer_name', 'offer name', 'trim|required');
		    $this->form_validation->set_rules('offer_in', 'offer in', 'trim|required');
			$this->form_validation->set_rules('offer_price', 'offer price', 'trim|required|numeric');
			$this->form_validation->set_rules('start_date', 'start date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'end date', 'trim|required');
			if ($this->form_validation->run() == true){
				$flightname = $this->input->post('flight_name');
				$fligtCode = explode("---", $flightname);
				$fname =$fligtCode[0];
				$code =$fligtCode[1];
				$offername = $this->input->post('offer_name');
				$offerin = $this->input->post('offer_in');
				$offerprice = $this->input->post('offer_price');
				$startdate = date("Y-m-d",strtotime($this->input->post('start_date')));
				$enddate = date("Y-m-d",strtotime($this->input->post('end_date')));
				$dataArr = array(
					'flight_name'=>$fname,
					'flight_code'=>$code,	
					'offer_type'=>'0',									
					'offer_name'=>$offername,
					'offer_in'=>$offerin,
					'offer_start_date'=>$startdate,
					'offer_end_date'=>$enddate,
					'offer_amount'=>$offerprice,
					'added_date'=>date("Y-m-d")
					);
				if($id){
					$insRec = $this->master_db->update(OFFER_MANAGEMENT,$dataArr,array("offer_id"=>decode_string($id)));
					$msg = OFFER_UPDATED;
				}else{
					$insRec = $this->master_db->insert(OFFER_MANAGEMENT,$dataArr);
					$msg = OFFER_ADDED;
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
					$this->session->set_flashdata($msgArr);
				}
				redirect(site_url(ADMIN_CONTROLERS.'offer_management/flight_offer'));	
			    exit;	
			} 
		}
		if($id){
		$data['arrOfferRes'] = $this->master_db->select('*',OFFER_MANAGEMENT,array("offer_id"=>decode_string($id)));
		}
		$this->template->write('title','Offer Management', TRUE);
		$this->template->write_view('header', ADMIN_VIEWS.'includes/header', $datah, TRUE);
		$this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
		$this->template->write_view('content', ADMIN_VIEWS.'add_flight_management', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
		$this->template->render();	

	}
		
	public function add_hotel_offer($id=false){
		$datah = array();
		$data = array();
		$dataf = array();
		$datal = array();
		$data['css'] = load_css('admin/jquery-ui.css');
		$data['js'] = load_js('admin/jquery-ui.js');
		if($this->input->post('hotel_setting') == 'Add' || $this->input->post('hotel_setting') == 'Update'){ 
			$this->load->library('form_validation');
			$msg ='';
			$this->form_validation->set_rules('destination', 'city name', 'trim|required');
			$this->form_validation->set_rules('offer_name', 'offer name', 'trim|required');
		    $this->form_validation->set_rules('offer_in', 'offer in', 'trim|required');
			$this->form_validation->set_rules('offer_price', 'offer price', 'trim|required|numeric');
			$this->form_validation->set_rules('start_date', 'start date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'end date', 'trim|required');
			if ($this->form_validation->run() == true){
				$cityname = $this->input->post('destination');
				$offername = $this->input->post('offer_name');
				$offerin = $this->input->post('offer_in');
				$offerprice = $this->input->post('offer_price');
				$startdate = date("Y-m-d",strtotime($this->input->post('start_date')));
				$enddate = date("Y-m-d",strtotime($this->input->post('end_date')));
				$dataArr = array(
					'hotel_city'=>$cityname,
					'offer_type'=>'1',									
					'offer_name'=>$offername,
					'offer_in'=>$offerin,
					'offer_start_date'=>$startdate,
					'offer_end_date'=>$enddate,
					'offer_amount'=>$offerprice,
					'added_date'=>date("Y-m-d")
					);
				if($id){
					$insRec = $this->master_db->update(OFFER_MANAGEMENT,$dataArr,array("offer_id"=>decode_string($id)));
					$msg = OFFER_UPDATED;
				}else{
					$insRec = $this->master_db->insert(OFFER_MANAGEMENT,$dataArr);
					$msg = OFFER_ADDED;
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
					$this->session->set_flashdata($msgArr);
				}
				redirect(site_url(ADMIN_CONTROLERS.'offer_management/hotel_offer'));	
			    exit;	
			} 
		}
		if($id){
		$data['arrOfferRes'] = $this->master_db->select('*',OFFER_MANAGEMENT,array("offer_id"=>decode_string($id)));
		}
		$this->template->write('title','Offer Management', TRUE);
		$this->template->write_view('header', ADMIN_VIEWS.'includes/header', $datah, TRUE);
		$this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
		$this->template->write_view('content', ADMIN_VIEWS.'add_hotel_offer', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
		$this->template->render();	

	}
	public function city_hotel_result(){
		echo'<pre>';
		print_r($_POST);die;
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
	public function change_offer_status(){
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$offerid = $this->input->post('id');
		$status = $this->input->post('status');
		$statusRes = $this->master_db->update(OFFER_MANAGEMENT,array("offer_status"=>$status),array("offer_id"=>$offerid));
		if($statusRes){
			$msg = 'Offer status change successfully.';
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
		$offerid = $_POST['id'];
		$delRes = $this->master_db->delete(OFFER_MANAGEMENT,array("offer_id"=>decode_string($offerid)));
		if($delRes){
			$msg = 'Offer deleted successfully.';
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
