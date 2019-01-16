<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bookings extends CI_Controller {

       
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('php_fastcache');
        $this->load->helper('cookie');
        $this->load->model('serviceData','service_m');
        $this->load->library('template');   
    }
    
    public function hotel_booking($sessionID,$roomCode){
        if($sessionID !='' && $roomCode!=''){
            $data = array();
            $inputArray = array("session_id"=>$sessionID,"room_code"=>$roomCode);
            $result = getDataFromRemot('hotel','select_room','','',$inputArray);            
            $data['result'] = $result;
            $this->session->set_userdata('sess_bk_info',$result);
            $css = load_css(array('front/star-rating.css'));
            $this->template->write('headerCss',$css);
            $js = load_js(array('front/star-rating.js'));
            $this->template->write('footerJs',$js);  
            $this->template->write('title', 'Book Hotel');
            $this->template->write_view('header', 'includes/header', $data, TRUE);
            $this->template->write_view('content', 'book-hotel', $data, TRUE);
            $this->template->write_view('footer', 'includes/footer', '', TRUE);
            $this->template->render();
        }
    }
    
    public function hotel_booking_pay(){
        if($this->input->post('hotelpay') == 'pay'){
            $this->load->library('midtrans');
            $inputArray['session_id'] = $this->input->post('sessionid');
            $inputArray['payment_type'] = $this->input->post('payment_type');
            $inputArray['payref'] = $this->input->post('payref');
            $inputArray['room_code'] = $this->input->post('room_code');
            $inputArray['number_of_room'] = $this->input->post('noofrooms');
            $inputArray['guest_phone'] = $this->input->post('guest_phone');
            $inputArray['guest_email'] = $this->input->post('guest_email');
            $inputArray['room_name_1'] = $this->input->post('guest_name');
            $inputArray['sess_bk_info'] = $this->session->userdata('sess_bk_info');
            $this->midtrans->pay($inputArray);die;
            //$inputArray = array("session_id"=>$sessionID,"room_code"=>$roomCode);
            $result = getDataFromRemot('hotel','hotel_pay','','',$inputArray); 
            echo "<pre>";
            print_r($result);die;
        } 
    }
 public function payment_response(){
echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);
		echo'<pre>';
		print_r($result);die;


		if($result){
		$notif = $this->veritrans->status($result->order_id);
		}

		error_log(print_r($result,TRUE));

		//notification handler sample

		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      } 
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  } 
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  } 
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}
    }
}

