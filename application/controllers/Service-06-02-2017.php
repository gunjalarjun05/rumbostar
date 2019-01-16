<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends CI_Controller {

       
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('php_fastcache');
        $this->load->helper('cookie');
        $this->load->model('serviceData','service_m');
    }
    
    public function flight($pageid=false) {        
        $this->load->library('template');     
        $setCatcheData = array();
        $range_slide_min = $range_slide_max = $errorMsg = '';         
        if($this->input->post('searchflight') == 'Search Flights'){
            
            $from = $this->input->post('flight_from');
            $to = $this->input->post('flight_to');
            $depart = date('Y-m-d',strtotime($this->input->post('depart')));
            $adult = $this->input->post('adult');
            $child = $this->input->post('child');
            $infant = $this->input->post('infant');
            $roundtrip = $this->input->post('exampleRadios'); 
            $cookiePrice= array(
				  'name'   => 'cookiehPrice',
				  'value'  => '',
				   'expire' => time()-3600,
				   'domain' => $_SERVER['HTTP_HOST'],
					'path'   => '/',
			  );
			$this->input->set_cookie($cookiePrice);	 
            $return = ($roundtrip == 'return')? date('Y-m-d',strtotime($this->input->post('return'))) : date('Y-m-d',strtotime($this->input->post('depart')));
            $inputArray = array("roundtrip"=>$roundtrip,"from"=>$from,"to"=>$to,"depart"=>$depart,"return"=>$return,"adult"=>$adult,"child"=>$child,"infant"=>$infant);
			$this->session->set_userdata('searchCriteria',$inputArray);            

        }elseif($this->input->post('applyfilter') == 'Apply Filter'){
            $from = $this->input->post('flight_from');
            $to = $this->input->post('flight_to');
            $depart = date('Y-m-d',strtotime($this->input->post('depart')));        
            $adult = $this->input->post('adult');
            $child = $this->input->post('child');
            $infant = $this->input->post('infant');
            $roundtrip = $this->input->post('exampleRadios'); 
             $return = ($roundtrip == 'return')? date('Y-m-d',strtotime($this->input->post('return'))) : date('Y-m-d',strtotime($this->input->post('depart')));
            $inputArray = array("roundtrip"=>$roundtrip,"from"=>$from,"to"=>$to,"depart"=>$depart,"return"=>$return,"adult"=>$adult,"child"=>$child,"infant"=>$infant);
          
            $range_slide_min = $this->input->post('range_slide_min');
            $range_slide_max = $this->input->post('range_slide_max');
            $cookiePrice= array(
				  'name'   => 'cookiehPrice',
				  'value'  => json_encode(array($range_slide_min,$range_slide_max)),
				   'expire' => time()-3600,
				   'domain' => $_SERVER['HTTP_HOST'],
					'path'   => '/',
			  );
			$this->input->set_cookie($cookiePrice);	
			$this->session->set_userdata('searchCriteria',$inputArray); 
		    
        }else{
			$inputArraytemp=$this->session->userdata('searchCriteria');
           if(count($inputArraytemp)>0){
                foreach ($inputArraytemp as $key => $cvalue) {
                    $inputArray[$key] = $cvalue;
                }
            }else{
				
                $inputArray = array("roundtrip"=>"oneway","from"=>"CGK","to"=>"AMS","depart"=>date('Y-m-d'),"return"=>date('Y-m-d'),"adult"=>"1","child"=>"","infant"=>"");    
            }
             $this->session->set_userdata('searchCriteria',$inputArray);           
            
        }
       
         $getcookiePrice = $this->input->cookie('cookiehPrice',true);
            if($getcookiePrice){
				$priceDecodeJson = json_decode($getcookiePrice);
				$range_slide_min = (isset($priceDecodeJson[0]) && $priceDecodeJson[0]!='')?$priceDecodeJson[0]:'';
				$range_slide_max = (isset($priceDecodeJson[1]) && $priceDecodeJson[1]!='')?$priceDecodeJson[1]:'';; 
			}
            
        if(!$pageid){ 
            $result = getDataFromRemot('flight','searchint','','',$inputArray);
            if(isset($result->error_msg) && $result->error_msg!=''){
                $data['errorMsg'] = $result->error_msg;
            }
            if(isset($result->session_id) && $result->session_id!=''){
                $resultArr  =$this->service_m->get_service_result($result);
                $cookieSess= array(
                      'name'   => 'sesstionKey',
                      'value'  => $result->session_id,
                       'expire' => time()+86500,
                       'domain' => $_SERVER['HTTP_HOST'],
                        'path'   => '/',
                  );
                $this->input->set_cookie($cookieSess);
                $serachInfo= array(
                      'name'   => 'serachInfo',
                      'value'  => json_encode($result->search_info),
                       'expire' => time()+86500,
                       'domain' => $_SERVER['HTTP_HOST'],
                        'path'   => '/',
                  );
                $this->input->set_cookie($serachInfo);              

                $setCatcheData = $this->php_fastcache->setData('ix_flightData',$resultArr);    
                if($range_slide_min !='' && $range_slide_max!=''){ 
					$cookiePriceArr = json_encode(array($range_slide_min,$range_slide_max));
					$cookiePrice= array(
						  'name'   => 'cookiehPrice',
						  'value'  => $cookiePriceArr,
						   'expire' => time()+86500,
						   'domain' => $_SERVER['HTTP_HOST'],
							'path'   => '/',
					  );
					$this->input->set_cookie($cookiePrice);					
					$setCatcheData  =$this->service_m->get_flight_sorted_result($setCatcheData,5,$range_slide_min,$range_slide_max);
                }
            }
            

        }else{
            $setCatcheData = $this->php_fastcache->getData('ix_flightData');
            if($this->uri->segment(3)){
                $setCatcheData  =$this->service_m->get_flight_sorted_result($setCatcheData,$this->uri->segment(3));
            }
        }        
        $limit = LISTING_PAGE_LIMIT;
        $curr = array("IDR"=>'Rp',"USD"=>"$","MYR"=>"RM","SGD"=>"S$");
        $flightImages = array("air_asia"=>'Airline1.png',"batik_air"=>"Airline2.png","citilink"=>"Airline3.png","garuda_indonesian"=>"Airline4.png","lion_air"=>"Airline5.png","sriwijaya_air"=>"Airline6.png","wings_air"=>"Airline7.png");
      
        $getcookieSess = $this->input->cookie('sesstionKey',true);
        $getserachInfo = $this->input->cookie('serachInfo',true);
        if(isset($setCatcheData) && count($setCatcheData)>0){
            $setCatcheData = json_decode($setCatcheData);
            $getpaginationInfo = getPaginationResult($setCatcheData->airlineIfo,$limit,$pageid,"flight");
            $data['result']['airlineIfo']=$getpaginationInfo['outArrResult']; 
            $data['no_of_pages']=$getpaginationInfo['no_of_pages']; 
        }        
        $data['session_id'] = (isset($setCatcheData->session_id) && $setCatcheData->session_id!='')?$setCatcheData->session_id:'';
        $data['range_slide_min'] = $range_slide_min;
        $data['range_slide_max'] = $range_slide_max;
        $data['search_info'] = $this->session->userdata('searchCriteria');//json_decode($getserachInfo);//$result->search_info;
        
        $data['curr']=$curr; 
        $data['flightImages']=$flightImages; 
        $data['pageid'] =  (!$pageid)?1:$pageid;
        if(count($_POST)>0){
			redirect('flight/1');exit;
		}
        $js = load_js(array('front/flight-listing.js'));
        $this->template->write('title', 'flight-listing');
        $this->template->write('footerJs',$js);
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'flights-listing', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
     }

     public function flightDetails($sessID,$flightNo,$classID) {
        $inputArray = array("session_id"=>$sessID,"flightno_1"=>urldecode($flightNo),"class_id_1"=>$classID);
        if(count($_GET)>0){
	$i=0;
           foreach ($_GET as $key => $getUrl) {
		if($i<2)
                $inputArray[$key] = urldecode($getUrl);
		$i++;
            }
	
	    /*for($i=0;$i<2;$i++){
		$inputArray[] = urldecode($getUrl);
	    }*/
        }
        $data = array();
       
        $result =getDataFromRemot('flight','searchint_detail','','',$inputArray);
		if(isset($result->error_msg) && $result->error_msg!=''){
				$data['errorMsg'] = $result->error_msg;
		}
        $data['flight_details'] = $result;
        $setCurr = "IDR";
        $curr = array("IDR"=>'Rp',"USD"=>"$","MYR"=>"RM","SGD"=>"S$");
        $flightImages = array("air_asia"=>'Airline1.png',"batik_air"=>"Airline2.png","citilink"=>"Airline3.png","garuda_indonesian"=>"Airline4.png","lion_air"=>"Airline5.png","sriwijaya_air"=>"Airline6.png","wings_air"=>"Airline7.png");
        $data['curr']=$curr[$setCurr]; 
        $data['flightImages']=$flightImages;

        $this->load->library('template');
		$this->template->write('title', 'flight-details');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'flight-details', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
    }


    public function hotel($pageid=false) {
        $this->load->library('template');
        $data = array();
        $hotel_typeArr = $star_ratingArr = $service_includeArr = $priceArr =array();
        $this->load->helper('cookie');
         if($this->input->post('searchotel') == 'Find My Hotel'){ 
            $dist = $this->input->post('destination');
            $checkin = date('Y-m-d',strtotime($this->input->post('checkin')));
            $checkout = date('Y-m-d',strtotime($this->input->post('checkout')));
            $guest =$this->input->post('guest');
            $inputArray = array("city"=>$dist,"ci"=>$checkin,"co"=>$checkout,"room"=>"1","adult"=>$guest,"child"=>"","hotel_name"=>"");
            $inputArrFilter= array(
				  'name'   => 'inputArrFilter',
				  'value'  => '',
				   'expire' => time()-3600,
				   'domain' => $_SERVER['HTTP_HOST'],
					'path'   => '/',
			  );
			$this->input->set_cookie($inputArrFilter); 
        }else{
            $inputArraytemp=$this->session->userdata('searchinfo');            
            if(count($inputArraytemp)>0){
                foreach ($inputArraytemp as $key => $cvalue) {
                    $inputArray[$key] = $cvalue;
                }
            }else{
                $ciDate = date('Y-m-d',strtotime('+ 2 days',strtotime(date('Y-m-d'))));
                $coDate = date('Y-m-d',strtotime('+ 3 days',strtotime(date('Y-m-d'))));
                $inputArray = array("city"=>"London","ci"=>$ciDate,"co"=>$coDate,"room"=>"1","adult"=>"","child"=>"","hotel_name"=>"");
            }            
        }
        $this->session->set_userdata('searchinfo',$inputArray);
        if (!$pageid) {
           $resultarr =getDataFromRemot('hotel','hotel_search','','',$inputArray);
           //echo count($resultarr->result_data);
           if(isset($resultarr->error_msg) && $resultarr->error_msg!=''){
                $data['errorMsg'] = $resultarr->error_msg;
           }
            if(isset($resultarr->session_id) && $resultarr->session_id!=''){
                $cookieSess= array(
                  'name'   => 'hotel_sesstionKey',
                  'value'  => $resultarr->session_id,
                   'expire' => time()+86500,
                   'domain' => $_SERVER['HTTP_HOST'],
                    'path'   => '/',
                );
                $this->input->set_cookie($cookieSess);
                $setCatcheData = $this->php_fastcache->setData('hx_hotelData',$resultarr);
            }
            $cookiePrice= array(
				  'name'   => 'cookiehPrice',
				  'value'  => '',
				   'expire' => time()-3600,
				   'domain' => $_SERVER['HTTP_HOST'],
					'path'   => '/',
			  );
			$this->input->set_cookie($cookiePrice);	
			
						
            
        } else {
			$getcookieInputArr = $this->input->cookie('inputArrFilter',true); 			 
			if($getcookieInputArr){
				$InDecodeJson = json_decode($getcookieInputArr);
				$hotel_typeArr = (isset($InDecodeJson[0]) && $InDecodeJson[0]!='')?$InDecodeJson[0]:array();
				$star_ratingArr = (isset($InDecodeJson[1]) && $InDecodeJson[1]!='')?$InDecodeJson[1]:array();
				$service_includeArr = (isset($InDecodeJson[2]) && $InDecodeJson[2]!='')?$InDecodeJson[2]:array();
				$priceArr = (isset($InDecodeJson[3]) && $InDecodeJson[3]!='')?$InDecodeJson[3]:array();
			} 
            $setCatcheData = $this->php_fastcache->getData('hx_hotelData');
            $priceFilter = $this->input->cookie('cookiehPrice',true);
            if($getcookieInputArr!=''){
				$decodeJson = json_decode($getcookieInputArr);
				if(count($getcookieInputArr)>0){
						$priceArr[0] = $decodeJson[0];
						$priceArr[1] = $decodeJson[1];
						$setCatcheData  =$this->service_m->get_hotel_filter_result($setCatcheData,$hotel_typeArr,$star_ratingArr,$service_includeArr,$priceArr);
				}
			}
            if($this->uri->segment(3)){
                $setCatcheData  =$this->service_m->get_hotel_sorted_result($setCatcheData,$this->uri->segment(3));
            }
            
        }
        
       if($this->input->post('applyfilter') == 'Apply Filter'){
            $hotel_typeArr = $this->input->post('hotel_type');
            $star_ratingArr = $this->input->post('star_rating');
            $service_includeArr = $this->input->post('service_include'); 
            $priceArr = array($this->input->post("range_slide_min"),$this->input->post("range_slide_max"));
            $cookiePrice= array(
				  'name'   => 'cookiehPrice',
				  'value'  => '',
				   'expire' => time()-3600,
				   'domain' => $_SERVER['HTTP_HOST'],
					'path'   => '/',
			  );
			$this->input->set_cookie($cookiePrice);
            if($this->input->post("range_slide_min")!='' && $this->input->post("range_slide_max")!=''){
				$cookiePrice= array(
					  'name'   => 'cookiehPrice',
					  'value'  => json_encode($priceArr),
					   'expire' => time()+86500,
					   'domain' => $_SERVER['HTTP_HOST'],
						'path'   => '/',
				  );
				$this->input->set_cookie($cookiePrice);
			}
			$setCatcheData  = $this->service_m->get_hotel_filter_result($setCatcheData,$hotel_typeArr,$star_ratingArr,$service_includeArr,$priceArr);
			
			$inputArrFilter= array(
					  'name'   => 'inputArrFilter',
					  'value'  => json_encode(array($hotel_typeArr,$star_ratingArr,$service_includeArr,$priceArr)),
					   'expire' => time()+86500,
					   'domain' => $_SERVER['HTTP_HOST'],
						'path'   => '/',
				  );
				$this->input->set_cookie($inputArrFilter);
        }
	
		$getcookieInputArr = $this->input->cookie('inputArrFilter',true); 
		
		if($getcookieInputArr){
			$InDecodeJson = json_decode($getcookieInputArr);
			$hotel_typeArr = (isset($InDecodeJson[0]) && $InDecodeJson[0]!='')?$InDecodeJson[0]:array();
			$star_ratingArr = (isset($InDecodeJson[1]) && $InDecodeJson[1]!='')?$InDecodeJson[1]:array();
			$service_includeArr = (isset($InDecodeJson[2]) && $InDecodeJson[2]!='')?$InDecodeJson[2]:array();
			$priceArr = (isset($InDecodeJson[3]) && $InDecodeJson[3]!='')?$InDecodeJson[3]:array();
		}
			
        if(isset($setCatcheData) && count($setCatcheData)>0)
        $setCatcheData = json_decode($setCatcheData);

        $curr = array("IDR"=>'Rp',"USD"=>"$","MYR"=>"RM","SGD"=>"S$");
        $data['curr']=$curr; 
        if(isset($setCatcheData->result_data) && $setCatcheData->result_data!=''){  
	
            $getpaginationInfo = getPaginationResult($setCatcheData->result_data,HOTEL_LISTING_PAGE_LIMIT,$pageid,"hotel");
            $data['result']=$getpaginationInfo['outArrResult'];
            $data['no_of_pages']=$getpaginationInfo['no_of_pages'];
        }
        $inputArray=$this->session->userdata('searchinfo');       
        $data['session_id'] = (isset($setCatcheData->session_id) && $setCatcheData->session_id!='')?$setCatcheData->session_id:'';//$this->input->cookie('hotel_sesstionKey',true);
        $data['search_info'] = $inputArray;
        $data['pageid'] =  (!$pageid)?1:$pageid;        
        $data['filterInputs']=array($hotel_typeArr,$star_ratingArr,$service_includeArr,$priceArr);
		if(count($_POST)>0){
			redirect('hotel/1');exit;
		}
        $this->template->write('title', 'hotel-listing');
        $css = load_css(array('front/star-rating.css'));
        $this->template->write('headerCss',$css);
         $js = load_js(array('front/star-rating.js','front/hotel-listing.js'));
        $this->template->write('footerJs',$js);
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'hotel-listing', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
     }


     public function hotel_details($sessID,$hotelId) {
        $this->load->model('serviceData','service_m');
        $this->load->library('template'); 
        $data = array();       
        $inputArray = array("session_id"=>$sessID,"hotelId"=>urldecode($hotelId)); 
        $result =getDataFromRemot('hotel','hotel_detail','','',$inputArray);        
        if(isset($result->error_msg) && $result->error_msg!=''){
			$data['errorMsg'] = $result->error_msg;
	   }
        $data['hotel_details'] = $result;
        $curr = array("IDR"=>'Rp',"USD"=>"$","MYR"=>"RM","SGD"=>"S$"); 
        $data['curr']=$curr;    
		$css = load_css(array('front/star-rating.css'));
        $this->template->write('headerCss',$css);
		$js = load_js(array('front/star-rating.js'));
        $this->template->write('footerJs',$js);   
        $this->template->write('title', 'hotel-details');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'hotel-details', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
     }
     
     
      public function train($pageid=false) {
       // $this->load->model('serviceData','service_m');
        $this->load->library('template');
        $this->load->helper('cookie');
        $data = $sessInputArr = array();  
        if($this->input->post('searchtrain') == 'Search Train'){
        	$roundtrip = $this->input->post('train_roundtrip');
        	$depart = date('Y-m-d',strtotime($this->input->post('train_depart')));
        	$return = ($roundtrip == 'oneway')?$depart:date('Y-m-d',strtotime($this->input->post('train_return')));
        	$from = $this->input->post('train_from');
        	$to = $this->input->post('train_to');
        	$adult = $this->input->post('train_adult');
        	$child = $this->input->post('train_child');
        	$inputArray = array("roundtrip"=>$roundtrip,"from"=>$from,'to'=>$to,'depart'=>$depart,'return'=>$return,'adult'=>$adult,'child'=>$child);         	
        }else if($this->input->post('applayfilter') == 'Apply Filter'){
        	$roundtrip = $this->input->post('train_roundtrip');
        	$depart = date('Y-m-d',strtotime($this->input->post('train_depart')));
        	$return = ($roundtrip == 'oneway')?$depart:date('y-m-d',strtotime($this->input->post('train_return')));
        	$from = $this->input->post('train_from');
        	$to = $this->input->post('train_to');
        	$adult = $this->input->post('train_adult');
        	$child = $this->input->post('train_child');
        	$inputArray = array("roundtrip"=>$roundtrip,"from"=>$from,'to'=>$to,'depart'=>$depart,'return'=>$return,'adult'=>$adult,'child'=>$child);         	
        }else{
        	$sessInputArr = $this->session->userdata('searchtrain');
        	if(count($sessInputArr)>0){
        		foreach ($sessInputArr as $key => $value) {
	        		$inputArray[$key] = $value;
	        	}	
        	}else{
        		$inputArray = array("roundtrip"=>'return',"from"=>'GMR','to'=>'BD','depart'=>'2017-01-17','return'=>'2017-01-30','adult'=>'1'); 	
        	}        	
        	
        }
        //print_r($inputArray);die;
        $this->session->set_userdata('searchtrain',$inputArray);
        $sessInputArr = $this->session->userdata('searchtrain');
        $data['searchinfo'] = getDataFromRemot('train','train_search','','',$inputArray);
       
        $getCurrency = 'IDR';
        $curr = array("IDR"=>'Rp',"USD"=>"$","MYR"=>"RM","SGD"=>"S$"); 
        $data['curr']=$curr[$getCurrency];
        $data['session_id']=$data['searchinfo']->session_id;   
        $data['search_info'] = $sessInputArr;
        $data['range_slide'] = array();
        $js = load_js(array('front/train-listing.js'));
        $this->template->write('footerJs',$js);        
        $this->template->write('title', 'Train List');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'train-listing', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
     }
     public function train_details($sessID,$train_no) {
        $this->load->library('template');
        $this->load->helper('cookie');
        //$this->load->model('serviceData','service_m'); 
        $inputArray = array("session_id"=>$sessID,"train_no_1"=>urldecode($train_no),"train_no_2"=>urldecode($train_no));
       if(count($_GET)>0){
        	foreach ($_GET as $key => $invalue) {
        		# code...
        		 $inputArray[$key] = urldecode($invalue);
        	}
        }
        $data = array();      
         
        $result =getDataFromRemot('train','train_detail','','',$inputArray);    
        if(isset($result->error_msg) && $result->error_msg!=''){
            $data['errorMsg'] = $result->error_msg;
       }
        $data['train_details'] = $result;       
        $curr = array("IDR"=>'Rp',"USD"=>"$","MYR"=>"RM","SGD"=>"S$"); 
        $data['curr']=$curr;    
        $this->template->write('title','Train Detail');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'train-details', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
     }

     public function get_depature_airports(){
     	$setCatcheData = $this->php_fastcache->getData('depature_flight');
     	if($setCatcheData!=''){
     		$returnData = json_decode($setCatcheData);     		
     	}else{
     		$inputArray['airline'] = 1;
	     	$result =getDataFromRemot('info','get_departure_airport','','',$inputArray);
	     	$finalResc= array();
	     	if(count($result->departure_airport)>0){
	     		foreach ($result->departure_airport as $key => $value) {
	     			# code...
	     			$finalResc[] = $value->airport_city.'-'.$value->airport_code;
	     		}
	     		$setCatcheData = $this->php_fastcache->setData('depature_flight',$finalResc);
	     		$returnData = json_decode($setCatcheData);
	     	}
	    }  
	    //print_r($finalResc);   	
     	echo json_encode($returnData);exit;
    }
    public function get_hotel_city(){
     	$hotel_cities = $this->php_fastcache->getData('hotel_cities');
     	if($hotel_cities!=''){
     		$returnData = json_decode($hotel_cities);     		
     	}else{
     		
	     	$result =getDataFromRemot('info','get_departure_airport','','',$inputArray);
	     	$finalResc= array();
	     	if(count($result->departure_airport)>0){
	     		foreach ($result->departure_airport as $key => $value) {
	     			# code...
	     			$finalResc[] = $value->airport_city.'-'.$value->airport_code;
	     		}
	     		$setCatcheData = $this->php_fastcache->setData('depature_flight',$finalResc);
	     		$returnData = json_decode($setCatcheData);
	     	}
	    }  
	    //print_r($finalResc);   	
     	echo json_encode($returnData);exit;
    }

   
}

