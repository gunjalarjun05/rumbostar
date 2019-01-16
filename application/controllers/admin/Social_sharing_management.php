<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Social_Sharing_management extends CI_Controller {

	public function __construct(){
		parent:: __construct();		
		is_admin_session_set();
		$this->load->model('user_model','user');	
		$params = array('default_template' => 'admin_index');
		$this->load->library('template',$params);
	}

   /* @suthor : Smita
	* @function use : flight_social_share function use show share tickit users list
	* @date : 1-2-2018
	*/
	public function flight_social_share()
	{
		//$datah = array();
		$data = array();
		
		$data['css'] = load_css('admin/dataTables.bootstrap.css');
		$data['js'] = load_js(array('admin/jquery.dataTables.min.js','admin/dataTables.bootstrap.min.js','admin/custome/comman_functions.js','admin/custome/manage_user.js'));
		$data['enduser'] = 1;
	
		$data['flightShareRes'] = $this->master_db->fetchAllFlightOnSocialShare();

		$this->template->write('title','Flight Social Share Management', TRUE);
		$this->template->write_view('header', ADMIN_VIEWS.'includes/header', $data, TRUE);
		$this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
		$this->template->write_view('content', ADMIN_VIEWS.'flight_social_share_management', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
		$this->template->render();		
	}

   /* @suthor : Smita
	* @function use : hotel_social_share function use show share tickit users list for hotel
	* @date : 1-2-2018
	*/
	public function hotel_social_share(){

		$data = array();
		
		$data['css'] = load_css('admin/dataTables.bootstrap.css');
		$data['js'] = load_js(array('admin/jquery.dataTables.min.js','admin/dataTables.bootstrap.min.js','admin/custome/comman_functions.js','admin/custome/manage_user.js'));
		$data['enduser'] = 1;
	
	/*	$data['offerRes'] = $this->master_db->select('*',OFFER_MANAGEMENT,array("offer_type"=>$offertype),'','','','','',array("added_date"=>'DESC'));*/
		$this->template->write('title','Hotel Social Share Management', TRUE);
		$this->template->write_view('header', ADMIN_VIEWS.'includes/header', $data, TRUE);
		$this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
		$this->template->write_view('content', ADMIN_VIEWS.'hotel_social_share_management', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
		$this->template->render();	

	}


	public function train_social_share(){


		$data = array();
		
		$data['css'] = load_css('admin/dataTables.bootstrap.css');
		$data['js'] = load_js(array('admin/jquery.dataTables.min.js','admin/dataTables.bootstrap.min.js','admin/custome/comman_functions.js','admin/custome/manage_user.js'));
		$data['enduser'] = 1;
	
	/*	$data['offerRes'] = $this->master_db->select('*',OFFER_MANAGEMENT,array("offer_type"=>$offertype),'','','','','',array("added_date"=>'DESC'));*/
		$this->template->write('title','Train Social Share Management', TRUE);
		$this->template->write_view('header', ADMIN_VIEWS.'includes/header', $data, TRUE);
		$this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
		$this->template->write_view('content', ADMIN_VIEWS.'train_social_share_management', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
		$this->template->render();	

	}

   /* @suthor : Smita
	* @function use : flight_discount function use for given user discount via mail and send mail user save in database
	* @date : 2-2-2018
	*/
	public function flight_discount(){
		
		if($_POST['emailId'] != ''){
		
		$userres = $this->master_db->fetchUserIdbyEmail($_POST['emailId']);
			
		if(isset($userres) && count($userres)>0){
				//print_r($userres);exit;
			$user_id = $userres[0]->user_id;
			$first_name = $userres[0]->first_name;
			$flightName = $_POST['flightName'];
			$discount = $_POST['discount'];
			$coupon_code = uniqid();		          
	        //echo $link;exit;
	        $msgbody = str_replace("%USER_NAME%", $first_name, DISCOUNT_BODY);
	        $msgbody1 = str_replace("%DISCOUNT%", $discount, $msgbody);
	        $msgbody = str_replace("%COUPONE_CODE%", $coupon_code, $msgbody1);
	       
	        $email= $_POST['emailId'];
	        $res = send_email($email,DISCOUNT_MGT_SUBJECT,$msgbody); 

	        //$this->master_db->
			$data =array(
				'user_id' =>$user_id,
				'travel_id'=>$_POST['flighno'],
				'travel_type'=>'0',
				'mail_status'=> '1',
				'coupon_code'=>$coupon_code,
				'coupon_generated_date'=> date("Y-m-d h:i:s"),			
				'use_copone_status'=>'0'
			);
			$insertId = $this->master_db->insert(LOYALTY_USER_DISCOUNT,$data);
 			//print_r($insertId);exit;
			if($insertId>0){				
				 	$msgArr = array(
	                            "status"=>"success",
	                            "msg"=>"Send mail Successfully."
	                            );	                       
	                echo json_encode($msgArr);exit;	               
				 }else{
				 	$msgArr = array(
	                            "status"=>"fail",
	                            "msg"=>"Not Send Mail."
	                            );	                       
	                echo json_encode($msgArr);exit;
				 }
				
			}else{
				
				$msgArr = array(
	                            "status"=>"fail",
	                            "msg"=>"Email id not correct."
	                            );	                       
                echo json_encode($msgArr);exit;
			}
			
		}
		 
	}

   /* @suthor : Smita
	* @function use : flight_discount_list function use for given user discount via mail and send mail user save in database
	* @date : 2-2-2018
	*/

	public function flight_discount_list(){
		$data = array();
		
		$data['css'] = load_css('admin/dataTables.bootstrap.css');
		$data['js'] = load_js(array('admin/jquery.dataTables.min.js','admin/dataTables.bootstrap.min.js','admin/custome/comman_functions.js','admin/custome/manage_user.js'));
		$data['enduser'] = 1;
	
		$data['discoutUser'] = $this->master_db->fetchflightDiscountUser();
		//print_r($data['discoutUser']);exit;
		$this->template->write('title','Flight Discount assigned user List', TRUE);
		$this->template->write_view('header', ADMIN_VIEWS.'includes/header', $data, TRUE);
		$this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
		$this->template->write_view('content', ADMIN_VIEWS.'flight_discount_list', $data, TRUE);
		$this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
		$this->template->render();	
	}
}