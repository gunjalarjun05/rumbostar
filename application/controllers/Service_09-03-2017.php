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
            
            $from = $from_i = $this->input->post('flight_from');
        	$fromArrcoma = explode(',', $from);
        	if(count($fromArrcoma)>0){
        		$fromArrdash = explode('-', $fromArrcoma[0]);
        		if(count($fromArrdash)>0){
        			$from = trim($fromArrdash[1]);	
        		}
        	}
        	$to = $to_i = $this->input->post('flight_to');
        	$toArrcoma = explode(',', $to);
        	if(count($toArrcoma)>0){
        		$toArrdash = explode('-', $toArrcoma[0]);
        		if(count($toArrdash)>0){
        			$to = trim($toArrdash[1]);	
        		}
        	} 

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
            $inputArray = array("roundtrip"=>$roundtrip,"from"=>$from,"to"=>$to,"depart"=>$depart,"return"=>$return,"adult"=>$adult,"child"=>$child,"infant"=>$infant,"from_i"=>$from_i,"to_i"=>$to_i);
			$this->session->set_userdata('searchCriteria',$inputArray);            

        }elseif($this->input->post('applyfilter') == 'Apply Filter'){
           // $from = $this->input->post('flight_from');
           // $to = $this->input->post('flight_to');
        	$from = $from_i = $this->input->post('flight_from');
        	$fromArrcoma = explode(',', $from);
        	if(count($fromArrcoma)>0){
        		$fromArrdash = explode('-', $fromArrcoma[0]);
        		if(count($fromArrdash)>0){
        			$from = trim($fromArrdash[1]);	
        		}
        	}
        	$to = $to_i = $this->input->post('flight_to');
        	$toArrcoma = explode(',', $to);
        	if(count($toArrcoma)>0){
        		$toArrdash = explode('-', $toArrcoma[0]);
        		if(count($toArrdash)>0){
        			$to = trim($toArrdash[1]);	
        		}
        	} 

            $depart = date('Y-m-d',strtotime($this->input->post('depart')));        
            $adult = $this->input->post('adult');
            $child = $this->input->post('child');
            $infant = $this->input->post('infant');
            $roundtrip = $this->input->post('exampleRadios'); 
             $return = ($roundtrip == 'return')? date('Y-m-d',strtotime($this->input->post('return'))) : date('Y-m-d',strtotime($this->input->post('depart')));
            $inputArray = array("roundtrip"=>$roundtrip,"from"=>$from,"to"=>$to,"depart"=>$depart,"return"=>$return,"adult"=>$adult,"child"=>$child,"infant"=>$infant,"from_i"=>$from_i,"to_i"=>$to_i);
          
            $range_slide_min = $this->input->post('range_slide_min');
            $range_slide_max = $this->input->post('range_slide_max');
          /*  $cookiePrice= array(
				  'name'   => 'cookiehPrice',
				  'value'  => '',
				   'expire' => -1,
				   'domain' => $_SERVER['HTTP_HOST'],
					//'path'   => '/',
			  );
			$this->input->set_cookie($cookiePrice);*/
			$this->session->set_userdata('cookiehPrice','');

			//delete_cookie($cookiePrice); //print_r($cookiePrice);//die;
			//delete_cookie($cookiehPrice);
			$this->session->set_userdata('searchCriteria',$inputArray); 
		    
        }else{
			$inputArraytemp=$this->session->userdata('searchCriteria');
			//print_r($inputArraytemp);die;
           if(count($inputArraytemp)>0){
                foreach ($inputArraytemp as $key => $cvalue) {
                    $inputArray[$key] = $cvalue;
                }
            }else{
				
                $inputArray = array("roundtrip"=>"oneway","from"=>"CGK","to"=>"AMS","depart"=>date('Y-m-d'),"return"=>date('Y-m-d'),"adult"=>"1","child"=>"","infant"=>"","from_i"=>'Jakarta-CGK',"to_i"=>'Amsterdam-AMS');    
            }
             $this->session->set_userdata('searchCriteria',$inputArray);           
            
        }
       
        /* $getcookiePrice = $this->input->cookie('cookiehPrice',true);*/
         $getcookiePrice = $this->session->userdata('cookiehPrice');
       // print_r($getcookiePrice);die;
            if($getcookiePrice){
				$priceDecodeJson = json_decode($getcookiePrice);
				$range_slide_min = (isset($priceDecodeJson[0]) && $priceDecodeJson[0]!='')?$priceDecodeJson[0]:'';
				$range_slide_max = (isset($priceDecodeJson[1]) && $priceDecodeJson[1]!='')?$priceDecodeJson[1]:'';; 
			}
           //echo $range_slide_min;die; 
        if(!$pageid){ 
            $result = getDataFromRemot('flight','searchint','','',$inputArray);
           // echo "<pre>";
           // print_r($result);die;
            if(isset($result->error_msg) && $result->error_msg!=''){
                
                $this->session->set_userdata('errormsg',$result->error_msg);
                $data['errorMsg'] = $result->error_msg;
            }

             $resultArr  = $result ;
             $setCatcheData = $this->php_fastcache->setData('ix_flightData',$resultArr);
            if(isset($result->session_id) && $result->session_id!=''){

             	$this->session->set_userdata('errormsg','');  
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

                 
                if($range_slide_min !='' && $range_slide_max!=''){ 
					$cookiePriceArr = json_encode(array($range_slide_min,$range_slide_max));
					/*$cookiePrice= array(
						  'name'   => 'cookiehPrice',
						  'value'  => $cookiePriceArr,
						   'expire' => time()+86500,
						   'domain' => $_SERVER['HTTP_HOST'],
							//'path'   => '/',
					  );*/
					$this->session->set_userdata('cookiehPrice',$cookiePriceArr);					
					$setCatcheData  =$this->service_m->get_flight_sorted_result($setCatcheData,5,$range_slide_min,$range_slide_max);
					//print_r($setCatcheData);die;
                }
            }
            

        }else{
        	$data['errorMsg'] = $this->session->userdata('errormsg');
            $setCatcheData = $this->php_fastcache->getData('ix_flightData');
            if($this->uri->segment(3)){
                $setCatcheData  =$this->service_m->get_flight_sorted_result($setCatcheData,$this->uri->segment(3));
            }
            if($range_slide_min !='' && $range_slide_max!=''){ 
				$cookiePriceArr = json_encode(array($range_slide_min,$range_slide_max));
				$setCatcheData  =$this->service_m->get_flight_sorted_result($setCatcheData,5,$range_slide_min,$range_slide_max);				
            }
        }        
       $limit = LISTING_PAGE_LIMIT;
        $curr = array("IDR"=>'Rp',"USD"=>"$","MYR"=>"RM","SGD"=>"S$");
        $flightImages = array("air_asia"=>'Airline1.png',"batik_air"=>"Airline2.png","citilink"=>"Airline3.png","garuda_indonesian"=>"Airline4.png","lion_air"=>"Airline5.png","sriwijaya_air"=>"Airline6.png","wings_air"=>"Airline7.png");
      
        $getcookieSess = $this->input->cookie('sesstionKey',true);
        $getserachInfo = $this->input->cookie('serachInfo',true);
     /*if(isset($setCatcheData) && count($setCatcheData)>0){
            $setCatcheData = json_decode($setCatcheData);
            $getpaginationInfo = getPaginationResult($setCatcheData->airlineIfo,$limit,$pageid,"flight");
            $data['result']['airlineIfo']=$getpaginationInfo['outArrResult']; 
            $data['no_of_pages']=$getpaginationInfo['no_of_pages']; 
        } */   
         
        //$data['result']['airlineIfo']=$setCatcheData->airlineIfo; 
        $setCatcheData = (isset($setCatcheData) && count($setCatcheData)>0)?json_decode($setCatcheData):array();  
        $data['session_id'] = (isset($setCatcheData->session_id) && $setCatcheData->session_id!='')?$setCatcheData->session_id:'';
        $data['range_slide_min'] = $range_slide_min;
        $data['range_slide_max'] = $range_slide_max;
        $data['search_info'] = $this->session->userdata('searchCriteria');//json_decode($getserachInfo);//$result->search_info;
        $data['airlineIfo']=$setCatcheData;
       // print_r($data['airlineIfo']);die;       
        $data['curr']=$curr; 
        $data['flightImages']=$flightImages; 
        $data['pageid'] =  (!$pageid)?1:$pageid;
        if(count($_POST)>0){
			redirect('flight/1');exit;
		}
        $js = load_js(array('front/jquery.auto-complete.js','front/flight-listing.js'));
        $this->template->write('title', 'flight-listing');
        $this->template->write('footerJs',$js);
         $css = load_css(array('front/jquery.auto-complete.css'));
        $this->template->write('headerCss',$css); 

        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'flights-listing', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
     }

     public function flightDetails($sessID,$flightNo,$classID) {
		 
        $inputArray = array("session_id"=>$sessID,"flightno_1"=>urldecode($flightNo),"class_id_1"=>$classID);
        if(count($_GET)>0){
            foreach ($_GET as $key => $getUrl) {
                $inputArray[$key] = urldecode($getUrl);
            }
        }
        $data = array();
        $result =getDataFromRemot('flight','Searchint_detail','','',$inputArray);
        $this->session->set_userdata('sess_bk_info_flight',$result);
		if(isset($result->error_msg) && $result->error_msg!=''){
				$data['errorMsg'] = $result->error_msg;
		}
        $data['flight_details'] = $result;
        $data['inputArray'] = $inputArray;
        $setCurr = "IDR";
        $curr = array("IDR"=>'Rp',"USD"=>"$","MYR"=>"RM","SGD"=>"S$");
        $flightImages = array("air_asia"=>'Airline1.png',"batik_air"=>"Airline2.png","citilink"=>"Airline3.png","garuda_indonesian"=>"Airline4.png","lion_air"=>"Airline5.png","sriwijaya_air"=>"Airline6.png","wings_air"=>"Airline7.png");
        $data['curr']=$curr[$setCurr]; 
        $data['flightImages']=$flightImages;

        $this->load->library('template');
        $js = load_js(array('front/add-booking.js'));
        $this->template->write('footerJs',$js);
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
         if($this->input->post('searchotel') == 'FIND MY HOTEL' || $this->input->post('applyfilter') == 'Apply Filter'){ 

            $dist = $this->input->post('destination');
            $checkin = date('Y-m-d',strtotime($this->input->post('checkin')));
            $checkout = date('Y-m-d',strtotime($this->input->post('checkout')));
            $guest =$this->input->post('guest');
            $numberofrooms =$this->input->post('number_of_rooms');
            $inputArray = array("city"=>$dist,"ci"=>$checkin,"co"=>$checkout,"room"=>$numberofrooms,"adult"=>$guest,"child"=>"","hotel_name"=>"");
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
           
           if(isset($resultarr->error_msg) && $resultarr->error_msg!=''){
                $data['errorMsg'] = $resultarr->error_msg;
           }
            $setCatcheData = $this->php_fastcache->setData('hx_hotelData',$resultarr);
            if(isset($resultarr->session_id) && $resultarr->session_id!=''){
                $cookieSess= array(
                  'name'   => 'hotel_sesstionKey',
                  'value'  => $resultarr->session_id,
                   'expire' => time()+86500,
                   'domain' => $_SERVER['HTTP_HOST'],
                    'path'   => '/',
                );
                $this->input->set_cookie($cookieSess);
               
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
            $setCatcheData = $this->php_fastcache->getData('hx_hotelData');

            $priceFilter = $this->input->cookie('cookiehPrice',true);
            if($priceFilter!=''){
				$decodeJson = json_decode($priceFilter);
				if(count($decodeJson)>0){
						$priceArr[0] = $decodeJson[0];
						$priceArr[1] = $decodeJson[1];
						$errormsg = json_decode($setCatcheData);
						if(isset($errormsg->error_msg) && $errormsg->error_msg !='')
						$setCatcheData  =$this->service_m->get_hotel_filter_result($setCatcheData,$hotel_typeArr,$star_ratingArr,$service_includeArr,$priceArr);
				}
			}
            if($this->uri->segment(3)){
				$errormsg = json_decode($setCatcheData);
				if(isset($errormsg->error_msg) && $errormsg->error_msg !='')
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
			$errormsg = json_decode($setCatcheData);
			if(isset($errormsg->error_msg) && $errormsg->error_msg !='')
			$setCatcheData  = $this->service_m->get_hotel_filter_result($setCatcheData,$hotel_typeArr,$star_ratingArr,$service_includeArr,$priceArr);
            
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
        $data['errorMsg'] = (isset($setCatcheData->error_msg)&& $setCatcheData->error_msg !='')?$setCatcheData->error_msg:'';
        $data['search_info'] = $inputArray;
        $data['pageid'] =  (!$pageid)?1:$pageid;        
        $data['filterInputs'] = array($hotel_typeArr,$star_ratingArr,$service_includeArr,$priceArr);
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
        $this->session->set_userdata('sess_bk_info',$result);
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
        	$from = $from_i = $this->input->post('train_from');
        	$fromArrcoma = explode(',', $from);
        	if(count($fromArrcoma)>0){
        		$fromArrdash = explode('-', $fromArrcoma[0]);
        		if(count($fromArrdash)>0){
        			$from = trim($fromArrdash[1]);	
        		}
        	}
        	$to = $to_i = $this->input->post('train_to');
        	$toArrcoma = explode(',', $to);
        	if(count($toArrcoma)>0){
        		$toArrdash = explode('-', $toArrcoma[0]);
        		if(count($toArrdash)>0){
        			$to = trim($toArrdash[1]);	
        		}
        	}        	
        	$adult = $this->input->post('train_adult');
        	$child = $this->input->post('train_child');
        	$infant = $this->input->post('train_infant');
        	$inputArray = array("roundtrip"=>$roundtrip,"from"=>$from,'to'=>$to,'depart'=>$depart,'return'=>$return,'adult'=>$adult,'child'=>$child,"infant"=>$infant,"to_i"=>$to_i,"from_i"=>$from_i);         	
        }else if($this->input->post('applayfilter') == 'Apply Filter'){
        	$roundtrip = $this->input->post('train_roundtrip');
        	$depart = date('Y-m-d',strtotime($this->input->post('train_depart')));
        	$return = ($roundtrip == 'oneway')?$depart:date('y-m-d',strtotime($this->input->post('train_return')));
        	 $from = $from_i = $this->input->post('train_from');
        	$fromArrcoma = explode(',', $from);
           
        	if(count($fromArrcoma)>0){
        		$fromArrdash = explode('-', $fromArrcoma[0]);
        		if(count($fromArrdash)>0){
        		  $from = (isset($fromArrdash[1]) && $fromArrdash[1]!='')?trim($fromArrdash[1]):$from;
        		}
        	}
        	$to = $to_i = $this->input->post('train_to');
        	$toArrcoma = explode(',', $to);
        	if(count($toArrcoma)>0){
        		$toArrdash = explode('-', $toArrcoma[0]);
        		if(count($toArrdash)>0){
        			$to = (isset($toArrdash[1]) && $toArrdash[1]!='')?trim($toArrdash[1]):$to;	
        		}
        	} 
        	$adult = $this->input->post('train_adult');
        	$child = $this->input->post('train_child');
        	$infant = $this->input->post('train_infant');
        	$inputArray = array("roundtrip"=>$roundtrip,"from"=>$from,'to'=>$to,'depart'=>$depart,'return'=>$return,'adult'=>$adult,'child'=>$child,"infant"=>$infant,"to_i"=>$to_i,"from_i"=>$from_i);         	
        }else{
        	$sessInputArr = $this->session->userdata('searchtrain');
        	if(count($sessInputArr)>0){
        		foreach ($sessInputArr as $key => $value) {
	        		$inputArray[$key] = $value;
	        	}	
        	}else{
        		$inputArray = array("roundtrip"=>'return',"from"=>'GMR','to'=>'BD','depart'=>'2017-01-17','return'=>'2017-01-30','adult'=>'1',"infant"=>0,"to_i"=>'',"from_i"=>''); 	
        	}        	
        	
        }
        //print_r($inputArray);die;
        $this->session->set_userdata('searchtrain',$inputArray);
        $sessInputArr = $this->session->userdata('searchtrain');
        $data['searchinfo'] = getDataFromRemot('train','train_search','','',$inputArray);
      	//print_r($data['searchinfo']);die;
      	$from = $this->input->post('train_from');
        $getCurrency = 'IDR';
        $curr = array("IDR"=>'Rp',"USD"=>"$","MYR"=>"RM","SGD"=>"S$"); 
        $data['curr']=$curr[$getCurrency];
        $data['session_id']=(isset($data['searchinfo']->session_id) && $data['searchinfo']->session_id!='')?$data['searchinfo']->session_id:'';   
        $data['search_info'] = $sessInputArr;
        $data['range_slide'] = array();
        $js = load_js(array('front/jquery.auto-complete.js','front/train-listing.js',));
        $this->template->write('footerJs',$js);      
         $css = load_css(array('front/jquery.auto-complete.css'));
        $this->template->write('headerCss',$css); 

        $this->template->write('title', 'Train List');

        $this->template->write_view('header', 'includes/header', '', TRUE);
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
     	 if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$keyWord = $this->input->get('q');
		$resc = $this->master_db->search_suggestion($keyWord);
		sort($resc);
		echo json_encode($resc);	 	
     	//echo json_encode($returnData);exit;
    }
    public function return_flight(){
            $data = array();
           $this->load->library('template'); 
            $this->template->write('title', 'Return Flight');
            $this->template->write_view('header', 'includes/header', $data, TRUE);
            $this->template->write_view('content', 'flights-listing-return', $data, TRUE);
            $this->template->write_view('footer', 'includes/footer', '', TRUE);
            $this->template->render();
        
    }


    public function book_flight(){
            $data = array();
            $this->load->library('template'); 
            $this->template->write('title', 'Return Flight');
            $this->template->write_view('header', 'includes/header', $data, TRUE);
            //$this->template->write_view('content', 'flight-book-success', $data, TRUE);
            //$this->template->write_view('content', 'hotel-book-success', $data, TRUE);
            //$this->template->write_view('content', 'flight-book-fail', $data, TRUE);
            //$this->template->write_view('content', 'hotel-book-fail', $data, TRUE);
            //$this->template->write_view('content', 'fbshare',TRUE);
            $this->template->write_view('content', 'googleshare.php',TRUE);
            
            $this->template->write_view('footer', 'includes/footer', '', TRUE);
            $this->template->render();
        
    }

    public function return_train(){
            $data = array();
           $this->load->library('template'); 
            $this->template->write('title', 'Return Train');
            $this->template->write_view('header', 'includes/header', $data, TRUE);
            $this->template->write_view('content', 'train-listing-return ', $data, TRUE);
            $this->template->write_view('footer', 'includes/footer', '', TRUE);
            $this->template->render();
        
    }    

    public function book_train(){
            $data = array();
           $this->load->library('template'); 
            $this->template->write('title', 'Book Train');
            $this->template->write_view('header', 'includes/header', $data, TRUE);
            $this->template->write_view('content', 'book-train', $data, TRUE);
            $this->template->write_view('footer', 'includes/footer', '', TRUE);
            $this->template->render();
        
    } 


    public function get_station(){
     	$setCatcheData = $this->php_fastcache->getData('get_station');
     	if($setCatcheData!=''){
     		$returnData = json_decode($setCatcheData);     		
     	}else{
     		$inputArray = array();
	     	$result =getDataFromRemot('train','get_station','','',$inputArray);
	     	//print_r($result);die;
	     	$finalResc= array();
	     	if(count($result->station_data)>0){
	     		foreach ($result->station_data as $key => $value) {
	     			for ($i=0; $i<count($value->station_list) ; $i++) { 
	     				$finalResc[] = $value->station_list[$i]->station_name.'-'.$value->station_list[$i]->station_code.",".$value->city;
	     			}
	     			
	     		}
	     		//echo "<pre>";
	     		//print_r($finalResc);die;
	     		$setCatcheData = $this->php_fastcache->setData('get_station',$finalResc);
	     		$returnData = json_decode($setCatcheData);
	     	}
	    }  
	    //print_r($finalResc);   	
     	echo json_encode($returnData);exit;
    }

  
}

