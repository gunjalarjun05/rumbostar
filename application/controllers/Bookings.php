<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bookings extends CI_Controller {

       
	public function __construct() {
        parent::__construct();
         $params = array('server_key' => 'VT-server-MCq3qIApXLdYbbMHQrG9g5C8', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
	    $this->load->library('form_validation');
        $this->load->library('php_fastcache');
        $this->load->library('paypal_lib'); //sk
        $this->load->helper('cookie');
        $this->load->model('serviceData','service_m');
        $this->load->library('template');  
        $this->lang->load('message','english'); 
    }
    public function checkout()
    {
    $this->template->write('title', 'Checkout');	
    $this->template->write_view('header', 'includes/header','', TRUE);
    $this->template->write_view('content', 'checkout_vtweb', '', TRUE);
    $this->template->write_view('footer', 'includes/footer', '', TRUE);
    $this->template->render();	
    } 
	 public function paypal_checkout()
    {
    $returnURL = base_url().'bookings/paypal_success';
	$cancelURL = base_url().'paypal/cancel'; //payment cancel url
	$notifyURL = base_url().'paypal/ipn'; //ipn url
	$cust_name = "Andri Setiawan";
	$cust_email="andrisetiawan@me.com";
	$cust_phone="081322311801";	
	$last_insert_id = rand();
	$this->paypal_lib->add_field('return', $returnURL);
	$this->paypal_lib->add_field('cancel_return', $cancelURL);
	$this->paypal_lib->add_field('notify_url', $notifyURL);	

	$this->paypal_lib->add_field('item_name', $cust_name);
	$this->paypal_lib->add_field('custom', $cust_email);
	$this->paypal_lib->add_field('item_number', $cust_phone);
	$this->paypal_lib->add_field('amount',  '1');	
	$this->paypal_lib->add_field('or_id',$last_insert_id);
	$this->paypal_lib->paypal_auto_form();	
    }
    
    public function paypal_success()
    {
      $data['result'] = $this->input->get();	

            $this->template->write('title', 'Success');
            $this->template->write_view('header', 'includes/header','', TRUE);
            $this->template->write_view('content', 'paypal_success', $data, TRUE);
            $this->template->write_view('footer', 'includes/footer', '', TRUE);
            $this->template->render();
    }
    public function midtrans_success()
    {		
    		 $order_id = $_GET['order_id'];
    		 $result = $this->veritrans->status($order_id);	
             $data['result'] = $this->veritrans->status($order_id);	
             $last_book_id = $this->session->userdata('Last_book_id');
             $paypalInfo = $this->input->get();
                $info = array('payment_status'=>'accept',
						 'order_id'=>$last_book_id,
						 'payment_txn_no'=>$result->transaction_id,
						 'payment_type'=> $result->payment_type
				);
          		
		   $this->master_db->update(CUST_HOTEL_BOOKING_DETAILS,$info,array("cust_id"=>$last_book_id));

		   $hotel_pay= $this->session->userdata('hotel_pay');
		   //print_r($hotel_pay);
		   $result = getDataFromRemot('hotel','hotel_pay','','',$hotel_pay); 
		   //print_r($result);exit;
		   if(isset($result->error_msg) && ($result->error_msg != '')){
			$responce_str = site_url().'/hotel-booking/'.$hotel_pay['session_id'].'/'.$hotel_pay['room_code']; 
			$msgArr = array(
							"msg_type"=>"error",
							"msg"=>$result->error_msg
					);
				$this->session->set_flashdata($msgArr);
				redirect($responce_str);	
				exit;
		}else{	
			
		$dataArr = array("booking_id" => $result->bookId);
			$this->master_db->update(CUST_HOTEL_BOOKING_DETAILS,$dataArr,array("cust_id"=>$last_book_id));
			$data['result'] = $result;
			
		}
		
		$this->template->write('title', 'Payment Success');
		$this->template->write_view('header', 'includes/header',TRUE);
		$this->template->write_view('content', 'hotel-book-success', $data,TRUE);	
		$this->template->write_view('footer', 'includes/footer', '', TRUE);
		$this->template->render();	

           /* $this->template->write('title', 'Success');
            $this->template->write_view('header', 'includes/header','', TRUE);
            $this->template->write_view('content', 'midtrans_success', $data, TRUE);
            $this->template->write_view('footer', 'includes/footer', '', TRUE);
            $this->template->render(); */
    }

    public function hotel_booking($sessionID,$roomCode){
		
        if($sessionID !='' && $roomCode!=''){
            $data = array();
            $inputArray = array("session_id"=>$sessionID,"room_code"=>$roomCode);
            $result = getDataFromRemot('hotel','select_room','','',$inputArray);

            $data['result'] = $result;
          // echo '<pre>';
           //print_r($result);exit;
            $this->session->set_userdata('sess_bk_info',$result);
            $css = load_css(array('front/star-rating.css'));
            $this->template->write('headerCss',$css);
            $js = load_js(array('front/star-rating.js'));
            $js = load_js(array('front/jquery.validate.min.js','front/add-booking.js'));
            $this->template->write('footerJs',$js);  
            $this->template->write('title', 'Book Hotel');
            $this->template->write_view('header', 'includes/header', $data, TRUE);
            $this->template->write_view('content', 'book-hotel', $data, TRUE);
            $this->template->write_view('footer', 'includes/footer', '', TRUE);
            $this->template->render();
        }
    }


    public function hotel_booking_pay(){
    	
        if($this->input->post('hotelpay') == 'pay' || $this->input->post('guest_hotel_pay') == 'guest') 
        {
        	if($this->input->post('user_type') == 'GUEST'){	
                 $msgbody=str_replace("%USER_NAME%", $this->input->post('guest_name'), GUEST_BODY);   
                 $email = $this->input->post('guest_email');
                 send_email($email,USER_GUEST_SUBJECT,$msgbody);                    
			}
		 	
            $inputArray['sess_bk_info'] = $this->session->userdata('sess_bk_info');
            $session_data = $this->session->userdata('sess_bk_info');
            $session_filter_data = $this->session->userdata('searchinfo');            
            $no_of_guest = ($session_filter_data['adult'] + $session_filter_data['child']);
            $inputArray['session_id'] = $this->input->post('session_id');
            $inputArray['payment_type'] = 'deposit';
            $inputArray['payref'] = $this->input->post('payref');
            $inputArray['room_code'] = $this->input->post('room_code');
            $inputArray['number_of_room'] = $session_data->search_info->number_of_room;
            $inputArray['guest_phone'] = $this->input->post('guest_phone');
            $inputArray['guest_email'] = $this->input->post('guest_email');
            $inputArray['guest_name'] = $this->input->post('guest_name');
            $inputArray['book_type'] = 'hotel';
            $userID = ($this->session->userdata(USER_SESSION.'user_id')!= NULL) ? $this->session->userdata(USER_SESSION.'user_id') : 0;
            $userType = ($this->session->userdata(USER_SESSION.'user_type') != NULL) ? $this->session->userdata(USER_SESSION.'user_type') :'GUEST';
            $curren=(isset($curr['IDR']) && $curr['IDR']!='')? $curr['IDR']:'';
            $offer = get_hotel_city_offer($session_filter_data['city'],$session_data->room_price->total_price);
			if(isset($offer['discounted_price']) && $offer['discounted_price'] >= 1){
			     $discount = $offer['discounted_price'];
			     $inputArray['total_amount']=$discount;
			}else {
				$discount=0;
				$inputArray['total_amount']=$session_data->room_price->total_price;
			}
			
            $data = array('cust_name' => $this->input->post('guest_name'),
						 'cust_phone' => $this->input->post('guest_phone'),
						 'cust_email'=> $this->input->post('guest_email'),
						 'session_id'=> $session_data->search_info->session_id,
						 'booking_amount'=> $session_data->room_price->total_price,
						 'discount_price'=> $discount,
						 'user_id' =>$userID,
						 'user_type' => $userType,
						 'no_of_rooms'=> $session_data->search_info->number_of_room,
						 'room_code'=> $this->input->post('room_code'),
						 'room_name'=> $session_data->name_room,
						 'hotel_name'=> $session_data->name_hotel,
						 'check_in_date'=> $session_data->ci,
						 'check_out_date'=> $session_data->co,
						 'total_idr'=> '',
						 'booking_date'=> date("Y-m-d"),
						 'Payment_gateway'=> $this->input->post('paytype'),
						 'payment_status'=>'',
						 'order_id'=>'',
						 'book_type'=>'1',
						 'no_of_night'=> $session_data->night,
						 'no_of_guest'=> $no_of_guest,
						 'address'=> $session_data->address_hotel,
						 'city'=> $session_filter_data['city'],
						 );
           				
						 $last_insert_id = $this->master_db->insert(CUST_HOTEL_BOOKING_DETAILS,$data);
						 $inputArray['last_insert_id']=$last_insert_id;

						 if($last_insert_id) {

						 	$arr_booking_dtls = $this->master_db->select('*',CUST_HOTEL_BOOKING_DETAILS,array("cust_id"=>$last_insert_id));

							$arr_booking_dtls =end($arr_booking_dtls);
							$hotelPayArray['session_id'] = $arr_booking_dtls->session_id;
							$hotelPayArray['payment_type'] = 'deposit';
							$hotelPayArray['payref'] = 'payref';
							$hotelPayArray['room_code'] = $arr_booking_dtls->room_code;
							$hotelPayArray['number_of_room'] = $arr_booking_dtls->no_of_rooms;
							$hotelPayArray['guest_phone'] = $arr_booking_dtls->cust_phone;
							$hotelPayArray['guest_email'] = $arr_booking_dtls->cust_email;
							$hotelPayArray['room_name_1'] = $arr_booking_dtls->room_name;

							$this->session->set_userdata('hotel_pay',$hotelPayArray); 
							$this->session->set_userdata('Last_book_id',$last_insert_id);

							if($this->input->post('paytype') == 'Midtrans')
							{

  
     						// Start Midtrans payment gateway	
								
							$transaction_details = array(
							'order_id' 			=> $last_insert_id,
							'gross_amount' 	=> $session_data->room_price->total_price
							);

							// Populate items
							$items = [
							  array(
								'id' 				=> $this->input->post('room_code'),
								'price' 		=> $session_data->room_price->total_price,
								'quantity' 	=> $session_data->search_info->number_of_room,
								'name' 			=> $session_data->name_hotel
							)
							
						];

						
						// Populate customer's billing address
					/*	$billing_address = array(
							'first_name' 		=> $this->input->post('guest_name'),
							'last_name' 		=> "",
							'address' 			=> $session_data->address_hotel,
							'city' 					=> $session_filter_data['city'],
							'postal_code' 	=> "51161",
							'phone' 				=> $this->input->post('guest_phone'),
							'country_code'	=> 'IDN'
							); */

						// Populate customer's shipping address
					/*	$shipping_address = array(
							'first_name' 	=> $this->input->post('guest_name'),
							'last_name' 	=> "",
							'address' 		=> $session_data->address_hotel,
							'city' 				=> $session_filter_data['city'],
							'postal_code' => "51162",
							'phone' 			=> $this->input->post('guest_phone'),
							'country_code'=> 'IDN'
							); */

						// Populate customer's Info
						$customer_details = array(
							'first_name' 			=> $this->input->post('guest_name'),
							'last_name' 			=> "",
							'email' 					=> $this->input->post('guest_email'),
							'phone' 					=> $this->input->post('guest_phone'),
							'billing_address' => '',
							'shipping_address'=> ''
							);


						// Data yang akan dikirim untuk request redirect_url.
						// Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
						$notif_url= site_url()."index.php/bookings/midtrans_success";
						$finish_redirect_url= site_url()."index.php/bookings/midtrans_success";
						$unfinish_redirect_url = site_url()."index.php/vtweb/notification";
						$error_redirect_url= site_url()."index.php/vtweb/notification";
						$transaction_data = array(
							'payment_type' 			=> 'vtweb', 
							'vtweb' 						=> array(
								//'enabled_payments' 	=> ['credit_card'],
								'credit_card_3d_secure' => true,
								"notification_url" => $notif_url,
								"finish_redirect_url" => $finish_redirect_url,
								"unfinish_redirect_url" => $unfinish_redirect_url,
								"error_redirect_url" => $error_redirect_url
							),
							'transaction_details'=> $transaction_details,
							'item_details' 			 => $items,
							'customer_details' 	 => $customer_details
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
					// end Midtrans payment gateway	

					} else {
						
						// start paypal payment gateway	   
						$returnURL = base_url().'bookings/hotel_booking_success';
					    $cancelURL = base_url().'paypal/cancel'; //payment cancel url
					    $notifyURL = base_url().'paypal/ipn'; //ipn url						 

						$this->paypal_lib->add_field('return', $returnURL);
						$this->paypal_lib->add_field('cancel_return', $cancelURL);
						$this->paypal_lib->add_field('notify_url', $notifyURL);
						$this->paypal_lib->add_field('item_name', $arr_booking_dtls->cust_name);
						$this->paypal_lib->add_field('custom', $arr_booking_dtls->cust_email);
						$this->paypal_lib->add_field('item_number', $arr_booking_dtls->cust_phone);
						//$this->paypal_lib->add_field('amount',  '1');
						$this->paypal_lib->add_field('amount',  $session_data->room_price->total_price);
						$this->paypal_lib->add_field('or_id',$last_insert_id);
						$this->paypal_lib->paypal_auto_form();

						// end paypal payment gateway	   
    				  }
				}
        } 
    }
    
public function hotel_booking_success(){
$paypalInfo = $this->input->get();

$hotel_pay = $this->session->userdata('hotel_pay');
$last_book_id = $this->session->userdata('Last_book_id');

 $dataArr = array("order_id"=>$last_book_id,"payment_txn_no"=>$paypalInfo['tx'],"payment_status"=>'accept');
 $this->master_db->update(CUST_HOTEL_BOOKING_DETAILS,$dataArr,array("cust_id"=>$last_book_id));
  // print_r($paypalInfo); 
$hotel_pay= $this->session->userdata('hotel_pay');
$result = getDataFromRemot('hotel','hotel_pay','','',$hotel_pay); 

if(isset($result->error_msg) && ($result->error_msg != '')){
			$responce_str = site_url().'/hotel-booking/'.$hotel_pay['session_id'].'/'.$hotel_pay['room_code']; 
			$msgArr = array(
							"msg_type"=>"error",
							"msg"=>$result->error_msg
					);
				$this->session->set_flashdata($msgArr);
				redirect($responce_str);	
				exit;
		}else{	
			
		$dataArr = array("booking_id" => $result->bookId);
			$this->master_db->update(CUST_HOTEL_BOOKING_DETAILS,$dataArr,array("cust_id"=>$last_book_id));
			$data['result'] = $result;
			
		}
		$this->template->write('title', 'Payment Success');
		$this->template->write_view('header', 'includes/header',TRUE);
		$this->template->write_view('content', 'hotel-book-success', $data,TRUE);	
		$this->template->write_view('footer', 'includes/footer', '', TRUE);
		$this->template->render();		

}


	public function user_hotel_booking(){
		$userID =$this->session->userdata(USER_SESSION.'user_id');
		//print_r($userID);exit;
		$hotel_booking_dtl =array();
		$hotel_booking_dtl = $this->master_db->select('*',CUST_HOTEL_BOOKING_DETAILS,array("user_id"=>$userID));
		$data['hotel_booking_dtl']= $hotel_booking_dtl;
	//	echo '<pre>';
	//print_r($data);exit;
		$this->template->write('title', 'Hotel Booking');
		$this->template->write_view('header', 'includes/header',TRUE);
		$this->template->write_view('content', 'user-hotel-booking-list',$data,TRUE);	
		$this->template->write_view('footer', 'includes/footer', '', TRUE);
		$this->template->render();
	}

	public function user_flight_booking(){

		$userID =$this->session->userdata(USER_SESSION.'user_id');
		//print_r($userID);exit;
		$flight_booking_dtl =array();
		$flight_booking_dtl = $this->master_db->fetchMyFlightBooking($userID);
		$data['flight_booking_dtl']= $flight_booking_dtl;
		//echo '<pre>';
		//print_r($flight_booking_dtl);exit;
		$this->template->write('title', 'Flight Booking');
		$this->template->write_view('header', 'includes/header',TRUE);
		$this->template->write_view('content', 'user-flight-booking-list',$data,TRUE);	
		$this->template->write_view('footer', 'includes/footer', '', TRUE);
		$this->template->render();
	}

	/* author : Smita
	 * function use : user_train_booking function use for fetch booking train details
	 * date : 29-12-2017
	*/

	public function user_train_booking(){

		$userID =$this->session->userdata(USER_SESSION.'user_id');
		$data =  array();
		//print_r($userID);exit;
		//$train_booking_dtl =array();
		//$train_booking_dtl = $this->master_db->fetchMyFlightBooking($userID);
		//$data['train_booking_dtl']= $flight_booking_dtl;
		//echo '<pre>';
		//print_r($flight_booking_dtl);exit;
		$this->template->write('title', 'Train Booking');
		$this->template->write_view('header', 'includes/header',TRUE);
		$this->template->write_view('content', 'user-train-booking-list',$data,TRUE);	
		$this->template->write_view('footer', 'includes/footer', '', TRUE);
		$this->template->render();
	}

	public function view_hotel_booking($cust_book_id){
		$arr_hotel_booking =array();
		$arr_hotel_booking = $this->master_db->select('*',CUST_HOTEL_BOOKING_DETAILS,array("cust_id"=>decode_string($cust_book_id)));
		$data['arr_hotel_booking']= $arr_hotel_booking;
		$this->template->write('title', 'Hotel Booking');
		$this->template->write_view('header', 'includes/header',TRUE);
		$this->template->write_view('content', 'view-hotel-booking',$data,TRUE);	
		$this->template->write_view('footer', 'includes/footer', '', TRUE);
		$this->template->render();
	}


 	public function flight_booking(){
     	$this->load->library('form_validation');     	
        if($this->input->post('flightpay') == 'pay' || $this->input->post('guest_login') == 'guest'){
        	//echo '<pre>';
        	// print_r($this->input->post());
        	$this->form_validation->set_rules('guest_name', 'guest_name', 'required');         	    	       
            $this->form_validation->set_rules('guest_phone', 'guest_phone', 'required|numeric|min_length[4]|max_length[16]');	       
			$this->form_validation->set_rules('guest_email', 'guest_email', 'required');  
			 $dataurl = json_decode($this->input->post('get_data_dtl'));     
				if ($this->form_validation->run()){
					//echo "<pre>";

					if($this->input->post('user_type') == 'GUEST'){	
					$dataurl = json_decode($this->input->post('get_data_dtl'));
					//$mailLink = $dataurl->session_id.'/'.$dataurl->flightno_1.'/'.$dataurl->class_id_1.'?flightno_2='.$dataurl->flightno_2.'&class_id_2='.$dataurl->class_id_2;

					
				//	$link = site_url().'flight-details/'.$mailLink;
					//echo $link;exit;				
                    $msgbody=str_replace("%USER_NAME%", $this->input->post('guest_name'), GUEST_BODY);
                    	
                   // $msgbody=str_replace("%LINK%", $link, $msgbody);
                    //print_r($msgbody);	
                    $email = $this->input->post('guest_email');
                   // echo $email;exit;
                    send_email($email,USER_GUEST_SUBJECT,$msgbody);
                    /* $msgArr = array(
                        "status"=>"success",
                        "msg"=>"Your mail is verify."
                        );
                   // print_r($msgArr);exit;
                    $this->session->set_flashdata($msgArr);*/
                    //redirect($link); exit;
					}
					//echo '<pre>';
					
		            $inputArray['guest_name'] = $this->input->post('guest_name');
		            $inputArray['guest_phone'] = $this->input->post('guest_phone');
		            $inputArray['guest_email'] = $this->input->post('guest_email');
		            $inputArray['total_amount'] = str_replace(',','',$this->input->post('total_amount'));
		            $inputArray['currency_code'] = $this->input->post('currency_code');
		            $inputArray['user_type'] = $this->input->post('user_type');
		            $inputArray['flight_name'] = $this->input->post('flight_name'); //sk add line		            
		            $inputArray['name_type'] = $this->input->post('name_type');
		            $inputArray['first_name'] = $this->input->post('first_name');
		            $inputArray['last_name'] = $this->input->post('last_name');
		            $inputArray['id_number'] = $this->input->post('id_number');
		            $inputArray['passport_number'] = $this->input->post('passport_number');
		            $inputArray['country_passport'] = $this->input->post('country_passport');
		            $inputArray['pass_expire_date'] = $this->input->post('pass_expire_date');
		            $inputArray['date_of_birth'] = $this->input->post('date_of_birth');
		            $inputArray['book_type'] = 'flight';
		            $session_data = $this->session->userdata('sess_bk_info_flight');
		            $inputArray['sess_bk_info_flight'] = $session_data;
		          
		         //echo '<pre>';
		           // print_r($this->input->post());exit;
		        // print_r($inputArray);
	           		$userID = ($this->session->userdata(USER_SESSION.'user_id')!= NULL) ? $this->session->userdata(USER_SESSION.'user_id') : 0;
	           		if($this->input->post('user_type') == 'GUEST'){
		            	$userType = $this->input->post('user_type');
		            }else{
	            		$userType = ($this->session->userdata(USER_SESSION.'user_type') != NULL) ? $this->session->userdata(USER_SESSION.'user_type') :0;
		            }
	           		//print_r($this->input->post('get_data_dtl'));
		            if(isset($session_data->error_msg) && $session_data->error_msg != ''){

		            	 $msgArr = array(
									"msg_type"=>"error",
									"msg"=>$session_data->error_msg
								);
								$this->session->set_flashdata($msgArr);

						$redirectlink = site_url().'flight-details/'.$dataurl->session_id.'/'.$dataurl->flightno_1.'/'.$dataurl->class_id_1.'?flightno_2='.$dataurl->flightno_2.'&class_id_2='.$dataurl->class_id_2;
						//print_r($redirectlink);exit;
								redirect($redirectlink);	
								exit;
		            }

	           		//if condition use arriver time set for  depart flight only and else condition use for select retrun
	             	if(isset($session_data->depart_detail->connecting_flight[0]->eta) && $session_data->depart_detail->connecting_flight[0]->eta != ''){
		            	$arrive_time = $session_data->depart_detail->connecting_flight[0]->eta;
		            }else{
		            	$arrive_time = $session_data->depart_detail->eta;
		            }

		            //sk - If user select retun radio button and select 2 diff flight and booking flight use following array 4-1-2018

		          
		            if(isset($session_data->depart_detail) && $session_data->depart_detail != '' && isset($session_data->return_detail) && $session_data->return_detail != ''){
		            	//echo 'welcome11';exit;
		            	$depart_data = array('cust_name' => $this->input->post('guest_name'),
						 'cust_phone' => $this->input->post('guest_phone'),
						 'cust_email'=> $this->input->post('guest_email'),
						 'country_code'=> $this->input->post('countriesCode'),
						 'session_id'=> $session_data->session_id,
						 'booking_amount'=> str_replace(',','',$this->input->post('total_amount')),
						 'user_id' =>$userID,
						 'user_type' => $userType,
						 'flight_way' => 'depart',
						 'trip_type'=> $session_data->search_info->roundtrip,
						 'flight_type'=>$session_data->search_info->type,
						 'flight_no'=>$session_data->depart_detail->fno,
						 'flight_name' => $this->input->post('flight_name'), //sk add
						 'flight_class' => $this->input->post('flight_class'), //sk add
						 'depart_from'=> $session_data->search_info->from,
						 'depart_to'=> $session_data->search_info->to,
						 'depart_date'=> $session_data->search_info->depart,
						 'depart_time'=> $session_data->depart_detail->etd,
						 'arrive_time' => $arrive_time, //sk add
						 'flight_from_date'=> $session_data->depart_detail->date,
						 'flight_to_date'=> '',
						 'total_idr'=> $session_data->depart_detail->price->total_idr,
						 'booking_date'=>  date('Y-m-d H:i:s'),
						 'payment_status'=>'deny',
						 'order_id'=>'',
						 'book_type'=>'0',
						 );

		            	if(isset($session_data->return_detail->connecting_flight[0]->to)){
		            		$deptTo = $session_data->return_detail->connecting_flight[0]->to;
		            	}else if(isset($session_data->return_detail->to)){
		            		$deptTo = $session_data->return_detail->to;
		            	}

		            	if(isset($session_data->return_detail->connecting_flight[0]->date)){
	            			$dateTo = $session_data->return_detail->connecting_flight[0]->date;
		            	}else{
		            		$dateTo = '';
		            	}

		            	if(isset($session_data->return_detail->connecting_flight[0]->eta)){
		            		$arrive_time = $session_data->return_detail->connecting_flight[0]->eta;
		            	}else if(isset($session_data->return_detail->eta)){
		            		$arrive_time = $session_data->return_detail->eta;
		            	}

		            	$retrun_data = array('cust_name' => $this->input->post('guest_name'),
						 'cust_phone' => $this->input->post('guest_phone'),
						 'cust_email'=> $this->input->post('guest_email'),
						 'country_code'=> $this->input->post('countriesCode'),
						 'trip_type'=> $session_data->search_info->roundtrip,
						 'flight_type'=>$session_data->search_info->type,
						 'session_id'=> $session_data->session_id,
						 'booking_amount'=> str_replace(',','',$this->input->post('total_amount')),
						 'user_id' =>$userID,
						 'parent_cust_id'=> 0,
						 'user_type' => $userType,
						 'flight_way' => 'retrun',
						 'flight_no'=>$session_data->return_detail->fno,
						 'flight_name' => $session_data->return_detail->airline_name, //sk add
						 'flight_class' => $this->input->post('flight_class'), //sk add
						 'depart_from'=> $session_data->return_detail->from,
						 'depart_to'=> $deptTo,
						 'depart_date'=> $session_data->search_info->return,
						 'depart_time'=> $session_data->return_detail->etd,
						 'arrive_time' => $arrive_time, //sk add
						 'flight_from_date'=> $session_data->return_detail->date,
						 'flight_to_date'=> $dateTo,
						 'total_idr'=> $session_data->return_detail->price->total_idr,
						 'booking_date'=>  date('Y-m-d H:i:s'),
						 'payment_status'=>'deny',
						 'order_id'=>'',
						 'book_type'=>'0',
						 );

		            }else if(isset($session_data->depart_detail) && $session_data->depart_detail != ''){	 

		            	$depart_data = array('cust_name' => $this->input->post('guest_name'),
						 'cust_phone' => $this->input->post('guest_phone'),
						 'cust_email'=> $this->input->post('guest_email'),
						 'country_code'=> $this->input->post('countriesCode'),
						 'session_id'=> $session_data->session_id,
						 'booking_amount'=> str_replace(',','',$this->input->post('total_amount')),
						 'user_id' =>$userID,
						 'parent_cust_id'=> 0,
						 'user_type' => $userType,
						 'flight_way' => 'depart',
						 'flight_no'=>$session_data->depart_detail->fno,
						 'flight_name' => $this->input->post('flight_name'), //sk add
						 'flight_class' => $this->input->post('flight_class'), //sk add
						 'trip_type'=> $session_data->search_info->roundtrip,
						 'flight_type'=>$session_data->search_info->type,
						 'depart_from'=> $session_data->search_info->from,
						 'depart_to'=> $session_data->search_info->to,
						 'depart_date'=> $session_data->search_info->depart,
						 'depart_time'=> $session_data->depart_detail->etd,
						 'arrive_time' => $arrive_time, //sk add
						 'flight_from_date'=> $session_data->depart_detail->date,
						 'flight_to_date'=> '',
						 'total_idr'=> $session_data->depart_detail->price->total_idr,
						 'booking_date'=>  date('Y-m-d H:i:s'),
						 'payment_status'=>'deny',
						 'order_id'=>'',
						 'book_type'=>'0',
						 );
		            }
		            //echo '<pre>';
		           // print_r($depart_data);

		           // print_r($retrun_data);
					//print_r($data);exit;
		            //exit;

					 $post_data['cust_name'] = $this->input->post('guest_name');
					 $post_data['cust_phone'] = $this->input->post('guest_phone');
					 $post_data['cust_email'] = $this->input->post('guest_email');
					 $post_data['session_id']= $session_data->session_id;
					//$duration = getTimeDiff($session_data->depart_detail->etd,$session_data->depart_detail->connecting_flight[0]->eta);
					//echo $duration;
		           //print_r($data);exit;

				 	/*if(count($data)>0 && isset($data)){
			 		 $last_insert_id = $this->master_db->insert_batch(CUST_INFO_BOOKING_DETAILS,$data);	
				 	}*/

					   // print_r($depart_data);
					  // print_r($depart_data);exit;

				 	if(count($depart_data)>0 && isset($depart_data)){
				 		$last_insert_id_depart = $this->master_db->insert(CUST_INFO_BOOKING_DETAILS,$depart_data);	
				 	}
						
					if(isset($retrun_data) && count($retrun_data)>0){
				 		$last_insert_id_retrun = $this->master_db->insert(CUST_INFO_BOOKING_DETAILS,$retrun_data);	
				 	}

				 	/*if(count($retrun_data)>0 && isset($retrun_data)){
				 		$last_insert_id = $this->master_db->insert(CUST_INFO_BOOKING_DETAILS,$retrun_data);	
				 	}*/
				 	
				 	if(isset($last_insert_id_depart))
				 	{
				 		$inputArray['last_insert_id_depart']= $last_insert_id_depart;
				 	}
				 	if(isset($last_insert_id_retrun))
				 	{
			 			$inputArray['last_insert_id_retrun'] = $last_insert_id_retrun;
				 	}
					
				 		//echo $last_insert_id_depart;
				 		//echo '=='. $last_insert_id_retrun;
				 		
					
					if($last_insert_id_depart > 0 || $last_insert_id_retrun >0)
					{	
		 			if($this->session->userdata(USER_SESSION.'agent_id') != '' && $this->session->userdata(USER_SESSION.'user_type') == 'AGENT'){
		            		$agentId  =$this->session->userdata(USER_SESSION.'agent_id');
		            		
		            	}else{
		            		//print_r('jhjhjk');exit;
		            		$agentId = '0';
		            	}

						$name_type = $this->input->post('name_type');
						$person_type = $this->input->post('person_type');
						$first_name = $this->input->post('first_name');
						$last_name = $this->input->post('last_name');
                        $id_number = $this->input->post('id_number');
                        //$agent_id = $agentId;
                        $passport_number = $this->input->post('passport_number');
                        $country_passport = $this->input->post('country_passport');
                        $pass_expire_date= $this->input->post('pass_expire_date');
                        $date_of_birth = $this->input->post('date_of_birth');
                        $buggage_count= $this->input->post('buggage_count');
						$j=1;
						//print_r($this->input->post('name_type'));exit;
						for($i=0;$i< count($this->input->post('name_type'));$i++)
						{

							
						 	if(isset($last_insert_id_depart))
						 	{
					 		 	$arr_data[$i]['cust_id'] = $last_insert_id_depart;
						 	}
						 	if(isset($last_insert_id_retrun))
						 	{
					 			$arr_data[$i]['cust_id'] = $last_insert_id_retrun;
						 	}
							

						   //print_r($arr_data[$i]['cust_id']);exit;
					   		
						  // $arr_data[$i]['cust_id']= $custretrnId;
						    $arr_data[$i]['cust_dept_id'] = $last_insert_id_depart;
						    $arr_data[$i]['travel_way'] = 'flight';
						    $arr_data[$i]['user_id']=$userID;
						    $arr_data[$i]['agent_id'] =$agentId;
							$arr_data[$i]['title']=$name_type[$i];
							$arr_data[$i]['person_type']=$person_type[$i];
							$arr_data[$i]['first_name']=$first_name[$i];
							$arr_data[$i]['last_name']=$last_name[$i];
							$arr_data[$i]['id_number']=$id_number[$i];
							$arr_data[$i]['passport_number']=$passport_number[$i];
							$arr_data[$i]['country_passport']=$country_passport[$i];
							$arr_data[$i]['passport_expire_date']=$pass_expire_date[$i];
							$arr_data[$i]['date_of_birth']=$date_of_birth[$i];
							//$arr_data[$i]['baggage'] = $buggage_count[$i];
							$post_data['pax_type_'.$j] = $person_type[$i];
							$post_data['title_'.$j] = $name_type[$i];
							$post_data['first_name_'.$j] = $first_name[$i];
							$post_data['last_name_'.$j] = $last_name[$i];
							$post_data['id_no_'.$j] = $id_number[$i];
							$post_data['birthdate_'.$j] = $date_of_birth[$i];
							$post_data['paspor_'.$j] = $pass_expire_date[$i];
							$post_data['expire_paspor_'.$j] = $pass_expire_date[$i];
							$post_data['country_paspor_'.$j] =$country_passport[$i];
							$j++;
						}
						//echo '<pre>';
						//print_r($post_data);
					    //print_r($last_insert_id_depart);
					    //echo $last_insert_id_retrun;

							$this->master_db->insert_batch(PASSENGER_DETAILS,$arr_data);
							//book process 
							$result = getDataFromRemot('flight','searchint_book','','',$post_data);
							
						if(isset($result->book_id) && ($result->book_id) != NULL)
						{						
							if($result->search_info->roundtrip == 'retrun'){
							$data['last_insert_id_depart'] = $last_insert_id_depart;
							$data['last_insert_id_retrun'] = $last_insert_id_retrun;
							$oldbookingid = $this->master_db->fetchFlightCustRecord($data);
							//$this->master_db->select('booking_id',CUST_INFO_BOOKING_DETAILS,array("cust_id"=>$last_insert_id_depart, 'cust_id'=>$last_insert_id_retrun));

							print_r($oldbookingid);exit;
							if(isset($oldbookingid) && count($oldbookingid)>0){
								foreach ($oldbookingid as $value) {
								$dataArr = array("booking_id"=>$result->book_id);
							 	$this->master_db->update(CUST_INFO_BOOKING_DETAILS,$dataArr,array("cust_id"=>$last_insert_id_depart));
								}
									
							}
								

							}else{

							$oldbookingid = $this->master_db->select('booking_id',CUST_INFO_BOOKING_DETAILS,array("cust_id"=>$last_insert_id_depart));
						 	$dataArr = array("booking_id"=>$result->book_id);
							 $this->master_db->update(CUST_INFO_BOOKING_DETAILS,$dataArr,array("cust_id"=>$last_insert_id_depart));	
							}
							

							 $this->vtweb_checkout($inputArray);die; //sk comment line add paypal code 



						}else{
							//echo 'byeeeee';exit;
								$get_data_dtl = json_decode($this->input->post('get_data_dtl'));
								$responce_str = site_url().'/flight-details/'.$get_data_dtl->session_id.'/'.$get_data_dtl->flightno_1.'/'.$get_data_dtl->class_id_1; 
								if(isset($get_data_dtl->flightno_2) && $get_data_dtl->flightno_2!= '')
								$responce_str .=	'?flightno_2='.$get_data_dtl->flightno_2.'&class_id_2='.$get_data_dtl->class_id_2;
								if(isset($result->error_msg) && $result->error_msg!=''){
									$errorMsg = $result->error_msg;
								}else{
									$errorMsg='Opps! error please try agin.';
								}
							    $msgArr = array(
									"msg_type"=>"error",
									"msg"=>$errorMsg
								);
								$this->session->set_flashdata($msgArr);
								redirect($responce_str);	
								exit;
						}
					}
				}
			}/*else if($this->input->post('guest_login') == 'guest'){
				echo '<pre>';
				print_r('welocnme');
				print_r($this->input->post());
				exit;
				$this->form_validation->set_rules('guest_name', 'guest_name', 'required');         
				$this->form_validation->set_rules('countriesCode', 'countriesCode', 'required');	    	       
            	$this->form_validation->set_rules('guest_phone', 'guest_phone', 'required|numeric|min_length[4]|max_length[16]');	       
				$this->form_validation->set_rules('guest_email', 'guest_email', 'required');       
				if ($this->form_validation->run()){

				}
			}
*/
	}	


	public function train_booking(){

		$this->load->library('form_validation'); 
		//echo '<pre>';
		   	
        if($this->input->post('trainpay') == 'Trainpay' || $this->input->post('guest_login') == 'guest'){
        	
			$this->form_validation->set_rules('guest_name', 'guest_name', 'required');         	    	       
            $this->form_validation->set_rules('guest_phone', 'guest_phone', 'required|numeric|min_length[4]|max_length[16]');	       
			$this->form_validation->set_rules('guest_email', 'guest_email', 'required');  
			$dataurl = json_decode($this->input->post('get_data_dtl'));
			     
				if ($this->form_validation->run()){
					
					
					//print_r($this->input->post()); exit;
					if($this->input->post('user_type') == 'GUEST'){	
						$dataurl = json_decode($this->input->post('get_data_dtl'));	
	                    $msgbody=str_replace("%USER_NAME%", $this->input->post('guest_name'), GUEST_BODY);
	                    $email = $this->input->post('guest_email');                 
	                    send_email($email,USER_GUEST_SUBJECT,$msgbody);
					}

					$inputArray['guest_name'] = $this->input->post('guest_name');
		            $inputArray['guest_phone'] = $this->input->post('guest_phone');
		            $inputArray['guest_email'] = $this->input->post('guest_email');
		            $inputArray['country_code'] = $this->input->post('countriesCode');		            
		            $inputArray['total_amount'] = str_replace(',','',$this->input->post('total_amount'));

		           // $inputArray['currency_code'] = $this->input->post('currency_code');
		            $inputArray['user_type'] = $this->input->post('user_type');
		            $inputArray['train_name'] = $this->input->post('train_name'); //sk add line	
	            	$inputArray['name_type'] = $this->input->post('name_type');	            
		            $inputArray['person_type'] = $this->input->post('person_type');
		            $inputArray['first_name'] = $this->input->post('first_name');
		            $inputArray['last_name'] = $this->input->post('last_name');
		             $inputArray['id_card'] = $this->input->post('id_card');
		            $inputArray['id_number'] = $this->input->post('id_number');
		            $inputArray['gender'] = $this->input->post('gender');
		          //  $inputArray['berth_preference'] = $this->input->post('berth_preference');
		            $inputArray['passport_number'] = $this->input->post('id_card_no');
		            $inputArray['country_name'] = $this->input->post('country_name');
		            $inputArray['pass_expire_date'] = $this->input->post('pass_expire_date');
		           // print_r($this->input->post('date_of_birth'));exit;
		           
		            $inputArray['date_of_birth'] = $this->input->post('date_of_birth');
		            $inputArray['book_type'] = 'train';
		            $inputArray['buggage_count'] = $this->input->post('buggage_count');
		          
		            $session_data = $this->session->userdata('sess_bk_info_train');
		            $inputArray['sess_bk_info_train'] = $session_data;
		            //print_r($inputArray); exit;
		            $userID = ($this->session->userdata(USER_SESSION.'user_id')!= NULL) ? $this->session->userdata(USER_SESSION.'user_id') : 0;
	           		if($this->input->post('user_type') == 'GUEST'){
		            	$userType = $this->input->post('user_type');
		            }else{
	            		$userType = ($this->session->userdata(USER_SESSION.'user_type') != NULL) ? $this->session->userdata(USER_SESSION.'user_type') :0;
		            }
		            
		            if(isset($session_data->error_msg) && $session_data->error_msg != ''){
		            	 $msgArr = array(
									"msg_type"=>"error",
									"msg"=>$session_data->error_msg
								);
								$this->session->set_flashdata($msgArr);

					//http://localhost/rumbostar/train-details/IkvSKh2tayv3W1SBPj1LxUcUBtcya7NJll2d8r6UeM4/10501?sub_class_1=C&train_name_1=ARGO%20PARAHYANGAN%20PREMIUM
						$redirectlink = site_url().'train-details/'.$dataurl->session_id.'/'.$dataurl->flightno_1.'?sub_class_1='.$dataurl->sub_class_1.'&train_name_1='.$dataurl->train_name_1.'&sub_class_2='.$dataurl->sub_class_2;
						//print_r($redirectlink);exit;
								redirect($redirectlink);	
								exit;
		            }

		             
	            	//depart train - oneway : if condition use arriver time set for depart train with train way 
	             	if(isset($session_data->detail_info->depart->ETA) && $session_data->detail_info->depart->ETA != ''){
	             		
		            	$arrive_time = $session_data->detail_info->depart->ETA;
		            }/*else{
		            	$arrive_time = $session_data->detail_info->eta;
		            }*/
		            //print_r($session_data);exit;

		            //sk - If user select retun radio button and select 2 diff train and booking train use following array 24-1-2018		         
		            if(isset($session_data->detail_info->depart) && $session_data->detail_info->depart->train_no != '' && isset($session_data->detail_info->return) && $session_data->detail_info->return->train_no != ''){
		            	//print_r($inputArray); exit;
		            	//echo 'welcome';exit;

		            	$depart_data_train = array(
	            		 'cust_name' => $inputArray['guest_name'],
						 'cust_phone' => $inputArray['guest_phone'],
						 'cust_email'=> $inputArray['guest_email'],
						 'country_code'=> $inputArray['country_code'],
						 'session_id'=> $session_data->session_id,
						 'booking_amount'=> $inputArray['total_amount'],
						 'user_id' =>$userID,
						 'user_type' => $userType,
						 'train_way' => 'depart',
						 'train_no'=>  $session_data->detail_info->depart->train_no,
						 'train_name' => $inputArray['train_name'], //sk add
						 'train_class' => $session_data->detail_info->depart->class, //sk add
						 'trip_type'=> $session_data->search_info->roundtrip,
						 //'train_type'=>$session_data->search_info->type,
						 'depart_from'=> $session_data->search_info->from,
						 'depart_to'=> $session_data->search_info->to,
						 'depart_date'=> $session_data->search_info->depart,
						 'depart_time'=> $session_data->detail_info->depart->ETD,
						 'arrive_time' => '',//$arrive_time, //sk add
						 'train_from_date'=> $session_data->detail_info->depart->DD,
						 'train_to_date'=> '',
						 'total_idr'=> $session_data->detail_info->price->ticket_price,
						 'booking_date'=>  date('Y-m-d H:i:s'),
						 'payment_status'=>'deny',
						 'order_id'=>'',
						 'book_type'=>'0',
						 );

		            	$deptTo = ($session_data->detail_info->return->to !='')?$session_data->detail_info->return->to:'';

		            	$dateTo = ($session_data->detail_info->return->DD != '')?$session_data->detail_info->return->DD:'';

		            	$arrive_time = ($session_data->detail_info->return->ETA != '')?$session_data->detail_info->return->ETA: '';

		            	$retrun_data_train = array(

	            		 'cust_name' => $inputArray['guest_name'],
						 'cust_phone' => $inputArray['guest_phone'],
						 'cust_email'=> $inputArray['guest_email'],
						 'country_code'=> $inputArray['country_code'],
						 'session_id'=> $session_data->session_id,
						 'booking_amount'=> $inputArray['total_amount'],
						 'user_id' =>$userID,
						 'user_type' => $userType,
						 'train_way' => 'retrun',
						 'train_no'=> $session_data->detail_info->return->train_no,
						 'train_name' => $inputArray['train_name'], //sk add
						 'train_class' =>  $session_data->detail_info->return->class, //sk add
						 'trip_type'=> $session_data->search_info->roundtrip,
						 //'train_type'=>$session_data->search_info->type,
						 'depart_from'=> $session_data->detail_info->return->from,
						 'depart_to'=> $session_data->detail_info->return->to,
						 'depart_date'=> $dateTo,
						 'depart_time'=> $session_data->detail_info->return->ETD,
						 'arrive_time' => $arrive_time, //sk add
						 'train_from_date'=> $session_data->detail_info->return->DD,
						 'train_to_date'=> $session_data->detail_info->return->AD,
						 'total_idr'=> $session_data->detail_info->price->ticket_price,
						 'booking_date'=>  date('Y-m-d H:i:s'),
						 'payment_status'=>'deny',
						 'order_id'=>'',
						 'book_type'=>'0',
						 );

		            }else if(isset($session_data->detail_info->depart) && $session_data->detail_info->depart->train_no != ''){		
		                   	
		            	$depart_data_train = array('cust_name' => $inputArray['guest_name'],
						 'cust_phone' => $inputArray['guest_phone'],
						 'cust_email'=> $inputArray['guest_email'],
						 'country_code'=> $inputArray['country_code'],
						 'session_id'=> $session_data->session_id,
						 'booking_amount'=> $inputArray['total_amount'],
						 'user_id' =>$userID,
						 'user_type' => $userType,
						 'train_way' => 'depart',
						 'train_no'=>$session_data->detail_info->depart->train_no,
						 'train_name' => $inputArray['train_name'], //sk add
						 'train_class' => $session_data->detail_info->depart->class, //sk add
						 'trip_type'=> $session_data->search_info->roundtrip,
						 //'train_type'=>$session_data->search_info->type,
						 'depart_from'=> $session_data->search_info->from,
						 'depart_to'=> $session_data->search_info->to,
						 'depart_date'=> $session_data->search_info->depart,
						 'depart_time'=> $session_data->detail_info->depart->ETD,
						 'arrive_time' => $arrive_time, //sk add
						 'train_from_date'=> $session_data->detail_info->depart->DD,
						 'train_to_date'=> '',
						 'total_idr'=> $session_data->detail_info->price->ticket_price,
						 'booking_date'=>  date('Y-m-d H:i:s'),
						 'payment_status'=>'deny',
						 'order_id'=>'',
						 'book_type'=>'0',
						 );
		            }else if(isset($session_data->detail_info->return) && $session_data->detail_info->return->train_no != ''){

		            	$deptTo = ($session_data->detail_info->return->to !='')?$session_data->detail_info->return->to:'';

		            	$dateTo = ($session_data->detail_info->return->DD != '')?$session_data->detail_info->return->DD:'';

		            	$arrive_time = ($session_data->detail_info->return->ETA != '')?$session_data->detail_info->return->ETA: '';

		            	$retrun_data_train = array(

	            		 'cust_name' => $inputArray['guest_name'],
						 'cust_phone' => $inputArray['guest_phone'],
						 'cust_email'=> $inputArray['guest_email'],
						 'country_code'=> $inputArray['country_code'],
						 'session_id'=> $session_data->session_id,
						 'booking_amount'=> $inputArray['total_amount'],
						 'user_id' =>$userID,
						 'user_type' => $userType,
						 'train_way' => 'retrun',
						 'train_no'=> $session_data->detail_info->return->train_no,
						 'train_name' => $inputArray['train_name'], //sk add
						 'train_class' =>  $session_data->detail_info->return->class, //sk add
						 'trip_type'=> $session_data->search_info->roundtrip,
						 //'train_type'=>$session_data->search_info->type,
						 'depart_from'=> $session_data->detail_info->return->from,
						 'depart_to'=> $session_data->detail_info->return->to,
						 'depart_date'=> $dateTo,
						 'depart_time'=> $session_data->detail_info->return->ETD,
						 'arrive_time' => $arrive_time, //sk add
						 'train_from_date'=> $session_data->detail_info->return->DD,
						 'train_to_date'=> $session_data->detail_info->return->AD,
						 'total_idr'=> $session_data->detail_info->price->ticket_price,
						 'booking_date'=>  date('Y-m-d H:i:s'),
						 'payment_status'=>'deny',
						 'order_id'=>'',
						 'book_type'=>'0',
						 );

		            }

		            $post_data['session_id']= $session_data->session_id;
		            $post_data['cust_name'] = $this->input->post('guest_name');
					$post_data['cust_phone'] = $this->input->post('guest_phone');
					$post_data['cust_email'] = $this->input->post('guest_email');
					

				   
					//echo '====';
					//print_r($inputArray);exit;
		           //print_r($depart_data_train);
		            //echo '---------------';
		            // print_r($retrun_data_train);exit;

		           if(isset($depart_data_train) && count($depart_data_train)>0){
				 		$last_insert_id_depart = $this->master_db->insert(CUST_TRAIN_BOOKING_DETAILS,$depart_data_train);	
				 	}
						
					if(isset($retrun_data_train) && count($retrun_data_train)>0){
				 		$last_insert_id_retrun = $this->master_db->insert(CUST_TRAIN_BOOKING_DETAILS,$retrun_data_train);	
				 	}

				 	if(isset($last_insert_id_depart))
				 	{
				 		$inputArray['last_insert_id_depart']= $last_insert_id_depart;
				 	}
				 	if(isset($last_insert_id_retrun))
				 	{
			 			$inputArray['last_insert_id_retrun'] = $last_insert_id_retrun;
				 	}

					//echo '====';
		           // print_r($inputArray);
		            //echo '---------------';
		           //  exit;
				 	if(isset($last_insert_id_depart) && $last_insert_id_depart > 0 || isset($last_insert_id_retrun) && $last_insert_id_retrun >0)
					{
					 	
						$name_type =   $inputArray['name_type'];
						$person_type = $inputArray['person_type'];
						$first_name = $inputArray['first_name'];
						$last_name = $inputArray['last_name'];
						$id_card = $inputArray['id_card'];
                        $id_number = $inputArray['id_number'];
                        $gender = $inputArray['gender'];
                       // $berth_preference = $inputArray['berth_preference'];
                        $passport_number = $inputArray['passport_number'];
                        $country_name = $inputArray['country_name'];
                        $pass_expire_date= $inputArray['pass_expire_date'];
                        $date_of_birth = $inputArray['date_of_birth'];
                        $buggage_count= $inputArray['buggage_count'];

						$j=1;
						$pass_cnt =0;
						for($i=0;$i< count($inputArray['name_type']);$i++)
						{		
						 					
						 	if(isset($last_insert_id_depart))
						 	{
					 		 	$arr_data[$i]['cust_id'] = $last_insert_id_depart;
					 		 	$arr_data[$i]['cust_dept_id'] = $last_insert_id_depart;
						 	}
						 	if(isset($last_insert_id_retrun))
						 	{
					 			$arr_data[$i]['cust_id'] = $last_insert_id_retrun;
					 			$arr_data[$i]['cust_dept_id'] = $last_insert_id_retrun;
						 	}
						 	if(isset($last_insert_id_depart) && $last_insert_id_depart != '' && isset($last_insert_id_retrun) && $last_insert_id_retrun != ''){
						 		$arr_data[$i]['cust_dept_id'] = $last_insert_id_depart;
						 	}						  
						    
						    $arr_data[$i]['travel_way'] = 'train';
						    $arr_data[$i]['user_id'] = $userID;
							$arr_data[$i]['title']=$name_type[$i];
							$arr_data[$i]['person_type']=$person_type[$i];
							$arr_data[$i]['first_name']=$first_name[$i];
							$arr_data[$i]['last_name']=$last_name[$i];
							$arr_data[$i]['id_number']=$id_number[$i];
							$arr_data[$i]['gender'] = $gender[$i];
							//$arr_data[$i]['berth_preference']= $berth_preference[$i];
							$arr_data[$i]['passport_number']=$passport_number[$i];
							$arr_data[$i]['country_passport']=$country_name[$i];
							$arr_data[$i]['passport_expire_date']=$pass_expire_date[$i];

							$arr_data[$i]['date_of_birth']=$date_of_birth[$i];
							$arr_data[$i]['baggage'] = $buggage_count[$i];


							$post_data['pass_type_'.$j] = $person_type[$i];
							// $post_data['title_'.$j] = $name_type[$i];
							$post_data['name_'.$j] = $first_name[$i];
							//$post_data['first_name_'.$j] = $first_name[$i];
							//$post_data['last_name_'.$j] = $last_name[$i];
							$post_data['id_card_'.$j] = $id_card[$i];
							$post_data['hp_'.$j] = $id_number[$i];
							$dateformat =  date("Y-m-d", strtotime($date_of_birth[$i]));
				           // print_r();
				           // exit;
							$post_data['birthdate_'.$j] = $dateformat;
							//$post_data['paspor_'.$j] = $pass_expire_date[$i];
							//$post_data['expire_paspor_'.$j] = $pass_expire_date[$i];
							//$post_data['country_paspor_'.$j] =$country_name[$i];
							$pass_cnt= $j;
							$j++;
						}

							$this->master_db->insert_batch(PASSENGER_DETAILS,$arr_data);
							//book process 
							//print_r($post_data);exit;
							$result = getDataFromRemot('train','train_book','','',$post_data);
						// print_r($result);exit;
						if(isset($result->book_id) && ($result->book_id) != NULL)
						{	//echo '<pre>';
							//print_r($result);exit;
							if($session_data->search_info->roundtrip == 'oneway'){
								$schedule_type = 'depart';
							}
							if($session_data->search_info->roundtrip == 'return'){
								$schedule_type = 'return';
							}
							$mapTrain['schedule_type'] =$schedule_type;
							$mapTrain['session_id'] = $session_data->session_id;

							if(isset($session_data->detail_info->depart->train_no) && isset($session_data->detail_info->return->train_no)){
								$mapTrain['train_no'] = $session_data->detail_info->depart->train_no;
							}else if(isset($session_data->detail_info->return->train_no)){
								$mapTrain['train_no'] =$session_data->detail_info->return->train_no;
							}else if(isset($session_data->detail_info->depart->train_no)){
								$mapTrain['train_no'] = $session_data->detail_info->depart->train_no;	
							}
							// print_r($mapTrain);exit;
							$resultMap = getDataFromRemot('train','train_seatmap','','',$mapTrain);
							$map_data['result'] = $resultMap;
							$pass_data['result'] = $pass_cnt;
							// echo '<pre>';
							// print_r($resultMap);exit;

							if(isset($result->search_info->roundtrip) && $result->search_info->roundtrip == 'retrun'){
							$data['last_insert_id_depart'] = $last_insert_id_depart;
							$data['last_insert_id_retrun'] = $last_insert_id_retrun;
							$oldbookingid = $this->master_db->fetchTrainCustRecord($data);
							
							//print_r($oldbookingid);exit;
							if(isset($oldbookingid) && count($oldbookingid)>0){
								foreach ($oldbookingid as $value) {
								$dataArr = array("booking_id"=>$result->book_id);
							 	$this->master_db->update(CUST_TRAIN_BOOKING_DETAILS,$dataArr,array("cust_id"=>$last_insert_id_depart));
								}
									
							}							

							}else{
								
							$oldbookingid = $this->master_db->select('booking_id',CUST_TRAIN_BOOKING_DETAILS,array("cust_id"=>$last_insert_id_depart));
							//print_r($oldbookingid);exit;
						 	 $dataArr = array("booking_id"=>$result->book_id);
							 $this->master_db->update(CUST_TRAIN_BOOKING_DETAILS,$dataArr,array("cust_id"=>$last_insert_id_depart));
							}						
							
							// $this->vtweb_checkout($inputArray);die; //sk comment line add paypal code 
							$this->session->set_userdata('sitemap',$map_data); 
							$this->session->set_userdata('pass_cnt',$pass_data); 
							 $redirectlink = site_url().'train-sitemap';
 							redirect($redirectlink);	
							/* 
							 */

						}else{
							//echo '<pre>';
							//print_r($dataurl);exit;
							if(isset($result->error_msg) && ($result->error_msg != '')){
								//http://localhost/rumbostar/train-details/cUbb6J7GcpPJUPv_5VGduoiORQkP61mA4PE8M5cmyvg/P05?sub_class_1=C&train_name_1=ARGO%20PARAHYANGAN
								//print_r($dataurl);
								//http://exceptionaire.co/rumbostar/train-details/8nC24ntXhkKypvM7cBFfsCf_SI27w0ndmmS2V0i6awI/P05?sub_class_1=C&train_name_1=ARGO%20PARAHYANGAN&train_no_2=11G&sub_class_2=C&train_name_2=ARGO%20GOPAR
								if(isset($dataurl->train_name_2) && $dataurl->train_name_2 != '' && isset($dataurl->train_name_1) && $dataurl->train_name_1 !=''){
									$redirectlink = site_url().'train-details/'.$dataurl->session_id.'/'.$dataurl->train_no_1.'?sub_class_1='.$dataurl->sub_class_1.'&train_name_1='.$dataurl->train_name_1.'&train_no_2='.$dataurl->train_no_2.'&sub_class_2='.$dataurl->sub_class_2.'&train_name_2='.$dataurl->train_name_2;
								}else if(isset($dataurl->train_name_1) && $dataurl->train_name_1 !=''){

									$redirectlink = site_url().'train-details/'.$dataurl->session_id.'/'.$dataurl->train_no_1.'?sub_class_1='.$dataurl->sub_class_1.'&train_name_1='.$dataurl->train_name_1;		
								}else{
									$redirectlink = site_url().'train-details/'.$dataurl->session_id.'/'.$dataurl->train_no_2.'?sub_class_2='.$dataurl->sub_class_2.'&train_name_2='.$dataurl->train_name_2;
								}
									
									//echo ($redirectlink);
									$msgArr = array(
													"msg_type"=>"error",
													"msg"=>$result->error_msg
											);
										$this->session->set_flashdata($msgArr);
										redirect($redirectlink);	
										exit;
								}						

							
						 }


				 	}

				}else{
					//echo 'byyy';
				}


        }
	}
	public function train_site_map()
	{
		$this->template->write('title', 'Train Seatmap');
		$this->template->write_view('header', 'includes/header',TRUE);
		$this->template->write_view('content', 'train-sitemap','',TRUE);	
		$this->template->write_view('footer', 'includes/footer', '', TRUE);
		$this->template->render();
	}

	public function vtweb_checkout($inputArray)
	{	
		
		$returnURL = base_url().'bookings/notification';
		$cancelURL = base_url().'paypal/cancel'; //payment cancel url
		$notifyURL = base_url().'paypal/ipn'; //ipn url
 		/*$returnURL = base_url().'paypal/success'; //payment success url

		$cancelURL = base_url().'paypal/cancel'; //payment cancel url
		$notifyURL = base_url().'paypal/ipn'; //ipn url*/
		//echo 'dfd';
		//print_r($inputArray);exit;
		if($inputArray['book_type'] == 'flight' && $inputArray['user_type'] == 'GUEST'){
			$data['booking_name'] = $inputArray['flight_name'];
			$data['cust_email'] = $inputArray['guest_email'];
			$data['total_amount'] = $inputArray['total_amount'];
			$data['item_number'] =  $inputArray['guest_phone']; 
			//change item number u set customer id or flight no
			$data['order_id'] = uniqid();
		}else if($inputArray['book_type'] == 'flight' && $inputArray['user_type'] == 'USER'){
			$data['booking_name'] = $inputArray['flight_name'];
			$data['cust_email'] = $inputArray['guest_email'];
			$data['total_amount'] = $inputArray['total_amount'];
			$data['item_number'] =  $inputArray['guest_phone']; 
			//change item number u set customer id or flight no
			$data['order_id'] = uniqid();

		}else if($inputArray['book_type'] == 'flight' && $inputArray['user_type'] == 'AGENT'){
			$data['booking_name'] = $inputArray['flight_name'];
			$data['cust_email'] = $inputArray['guest_email'];
			$data['total_amount'] = $inputArray['total_amount'];
			$data['item_number'] =  $inputArray['guest_phone']; 
			//change item number u set customer id or flight no
			$data['order_id'] = uniqid();
		}


		if($inputArray['book_type'] == 'train' && $inputArray['user_type'] == 'GUEST'){
			$data['booking_name'] = $inputArray['train_name'];
			$data['cust_email'] = $inputArray['guest_email'];
			$data['total_amount'] = $inputArray['total_amount'];
			$data['item_number'] =  $inputArray['guest_phone']; 
			//change item number u set customer id or train no
			$data['order_id'] = uniqid();
		}else if($inputArray['book_type'] == 'train' && $inputArray['user_type'] == 'USER'){
			$data['booking_name'] = $inputArray['train_name'];
			$data['cust_email'] = $inputArray['guest_email'];
			$data['total_amount'] = $inputArray['total_amount'];
			$data['item_number'] =  $inputArray['guest_phone']; 
			//change item number u set customer id or train no
			$data['order_id'] = uniqid();

		}else if($inputArray['book_type'] == 'train' && $inputArray['user_type'] == 'AGENT'){
			$data['booking_name'] = $inputArray['train_name'];
			$data['cust_email'] = $inputArray['guest_email'];
			$data['total_amount'] = $inputArray['total_amount'];
			$data['item_number'] =  $inputArray['guest_phone']; 
			//change item number u set customer id or train no
			$data['order_id'] = uniqid();

		}
		//echo 'hii23';
		//print_r($inputArray);exit;
		if(isset($inputArray['last_insert_id_retrun'])){
			$retrunInsertID = $inputArray['last_insert_id_retrun'];
		}else{
			$retrunInsertID = 0;
		}
		$transdata = array(
			'order_id' => uniqid(),
			'gross_amount'=>str_replace(',','',$inputArray['total_amount']),
			'first_name' => $inputArray['guest_name'],
			'phone' => $inputArray['guest_phone'],
			'dept_custom_field1' => $inputArray['last_insert_id_depart'],
			'retrun_custom_field1' => $retrunInsertID,
			'custom_field2' => $inputArray['book_type'],
		);

 		$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('cancel_return', $cancelURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		$this->paypal_lib->add_field('item_name', $data['booking_name']);
		$this->paypal_lib->add_field('custom', $data['cust_email']);
		$this->paypal_lib->add_field('item_number',  $data['item_number']);
		$this->paypal_lib->add_field('amount',  '23');	
		$this->paypal_lib->add_field('or_id', '43434342');

		//$this->paypal_lib->image($logo); $data['booking_amount']	
		
		$this->paypal_lib->paypal_auto_form();
		$this->notification($transdata);
		 exit;



		/*$transaction_details = array(
			'order_id' => uniqid(),
			'gross_amount'=>str_replace(',','',$inputArray['total_amount']),
		);
		// Populate customer's Info
		$customer_details = array(
			'first_name' => $inputArray['guest_name'],
			'email' => $inputArray['guest_email'],
			'phone' => $inputArray['guest_phone'],
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
			'custom_field1' => $inputArray['last_insert_id'],
			'custom_field2' => $inputArray['book_type']
		);
		try
		{
			$vtweb_url = $this->veritrans->vtweb_charge($transaction_data);
			header('Location: ' . $vtweb_url);
		} 
		catch (Exception $e) 
		{
    		echo $e->getMessage();	
		}*/
	}

	public function notification($transdata = NULL)
	{ 		

		//echo '<pre>';
		//print_r($transdata);

	  //$responce_str = site_url().'/hotel'; 
		echo 'Payment accepted successfully ';
		//redirect($responce_str);
		//exit;

		$paypalInfo = $this->input->get();
		// print_r($paypalInfo);
		// print_r($transdata);
		 exit;
		$data['item_number'] = $paypalInfo['item_number']; 
		$data['txn_id'] = $paypalInfo["tx"];
		$data['payment_amt'] = $paypalInfo["amt"];
		$data['currency_code'] = $paypalInfo["cc"];
		$data['status'] = $paypalInfo["st"];
		$data['email_id'] = $paypalInfo["cm"];

		//print_r($data);exit;
		$json_result = file_get_contents('php://input');

		$result = json_decode($json_result);
		

		//sk $order_id = $paypalInfo["order_id"]; //$_GET['order_id']; sk
		$transaction_status = $paypalInfo["st"]; //$_GET['transaction_status'];sk
		// sk $notif = $this->veritrans->status($order_id);
		$transaction = $transaction_status;
		$gross_amount = $paypalInfo["amt"]; //$notif->gross_amount; sk
		$type = $paypalInfo["cc"]; //$notif->payment_type; sk
		//sk $order_id = $order_id; 
	    /*$fraud = $notif->fraud_status;
	    $cust_id = $notif->custom_field1;
	    $book_type = $notif->custom_field2;*/
	    echo 'hii';exit;
 		//print_r($fraud);exit;

	    $arr_booking_dtls =array();
	    $inputArray=array();
	    switch($book_type){
			case 'flight':
			if ($transaction == 'Completed') {

		    if($fraud == 'accept'){
					$dataArr = array("order_id"=>$order_id,"payment_status"=>'accept');
                    $this->master_db->update(CUST_INFO_BOOKING_DETAILS,$dataArr,array("cust_id"=>$cust_id));
                    if($book_type=='flight') {
                    	//booking pay Flight
                    	$arr_booking_dtls=array();
						$arr_booking_dtls = $this->master_db->select('cust_id,cust_name,cust_phone,cust_email,session_id,booking_id',CUST_INFO_BOOKING_DETAILS,array("cust_id"=>$cust_id));

						$post_data = array();
						$post_data = $this->master_db->select('*',PASSENGER_DETAILS,array("cust_id"=>$arr_booking_dtls[0]->cust_id));
						if(count($arr_booking_dtls) !=''){
							foreach($arr_booking_dtls as $k=>$val){
							$inputArray['cust_name'] = $val->cust_name;
							$inputArray['cust_phone']= $val->cust_phone;
							$inputArray['cust_email']= $val->cust_email;
							$inputArray['session_id']= $val->session_id;
							$inputArray['book_id']= $val->booking_id;
						}
					}
						if(count($post_data) !='') {
							foreach($post_data as $key=>$value){
								$inputArray['pax_type_'.$key] = $value->person_type;
								$inputArray['title_'.$key] = $value->title;
								$inputArray['first_name_'.$key] = $value->first_name;
								$inputArray['last_name_'.$key] = $value->last_name;
								$inputArray['id_no_'.$key] = $value->id_number;
								$inputArray['birthdate_'.$key] = $value->date_of_birth;
								$inputArray['paspor_'.$key] = $value->passport_number;
								$inputArray['expire_paspor_'.$key] = $value->passport_expire_date;
								$inputArray['country_paspor_'.$key] =$value->country_passport;
						}
						$result = getDataFromRemot('flight','issue','','',$inputArray); 
						$data['result'] = $result;
						}
					}
		      }else{				
				$data['result'] = "no data";
			}
		     
		  }
		  else
		  {
			$this->template->write_view('content', 'flight-book-fail', TRUE);
		  }
		   $this->template->write_view('content', 'flight-book-success',$data, TRUE);
		  break;
		  case 'hotel':
		  if ($transaction == 'capture') {
		  	
		  	//echo '<pre>';		  	
		  //	echo $fraud;
		    if($fraud == 'accept'){
		    	//print_r($arr_booking_dtls);exit;
				$dataArr = array("order_id"=>$order_id,"payment_status"=>'accept');
                $this->master_db->update(CUST_HOTEL_BOOKING_DETAILS,$dataArr,array("cust_id"=>$cust_id));
				//booking pay Hotel
				$arr_booking_dtls = $this->master_db->select('*',CUST_HOTEL_BOOKING_DETAILS,array("cust_id"=>$cust_id));

				$arr_booking_dtls =end($arr_booking_dtls);
				
				$inputArray['session_id'] = $arr_booking_dtls->session_id;
				$inputArray['payment_type'] = 'deposit';
				$inputArray['payref'] = 'payref';
				$inputArray['room_code'] = $arr_booking_dtls->room_code;
				$inputArray['number_of_room'] = $arr_booking_dtls->no_of_rooms;
				$inputArray['guest_phone'] = $arr_booking_dtls->cust_phone;
				$inputArray['guest_email'] = $arr_booking_dtls->cust_email;
				$inputArray['room_name_1'] = $arr_booking_dtls->room_name;
				$result = getDataFromRemot('hotel','hotel_pay','','',$inputArray); 
				if(isset($result->error_msg) && ($result->error_msg != '')){
					$responce_str = site_url().'/hotel-booking/'.$arr_booking_dtls->session_id.'/'.$arr_booking_dtls->room_code; 
					$msgArr = array(
									"msg_type"=>"error",
									"msg"=>$result->error_msg
							);
						$this->session->set_flashdata($msgArr);
						redirect($responce_str);	
						exit;
				}else{	
					//echo 'welcome';exit;
					$dataArr = array("booking_id" => $result->bookId);
					$this->master_db->update(CUST_HOTEL_BOOKING_DETAILS,$dataArr,array("cust_id"=>$cust_id));
					$data['result'] = $result;					
				}
			}else{
				//echo 'hjjhgjgh<pre>ghjghj';
				//print_r($data);exit;
				$data['result'] = "no data";
			}			
			
			$this->template->write_view('content', 'hotel-book-success', $data,TRUE);	
		}else{
			$this->template->write_view('content', 'hotel-book-fail', TRUE);
		}
		break;
		case 'add_balance':
		  if ($transaction == 'capture') {
		    if($fraud == 'accept'){
		    		$this->load->model('user_model','user');
		    	 	$user_updated_date=date("Y-m-d H:i:s");
		    	 	$final_amount =0;
		    	 	$userinfo = $this->master_db->select('user_id,wallet_balance',USERS,array('user_id'=>$this->session->userdata(USER_SESSION.'user_id')));
		    	 	if($userinfo[0]->wallet_balance>0){
		    	 		$final_amount = $userinfo[0]->wallet_balance + $gross_amount;
		    	 	}else if($userinfo[0]->wallet_balance==0 ||$userinfo[0]->wallet_balance=='' ){
		    	 		$final_amount = $gross_amount;
		    	 	}
					$data= array('wallet_balance' => $final_amount,'users_updated_date'=>$user_updated_date);
	               // $this->user->updateuser_info($data);
					$this->master_db->update(USERS,$data,array('user_id'=>$this->session->userdata(USER_SESSION.'user_id')));
					$dataInsert = array(
											"amount"=>$gross_amount,
											"transaction_type"=>'Cr',
											"final_amount"=>$final_amount,
											"userid"=>$this->session->userdata(USER_SESSION.'user_id')
										);
					$this->master_db->insert(WALLET_HISTORY,$dataInsert);
	                $msgArr = array(
	                        "status"=>"success",
	                        "msg"=> $gross_amount." Added in your wallet sucessfully."
	                        );

	                $this->session->set_flashdata($msgArr);
	                redirect('user-profile');
				}else{	
					$msgArr = array(
	                        "status"=>"error",
	                        "msg"=> "oops something went wrong"
	                        );

	                $this->session->set_flashdata($msgArr);
	                redirect('user-profile');
				}
						
		}else{
			$msgArr = array(
                    "status"=>"error",
                    "msg"=> "oops something went wrong"
                    );

            $this->session->set_flashdata($msgArr);
            redirect('user-profile');
		}
		break;
	}
		$this->template->write('title', 'Payment Success');
		$this->template->write_view('header', 'includes/header',TRUE);
		$this->template->write_view('footer', 'includes/footer', '', TRUE);
		$this->template->render();
    }
    
    /* @author : Smita
     * @function use : user_cancel_flight_booking use for show cancel flight details 
     * @date : 22-12-2017
     */

	public function user_cancel_flight_booking(){

		$data = array();
        $this->load->library('template'); 
        $this->template->write('title', 'Cancel Flight Booking');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'cancel-flight-booking', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();   	
	}

	/* @author : Smita
     * @function use : user_cancel_hotel_booking use for show cancel hotel details 
     * @date : 22-12-2017
     */

	public function user_cancel_hotel_booking(){

		$data = array();
        $this->load->library('template'); 
        $this->template->write('title', 'Cancel Hotel Booking');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'cancel-hotel-booking', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render(); 
		
	}

	/* @author : Smita
     * @function use : user_cancel_train_booking use for show cancel train details 
     * @date : 29-12-2017
     */

	public function user_cancel_train_booking(){

		$data = array();
        $this->load->library('template'); 
        $this->template->write('title', 'User Cancel Train Booking');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'cancel-train-booking', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render(); 
	}

	/* @author : Smita
     * @function use : flight_passenger_list use for show flight booking pessager list details 
     * @date : 2-1-2018
     */

	public function flight_passenger_list($user_book_id,$cust_id,$flight_no){
		//print_r(decode_string($user_book_id));exit;
		$arr_flight_booking =array();
		$customer_detl = $this->master_db->fetchMyFlightbyflightid(decode_string($user_book_id),decode_string($flight_no));
		$data['customer_detl'] = $customer_detl;
		$arr_flight_booking = $this->master_db->fetchPessagerDetailWithFlight(decode_string($user_book_id), decode_string($cust_id));
		//$arr_flight_booking = $this->master_db->select('*',CUST_HOTEL_BOOKING_DETAILS,array("cust_id"=>));
		$data['arr_flight_booking']= $arr_flight_booking;
		//echo '<pre>';
		//print_r($data['arr_flight_booking']);
		//$data = array();
        $this->load->library('template'); 
        $this->template->write('title', 'Flight Passenger Booking');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'flight-booking-passenger', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render(); 
	}

	/* @author : Smita
     * @function use : train_passenger_list use for show train booking pessager list details 
     * @date : 4-1-2018
     */

	public function train_passenger_list(){

		$data = array();
        $this->load->library('template'); 
        $this->template->write('title', 'Train Passenger Booking');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'train-booking-passenger', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render(); 
	}


	public function flight_Booking_Tickit_Share(){
	
		if($_POST['cust_id'] != ''){
				//echo '<pre>';
				//print_r($_POST);exit;
				$booking_type = '0';
				$resExists = $this->master_db->shareingExits($_POST['social_from'], $_POST['cust_id'],$booking_type);
				
				if(count($resExists)>0){
			}else{

				 $result = $this->master_db->socialShareInsert($_POST);				
				 if($result>0){
				 	$msgArr = array(
	                            "status"=>"success",
	                            "msg"=>"Successfully posted."
	                            );	                       
	                echo json_encode($msgArr);exit;	               
				 }else{
				 	$msgArr = array(
	                            "status"=>"fail",
	                            "msg"=>"Not posted."
	                            );	                       
	                echo json_encode($msgArr);exit;
				 }
			}		
			
		} 
		
	}
    
}

