<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_referral_management extends CI_Controller {

	public function __construct(){
		parent:: __construct();	
		is_admin_session_set();
		$this->load->model('user_model','user');	
	    $params = array('default_template' => 'admin_index');
        $this->load->library('template',$params);
	}

	public function index(){

		$data = array();


		$referalUserList = $this->master_db->fetchAllReferalUser();
			
		$data['referalUserList'] = $referalUserList;
		$data['css'] = load_css('admin/dataTables.bootstrap.css');
		$data['js'] = load_js(array('admin/jquery.dataTables.min.js','admin/dataTables.bootstrap.min.js','admin/custome/comman_functions.js','admin/custome/manage_user.js'));
		//$data['usertype'] = $usertype;
		$this->template->write('title','User Referral Code Management', TRUE);
        $this->template->write_view('header', ADMIN_VIEWS.'includes/header', $data, TRUE);
        $this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
        $this->template->write_view('content', ADMIN_VIEWS.'user_referral_management', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
        $this->template->render();	
	}
}