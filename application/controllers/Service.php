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

    public function switchLang($language = "") {   
        $this->lang->load('message','english');  
        $language = ($language != "") ? $language : "english";         
        $this->session->set_userdata('site_lang', $language);     
        //echo $_SERVER['HTTP_REFERER'];exit;      
        redirect($_SERVER['HTTP_REFERER']);
        
    }
        
    public function flight($pageid=false) {        
        $this->load->library('template');     
        $this->load->helper('general');
        
        $flight_type = $this->input->post('flightRadios');
        $airline = $this->input->post('flight_domestic_airline');
        $airlineid = getAirlineidByName($airline); 
          //echo '<pre>';   
       // print_r($this->input->post());
       // exit;
        $setCatcheData = array();
        $range_slide_min = $range_slide_max = $errorMsg = ''; 
       // echo '<pre>';   
        //print_r($this->input->post());     
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
            $flightRadios = $this->input->post('flightRadios');
            $flightType = $this->input->post('exampleFlightType'); //sk add line
            
            $cookiePrice= array(
            'name'   => 'cookiehPrice',
            'value'  => '',
            'expire' => time()-3600,
            'domain' => $_SERVER['HTTP_HOST'],
            'path'   => '/',
          );
            $this->input->set_cookie($cookiePrice);  
            $return = ($roundtrip == 'return')? date('Y-m-d',strtotime($this->input->post('return'))) : date('Y-m-d',strtotime($this->input->post('depart')));
            $inputArray = array("roundtrip"=>$roundtrip,"type"=>$flightType,"from"=>$from,"to"=>$to,"depart"=>$depart,"return"=>$return,"adult"=>$adult,"child"=>$child,"infant"=>$infant,"from_i"=>$from_i,"to_i"=>$to_i,"airline"=>$airlineid,"flightRadios"=>$flight_type,"flight_domestic_airline"=>$airline);
              //  $inputArray = array("roundtrip"=>$roundtrip,"from"=>$from,"to"=>$to,"depart"=>$depart,"return"=>$return,"adult"=>$adult,"child"=>$child,"infant"=>$infant,"airline"=>1,"flightRadios"=>$flightRadios);               
            $this->session->set_userdata('searchCriteria',$inputArray);            

        }elseif($this->input->post('applyfilter') == 'Apply Filter'){
           // $from = $this->input->post('flight_from');
           // $to = $this->input->post('flight_to');
          // echo '<pre>';
      // print_r($this->input->post());exit; 
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
            //echo 'ghg';
             //print_r($toArrdash);exit;
            if(count($toArrdash)>0){
              if(isset($toArrdash[1])){
                $to = trim($toArrdash[1]);  
              }
            }
          } 

            $depart = date('Y-m-d',strtotime($this->input->post('depart')));     
            $adult = $this->input->post('adult');
            $child = $this->input->post('child');
            $infant = $this->input->post('infant');
            $roundtrip = $this->input->post('exampleRadios'); 
            $flightRadios = $this->input->post('flightRadios');
            $flightType = $this->input->post('exampleFlightType'); //sk add line 
             $return = ($roundtrip == 'return')? date('Y-m-d',strtotime($this->input->post('return'))) : date('Y-m-d',strtotime($this->input->post('depart')));
            $inputArray = array("roundtrip"=>$roundtrip,"type"=>$flightType,"from"=>$from,"to"=>$to,"depart"=>$depart,"return"=>$return,"adult"=>$adult,"child"=>$child,"infant"=>$infant,"from_i"=>$from_i,"to_i"=>$to_i,"airline"=>$airlineid,"flightRadios"=>$flight_type,"flight_domestic_airline"=>$airline);
            //$inputArray = array("roundtrip"=>$roundtrip,"from"=>$from,"to"=>$to,"depart"=>$depart,"return"=>$return,"adult"=>$adult,"child"=>$child,"infant"=>$infant,"airline"=>"1","flightRadios"=>$flightRadios);
          //print_r($inputArray);exit;
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
         
          if($pageid == 'top'){
            //sk - when user click on top up flight button show this defult values
            $inputArray = array("roundtrip"=>"oneway","type"=>"connecting","from"=>"SIN","to"=>"AMS","depart"=>date('Y-m-d'),"return"=>date('Y-m-d'),"adult"=>"1","child"=>"","infant"=>"","from_i"=>'Singapore-SIN',"to_i"=>'Amsterdam-AMS',"flightRadios"=>'',"flight_domestic_airline"=>$airline); 

          }else{
        //echo 'hii';
        //  print_r($pageid);exit;
               $inputArraytemp=$this->session->userdata('searchCriteria');
           // print_r($inputArraytemp);die;
             if(count($inputArraytemp)>0){
                  foreach ($inputArraytemp as $key => $cvalue) {
                      $inputArray[$key] = $cvalue;
                  }                    
              }else{  
              //echo 'welocme';
              //print_r($inputArraytemp);
              //sk comment code for static values set in session click on header flight filter section set static pass values  and remove flightRadios values as per client req. 11-12-2017 and 4-1-2018

              $inputArray = array("roundtrip"=>"oneway","type"=>"connecting","from"=>"SIN","to"=>"AMS","depart"=>date('Y-m-d'),"return"=>date('Y-m-d'),"adult"=>"1","child"=>"","infant"=>"","from_i"=>'Singapore-SIN',"to_i"=>'Amsterdam-AMS',"flightRadios"=>'',"flight_domestic_airline"=>$airline);  
                      
              }
          }   
         
            // print_r($inputArray);exit;
             $this->session->set_userdata('searchCriteria',$inputArray);      
        }

       /* sk add if condition for top flight click show defult 1 flight values qa issue 12-12-2017 and Else condition use for user click on top up flight and not select any flightRadios show all flights */
       //echo '<pre>';
       //print_r($inputArray);
        if($inputArray['flightRadios'] == 'international') { 
            $result = getDataFromRemot('flight','searchint','','',$inputArray);
        }else{

          if($inputArray['flightRadios'] == 'domestic'){
            //echo '<pre>';
             $result = getDataFromRemot('flight','search','','',$inputArray);
            //  print_r($result);exit;
          }
           
        } 
         /* sk add if condition for top flight click show defult 1 flight values qa issue 12-12-2017*/
 //echo "<pre>";
    //print_r($result);
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
      if($flight_type == 'domestic'){

                $result = getDataFromRemot('flight','search','','',$inputArray);
      }else if($flight_type == 'international') { 
        $result = getDataFromRemot('flight','searchint','','',$inputArray);
      }else{
                $result = getDataFromRemot('flight','searchint','','',$inputArray);
            } 
            //echo "<pre>";
           //echo "ssssss"; print_r($result);die;
            if(isset($result->error_msg) && $result->error_msg!=''){
                $this->session->set_userdata('errormsg',$result->error_msg);
                $data['errorMsg'] = $result->error_msg;
            }
             $resultArr  = @$result ;
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
          //echo 'sdfsd';
            //print_r($result);exit; 
            if($pageid == 'top'){

              if(isset($result->error_msg) && $result->error_msg!=''){
                $this->session->set_userdata('errormsg',$result->error_msg);
                $data['errorMsg'] = $result->error_msg;
              }

              $resultArr  = @$result ;
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

            }

          $data['errorMsg'] = $this->session->userdata('errormsg');
         
          $setCatcheData = $this->php_fastcache->getData('ix_flightData');
      
          $catcheDataarr = json_decode($setCatcheData);
              
          if(isset($catcheDataarr->error_msg) && $catcheDataarr->error_msg != ''){
            $data['errorMsg'] = $catcheDataarr->error_msg;
          }else{
           // print_r($setCatcheData);
            if($this->uri->segment(3)){
                $setCatcheData  =$this->service_m->get_flight_sorted_result($setCatcheData,$this->uri->segment(3));

               // exit;
            }
          if($range_slide_min !='' && $range_slide_max!=''){ 
             $cookiePriceArr = json_encode(array($range_slide_min,$range_slide_max));
              $setCatcheData  =$this->service_m->get_flight_sorted_result($setCatcheData,5,$range_slide_min,$range_slide_max);        
            }
          }
         

        } 
        //echo '<pre>';
        //print_r($this->session->userdata);exit;       
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
        // print_r($setCatcheData);exit;
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
        //echo '<pre>';
        // print_r($data);exit;
        $js = load_js(array('front/jquery.auto-complete.js','front/flight-listing.js'));
        $this->template->write('title', 'flight-listing');
        $this->template->write('footerJs',$js);
         $css = load_css(array('front/jquery.auto-complete.css'));
        $this->template->write('headerCss',$css); 
    $this->template->write_view('header', 'includes/header', $data, TRUE);
    
    //$this->template->write_view('content', 'flights-listing', $data, TRUE);
    $inputArraytemp1=$this->session->userdata('searchCriteria');

          
    if($inputArraytemp1['flightRadios'] == 'domestic'){  
      $this->template->write_view('content', 'flights-listing-domestic', $data, TRUE);
    } else if($inputArraytemp1['flightRadios'] == 'international'){ 
      $this->template->write_view('content', 'flights-listing', $data, TRUE);
    } else {
      $this->template->write_view('content', 'flights-listing', $data, TRUE);
    }   
        
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
     }

     public function flightDetails($sessID,$flightNo,$classID) {
		$this->load->model('serviceData','service_m');
        $inputArray = array("session_id"=>$sessID,"flightno_1"=>urldecode($flightNo),"class_id_1"=>$classID);
        
        if(count($_GET)>0){
            foreach ($_GET as $key => $getUrl) {
                $inputArray[$key] = urldecode($getUrl);
            }
        }
       // echo '<pre>';
      
        $data = array();
        if($this->session->userdata('searchCriteria')['flightRadios'] == 'domestic'){
            $inputarr['flightRadios'] = 'domestic';
            $result = getDataFromRemot('flight','search_detail','','',$inputArray,$inputarr);
            //echo 'issue';
           // print_r($result);exit;
        }else{
          $result = getDataFromRemot('flight','Searchint_detail','','',$inputArray); 
        }
       
        //echo "<pre>";print_r($result); echo "</pre>";die;
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

        /*Smita : getAllcountries function use for get all country for country  dropdown box flight details page 14-12-2017*/
        $countriesData  = $this->service_m->getAllcountries();        
        $data['countries_data']  = $countriesData;
       //echo '<pre>';
       //print_r($data);exit;
        $this->load->library('template');
        $js = load_js(array('front/add-booking.js'));
        $this->template->write('footerJs',$js);
		    $this->template->write('title', 'flight-details');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'flight-details', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();
    }

   /* @author :Smita
    * @function use : check_flight_coupon function use for check flight assgin coupon or not
    * @date : 5-2-2018 
    */
    public function check_flight_coupon(){
     
      if($_POST['flighno'] != ''){
        $result = $this->service_m->checkFlightCoupon($_POST['flighno']);        
       echo  json_encode($result);
        exit;
      }
    }

    public function hotel($pageid=false,$filterId=false) {
       // echo '<pre>';
        //print_r($pageid);
        //print_r($filterId);

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
            //$rangeslidemin =  $this->input->post('range_slide_min');
            //$rangeslidemax =  $this->input->post('range_slide_max');
            //$star_rating = $this->input->post('star_rating');
            //$service_include = $this->input->post('service_include');
           $inputArray = array("city"=>$dist,"ci"=>$checkin,"co"=>$checkout,"room"=>$numberofrooms,"adult"=>$guest,"child"=>"0","hotel_name"=>"");
           
           
        }else{
          
            if($pageid == 'top'){

              $ciDate = date('Y-m-d',strtotime('+ 2 days',strtotime(date('Y-m-d'))));
              $coDate = date('Y-m-d',strtotime('+ 3 days',strtotime(date('Y-m-d'))));
              $inputArray = array("city"=>"indonesia","ci"=>$ciDate,"co"=>$coDate,"room"=>"1","adult"=>"1","child"=>"0","hotel_name"=>"");

            }else{
              $inputArraytemp=$this->session->userdata('searchinfo');  
              if(count($inputArraytemp)>0){
                  foreach ($inputArraytemp as $key => $cvalue) {
                      $inputArray[$key] = $cvalue;
                  }
              }else{
                  $ciDate = date('Y-m-d',strtotime('+ 2 days',strtotime(date('Y-m-d'))));
                  $coDate = date('Y-m-d',strtotime('+ 3 days',strtotime(date('Y-m-d'))));
                  $inputArray = array("city"=>"indonesia","ci"=>$ciDate,"co"=>$coDate,"room"=>"1","adult"=>"1","child"=>"0","hotel_name"=>"");
              }  
            }          
        }
        $this->session->set_userdata('searchinfo',$inputArray);
        if (!$pageid) {  
             
           $resultarr =getDataFromRemot('hotel','hotel_search','','',$inputArray);
           //echo '<pre>';
            //print_r($resultarr); exit;
            //print_r($resultarr);exit;
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
            
        }else{

          //sk add top if condition for when user click on header hotel tab this if condition work 20-2-2018
          if($pageid == 'top'){
           
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

          }
               //echo 'welocme';
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
//echo 'hiii111';exit;
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
            //print_r($errormsg;exit;
			if(isset($errormsg->error_msg) && $errormsg->error_msg !=''){
                $data['errorMsg'] = $resultarr->error_msg;
            }else{
                $setCatcheData  = $this->service_m->get_hotel_filter_result($setCatcheData,$hotel_typeArr,$star_ratingArr,$service_includeArr,$priceArr);
            }
			
            
        }
 //print_r($setCatcheData);exit;
        if(isset($setCatcheData) && count($setCatcheData)>0)
        $setCatcheData = json_decode($setCatcheData);
      
        $curr = array("IDR"=>'Rp',"USD"=>"$","MYR"=>"RM","SGD"=>"S$");
        $data['curr']=$curr; 
        if(isset($setCatcheData->result_data) && $setCatcheData->result_data!='')
        {  

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

        //echo '<pre>';
       // print_r($data); exit; 
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
        //print_r($result);exit;     
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
          if($from != ''){
            $fromArrcoma = explode(',', $from);        
            if(count($fromArrcoma)>0){
              $fromArrdash = explode('-', $fromArrcoma[0]);
              if(count($fromArrdash)>0){
                if(isset($fromArrdash[1]) &&  $fromArrdash[1] != ''){
                  $from = trim($fromArrdash[1]);  
                }
                
              }
            }
          }
        	
        	$to = $to_i = $this->input->post('train_to');
          if($to != ''){
            $toArrcoma = explode(',', $to);
            if(count($toArrcoma)>0){
              $toArrdash = explode('-', $toArrcoma[0]);
              if(count($toArrdash)>0){
                if(isset($toArrdash[1]) &&  $toArrdash[1] != ''){
                $to = trim($toArrdash[1]);  
              }
              }
            }
          }
        	        	
        	$adult = $this->input->post('train_adult');
        	$child = $this->input->post('train_child');
        	$infant = $this->input->post('train_infant');
        	$inputArray = array("roundtrip"=>$roundtrip,"from"=>$from,'to'=>$to,'depart'=>$depart,'return'=>$return,'adult'=>$adult,'child'=>$child,"infant"=>$infant,"to_i"=>$to_i,"from_i"=>$from_i);

         // $inputArray = array("roundtrip"=>$roundtrip,"from"=>$from,'to'=>$to,'depart'=>$depart,'return'=>$return,'adult'=>$adult);


        }else if($this->input->post('applayfilter') == 'Apply Filter'){
           
        	$roundtrip = $this->input->post('train_roundtrip');
        	$depart = date('Y-m-d',strtotime($this->input->post('train_depart')));
        	$return = ($roundtrip == 'oneway')?$depart:date('Y-m-d',strtotime($this->input->post('train_return')));
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
 
          if($pageid == 'top'){
            $todayDate = date("Y-m-d");
            $postDate = date ("Y-m-d", strtotime ($todayDate ."+2 days"));

            //sk - when user click on top up train button show this defult values
            $inputArray = array("roundtrip"=>'oneway',"from"=>'BD','to'=>'GMR','depart'=>$todayDate,'return'=>$postDate,'adult'=>'1','child'=>'0',"infant"=>'0',"to_i"=>'GAMBIR-GMR,Jakarta',"from_i"=>'BANDUNG-BD,Bandung'); 
          }else{

          	$sessInputArr = $this->session->userdata('searchtrain');            
          	if(count($sessInputArr)>0){
          		foreach ($sessInputArr as $key => $value) {
  	        		$inputArray[$key] = $value;
  	        	}	
          	}else{

              $todayDate = date("Y-m-d");
              $postDate = date ("Y-m-d", strtotime ($todayDate ."+2 days"));

          		$inputArray = array("roundtrip"=>'oneway',"from"=>'BD','to'=>'GMR','depart'=>$todayDate,'return'=>$postDate,'adult'=>'1','child'=>'0',"infant"=>'0',"to_i"=>'GAMBIR-GMR,Jakarta',"from_i"=>'BANDUNG-BD,Bandung'); 	
          	}  
          }      	
        	
        }
      //echo '<pre>';
       //print_r($inputArray);
        $this->session->set_userdata('searchtrain',$inputArray);
        $sessInputArr = $this->session->userdata('searchtrain');
        $data['searchinfo'] = getDataFromRemot('train','train_search','','',$inputArray);
      //	print_r($data['searchinfo']);die;
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
       // echo '<pre>============';
        //print_r($data['searchinfo']);die;
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
        		
        		 $inputArray[$key] = urldecode($invalue);
        	}
        }
        $data = array();     
       // echo '<pre>'; 
       // print_r($inputArray);exit;
        $result =getDataFromRemot('train','train_detail','','',$inputArray);
       // print_r($result);exit;
        $this->session->set_userdata('sess_bk_info_train',$result);    
        if(isset($result->error_msg) && $result->error_msg!=''){
            $data['errorMsg'] = $result->error_msg;
       }
       // print_r($result);exit;
        $data['train_details'] = $result; 
        $data['inputArray'] = $inputArray;
        /*Smita : getAllcountries function use for get all country for country  dropdown box flight details page 23-1-2018*/
        $countriesData  = $this->service_m->getAllcountries(); 
        $data['countries_data']  = $countriesData;

        $curr = array("IDR"=>'Rp',"USD"=>"$","MYR"=>"RM","SGD"=>"S$"); 
        $data['curr']=$curr;   

        $this->load->library('template');
        $js = load_js(array('front/train-booking.js'));
        $this->template->write('footerJs',$js);
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
		$flightType = $this->input->get('t');
		$from_to = $this->input->get('f');
		$departure = $this->input->get('d');
		$airline = $this->input->get('a');
		//$departure2 = explode("-",$departure1);
		//$departure = $departure2[0];
       /* echo $keyWord.'===';
        echo $flightType.'===';
        echo $from_to.'===';
        echo $departure.'===';
        echo $airline.'===';exit;*/
		$resc = $this->master_db->search_suggestion($keyWord,$flightType,$from_to,$departure,$airline);
		//sort($resc);
		echo json_encode($resc);	 	
     	//echo json_encode($returnData);exit;
    }

    /*public function hotel($pageid=false,$filterId=false)
    {
        echo $pageid;
        echo $filterId;
    }*/
    public function get_domestic_airlines(){
		
     	 if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$keyWord = $this->input->get('q');
		$resc = $this->master_db->search_domestic_airline_suggestion($keyWord);
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

    /* @author : smita
     * @function use : notifications function use for user and agent send alert after any perfomance
     * @date : 22-12-2017
     */
  
    public function notifications(){
         if(is_front_session_set() == false){
            redirect("user-login");exit;
        } 
        //print_r('hiii');exit;
         $data = array();
        $this->load->library('template'); 
        $this->template->write('title', 'Notifications');
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', 'notifications', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();

    }


    public function agentDetails(){
   
    if($_POST['user_type'] == 'agent'){
       $agentDetails = $this->master_db->select('first_name,last_name,users_name,users_email,users_num,country_code',USERS,array('users_type'=>'AGENT','users_status'=>'ACTIVE'));  
        echo json_encode($agentDetails);exit;
    }
 
  }

}

