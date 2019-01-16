<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_management extends CI_Controller {

	public function __construct(){
		parent:: __construct();		
		is_admin_session_set();
		$this->load->model('user_model','user');	
		$params = array('default_template' => 'admin_index');
		$this->load->library('template',$params);
	}
//---------functinality for Hotel/Flight/Train booking management -----------------//

	// function for display flight booking list
	public function flight_booking()
	{
		$datah = array();
		$data = array();
		$dataf = array();
		$datal = array();
		$data['css'] = load_css('admin/dataTables.bootstrap.css');
		$data['js'] = load_js(array('admin/jquery.dataTables.min.js','admin/dataTables.bootstrap.min.js','admin/custome/comman_functions.js','admin/custome/manage_user.js'));
	 $data['bookingRec'] = $this->master_db->select('*',CUST_INFO_BOOKING_DETAILS,array("payment_status"=>"accept"),'','','','','',array("flight_from_date"=>'DESC'));
	 	//echo $this->db->last_query();exit;


		$this->template->write('title','Flight Booking Management', TRUE);
		$this->template->write_view('header', ADMIN_VIEWS.'includes/header', $datah, TRUE);
		$this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
	    $this->template->write_view('content', ADMIN_VIEWS.'flight_booking_management', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
		$this->template->render();	
	}	

	// function for display hotel booking list
	public function hotel_booking()
	{
		$datah = array();
		$data = array();
		$dataf = array();
		$datal = array();
		$data['css'] = load_css('admin/dataTables.bootstrap.css');
		$data['js'] = load_js(array('admin/jquery.dataTables.min.js','admin/dataTables.bootstrap.min.js','admin/custome/comman_functions.js','admin/custome/manage_user.js'));
	 $data['bookingRec'] = $this->master_db->select('*',HOTEL_BOOKING_DETAILS,array("book_type"=>"1","payment_status"=>"accept"),'','','','','',array("check_in_date"=>'DESC'));
	 	//echo $this->db->last_query();exit;
		$this->template->write('title','Hotel Booking Management', TRUE);
		$this->template->write_view('header', ADMIN_VIEWS.'includes/header', $datah, TRUE);
		$this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
	    $this->template->write_view('content', ADMIN_VIEWS.'hotel_booking_management', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
		$this->template->render();		
	}
	// function for display train booking list
	public function train_booking()
	{
	 	$datah = array();
		$data = array();
		$dataf = array();
		$datal = array();
		$data['css'] = load_css('admin/dataTables.bootstrap.css');
		$data['js'] = load_js(array('admin/jquery.dataTables.min.js','admin/dataTables.bootstrap.min.js','admin/custome/comman_functions.js','admin/custome/manage_user.js'));
	  $data['bookingRec'] = $this->master_db->select('*',CUST_TRAIN_BOOKING_DETAILS,array("book_type"=>"0","payment_status"=>"accept"),'','','','','',array("train_from_date"=>'DESC'));
	 	//echo $this->db->last_query();exit;
		$this->template->write('title','Train Booking Management', TRUE);
		$this->template->write_view('header', ADMIN_VIEWS.'includes/header', $datah, TRUE);
		$this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
	    $this->template->write_view('content', ADMIN_VIEWS.'train_booking_management', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
		$this->template->render();		
	}
}





