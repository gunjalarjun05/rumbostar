<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bookings extends CI_Controller {

       
    public function __construct() {
        parent::__construct();
         $params = array('server_key' => 'your_server_key', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
	    $this->load->library('form_validation');
        $this->load->library('php_fastcache');
        $this->load->helper('cookie');
        $this->load->model('serviceData','service_m');
        $this->load->library('template');  
        $this->lang->load('message','english'); 
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
        if($this->input->post('hotelpay') == 'pay') {
            $inputArray['sess_bk_info'] = $this->session->userdata('sess_bk_info');
            $session_data = $this->session->userdata('sess_bk_info');
            $inputArray['session_id'] = $this->input->post('session_id');
            $inputArray['payment_type'] = 'deposit';
            $inputArray['payref'] = $this->input->post('payref');
            $inputArray['room_code'] = $this->input->post('room_code');
            $inputArray['number_of_room'] = $session_data->search_info->room;
            $inputArray['guest_phone'] = $this->input->post('guest_phone');
            $inputArray['guest_email'] = $this->input->post('guest_email');
            $inputArray['guest_name'] = $this->input->post('guest_name');
            $inputArray['book_type'] = 'hotel';
            $userID = ($this->session->userdata(USER_SESSION.'user_id')!= NULL) ? $this->session->userdata(USER_SESSION.'user_id') : 0;
            $userType = ($this->session->userdata(USER_SESSION.'user_type') != NULL) ? $this->session->userdata(USER_SESSION.'user_type') :0;
            $curren=(isset($curr['IDR']) && $curr['IDR']!='')? $curr['IDR']:'';
            $offer = get_hotel_city_offer($session_data->search_info->city,$session_data->room_price->total_price);
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
						 'no_of_rooms'=> $session_data->search_info->room,
						 'room_code'=> $this->input->post('room_code'),
						 'room_name'=> $session_data->name_room,
						 'hotel_name'=> $session_data->name_hotel,
						 'check_in_date'=> $session_data->ci,
						 'check_out_date'=> $session_data->co,
						 'total_idr'=> '',
						 'booking_date'=> date("Y-m-d"),
						 'payment_status'=>'deny',
						 'order_id'=>'',
						 'book_type'=>'1',
						 'no_of_night'=> $session_data->night,
						 'no_of_guest'=> '2',
						 'address'=> $session_data->address_hotel,
						 'city'=> $session_data->search_info->city,
						 );
            //echo '<pre>';
            //print_r($data);exit;
						 $last_insert_id = $this->master_db->insert(CUST_HOTEL_BOOKING_DETAILS,$data);
						 $inputArray['last_insert_id']=$last_insert_id;
						 if($last_insert_id) {
						 	if($this->session->userdata(USER_SESSION.'is_logged_in') == true && $this->session->userdata(USER_SESSION.'user_type') == 'AGENT'){
						 		$this->hotel_booking_by_agent($last_insert_id,$inputArray['total_amount']);
						 	}else{
						 		$this->vtweb_checkout($inputArray);die;
						 	}
					     
						
						}
        } 
    }
    
    public function hotel_booking_by_agent($bkTblID,$amount){
    	$order_id = rand();
    	$dataArr = array("order_id"=>$order_id,"payment_status"=>'accept');
        $this->master_db->update(CUST_HOTEL_BOOKING_DETAILS,$dataArr,array("cust_id"=>$bkTblID));
		//booking pay Hotel
		$arr_booking_dtls = $this->master_db->select('*',CUST_HOTEL_BOOKING_DETAILS,array("cust_id"=>$bkTblID));
		$arr_booking_dtls =end($arr_booking_dtls);
		$inputArray['session_id'] = $arr_booking_dtls->session_id;
		$inputArray['payment_type'] = 'deposit';
		$inputArray['payref'] = 'payref';
		$inputArray['room_code'] = $arr_booking_dtls->room_code;
		$inputArray['number_of_room'] = $arr_booking_dtls->no_of_rooms;
		$inputArray['guest_phone'] = $arr_booking_dtls->cust_phone;
		$inputArray['guest_email'] = $arr_booking_dtls->cust_email;
		$inputArray['room_name_1'] = $arr_booking_dtls->room_name;

		$userinfo = $this->master_db->select('user_id,wallet_balance',USERS,array('user_id'=>$this->session->userdata(USER_SESSION.'user_id')));
	 	if($userinfo[0]->wallet_balance<$amount){
	 		$responce_str = site_url().'/hotel-booking/'.$arr_booking_dtls->session_id.'/'.$arr_booking_dtls->room_code; 
			$msgArr = array(
							"msg_type"=>"error",
							"msg"=>'Ballance is insufficient to proceed this booking. Please add the Ballance to complete this booking.'
					);
				$this->session->set_flashdata($msgArr);
				redirect($responce_str);	
				exit;
	 	}
	 		$final_amount = $userinfo[0]->wallet_balance - $amount;
	 		$data= array('wallet_balance' => $final_amount);
			
		 	

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
			$this->master_db->update(USERS,$data,array('user_id'=>$this->session->userdata(USER_SESSION.'user_id')));
			$dataInsert = array(
									"amount"=>$amount,
									"transaction_type"=>'Dr',
									"final_amount"=>$final_amount,
									"booking_id"=>$result->bookId,
									"userid"=>$this->session->userdata(USER_SESSION.'user_id')
								);
			$this->master_db->insert(WALLET_HISTORY,$dataInsert);
			$dataArr = array("booking_id" => $result->bookId);
			$this->master_db->update(CUST_HOTEL_BOOKING_DETAILS,$dataArr,array("cust_id"=>$bkTblID));
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
        if($this->input->post('flightpay') == 'pay'){
        	//print_r('111');exit;
        	$this->form_validation->set_rules('guest_name', 'guest_name', 'required');         	    	       
            $this->form_validation->set_rules('guest_phone', 'guest_phone', 'required|numeric|min_length[4]|max_length[16]');	       
			$this->form_validation->set_rules('guest_email', 'guest_email', 'required');       
				if ($this->form_validation->run()){
		            $inputArray['guest_name'] = $this->input->post('guest_name');
		            $inputArray['guest_phone'] = $this->input->post('guest_phone');
		            $inputArray['guest_email'] = $this->input->post('guest_email');
		            $inputArray['total_amount'] = str_replace(',','',$this->input->post('total_amount'));
		            $inputArray['currency_code'] = $this->input->post('currency_code');
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

	           		$userID = ($this->session->userdata(USER_SESSION.'user_id')!= NULL) ? $this->session->userdata(USER_SESSION.'user_id') : 0;
	           		$userType = ($this->session->userdata(USER_SESSION.'user_type') != NULL) ? $this->session->userdata(USER_SESSION.'user_type') :0;

					$data = array('cust_name' => $this->input->post('guest_name'),
					 'cust_phone' => $this->input->post('guest_phone'),
					 'cust_email'=> $this->input->post('guest_email'),
					 'session_id'=> $session_data->session_id,
					 'booking_amount'=> str_replace(',','',$this->input->post('total_amount')),
					 'user_id' =>$userID,
					 'user_type' => $userType,
					 'depart_from'=> $session_data->search_info->from,
					 'depart_to'=> $session_data->search_info->to,
					 'depart_date'=> $session_data->search_info->depart,
					 'depart_time'=> $session_data->depart_detail->etd,
					 'flight_from_date'=> $session_data->depart_detail->date,
					 'flight_to_date'=> $session_data->depart_detail->date,
					 'total_idr'=> $session_data->depart_detail->price->total_idr,
					 'booking_date'=> $session_data->search_info->depart,
					 'payment_status'=>'deny',
					 'order_id'=>'',
					 'book_type'=>'0',
					 );
					 $post_data['cust_name'] = $this->input->post('guest_name');
					 $post_data['cust_phone'] = $this->input->post('guest_phone');
					 $post_data['cust_email'] = $this->input->post('guest_email');
					 $post_data['session_id']= $session_data->session_id;
					 
					 $last_insert_id = $this->master_db->insert(CUST_INFO_BOOKING_DETAILS,$data);
					 $inputArray['last_insert_id']=$last_insert_id;

					if($last_insert_id > 0)
					{
					 	//echo '<pre>';	
						$name_type = $this->input->post('name_type');
						$person_type = $this->input->post('person_type');
						$first_name = $this->input->post('first_name');
						$last_name = $this->input->post('last_name');
                        $id_number = $this->input->post('id_number');

                        $passport_number = $this->input->post('passport_number');
                        $country_passport = $this->input->post('country_passport');
                        $pass_expire_date= $this->input->post('pass_expire_date');
                        $date_of_birth = $this->input->post('date_of_birth');
                        $buggage_count= $this->input->post('buggage_count');
						$j=1;
						//print_r($this->input->post('name_type'));exit;
						for($i=0;$i< count($this->input->post('name_type'));$i++)
						{
							$arr_data[$i]['cust_id']= $last_insert_id;
							$arr_data[$i]['title']=$name_type[$i];
							$arr_data[$i]['person_type']=$person_type[$i];
							$arr_data[$i]['first_name']=$first_name[$i];
							$arr_data[$i]['last_name']=$last_name[$i];
							$arr_data[$i]['id_number']=$id_number[$i];
							$arr_data[$i]['passport_number']=$passport_number[$i];
							$arr_data[$i]['country_passport']=$country_passport[$i];
							$arr_data[$i]['passport_expire_date']=$pass_expire_date[$i];
							$arr_data[$i]['date_of_birth']=$date_of_birth[$i];
							$arr_data[$i]['baggage'] = $buggage_count[$i];
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
							$this->master_db->insert_batch(PASSENGER_DETAILS,$arr_data);
							//book process 
							$result = getDataFromRemot('flight','searchint_book','','',$post_data);
							//echo '<pre>';
							//print_r($result);exit;
						if(isset($result->book_id) && ($result->book_id) != NULL)
						{
							$oldbookingid = $this->master_db->select('booking_id',CUST_INFO_BOOKING_DETAILS,array("cust_id"=>$last_insert_id));
							 $dataArr = array("booking_id"=>$result->book_id);
							 $this->master_db->update(CUST_INFO_BOOKING_DETAILS,$dataArr,array("cust_id"=>$last_insert_id));
							 $this->vtweb_checkout($inputArray);die;
						}else{
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
				print_r('welocnme');exit;
			}*/

	}		

	public function vtweb_checkout($inputArray)
	{		
		$transaction_details = array(
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
		}
	}

	public function notification()
	{ 		

		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);
		$order_id = $_GET['order_id'];
		$transaction_status = $_GET['transaction_status'];
		$notif = $this->veritrans->status($order_id);
		$transaction = $transaction_status;
		$gross_amount = $notif->gross_amount;
		$type = $notif->payment_type;
		$order_id = $order_id;
	    $fraud = $notif->fraud_status;
	    $cust_id = $notif->custom_field1;
	    $book_type = $notif->custom_field2;


	    $arr_booking_dtls =array();
	    $inputArray=array();
	    switch($book_type){
			case 'flight':
			if ($transaction == 'capture') {
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
     * @function use : flight_passenger_list use for show fic booking pessager list details 
     * @date : 2-1-2018
     */

	public function flight_passenger_list(){

		$data = array();
        $this->load->library('template'); 
        $this->template->write('title', 'Flight Passenger Booking');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'flight-booking-passenger', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render(); 
	}
    
}

