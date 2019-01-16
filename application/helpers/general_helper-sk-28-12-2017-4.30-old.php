<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


//function for check user login sesstion
//sesstion is not set redircte to login page
function is_admin_session_set() {

	// Get the CodeIgniter super object
	$CI = &get_instance();
	$CI->load->library('session');
	$className = $CI->router->fetch_class();
	//print_r($CI->session->all_userdata());die;
	if($CI->session->userdata(ADMIN_SESSION.'is_logged_in') == true && ($CI->session->userdata(ADMIN_SESSION.'user_type') =="ADMIN" )){
			return true;
	}else{
			redirect(ADMIN_CONTROLERS);
			exit();
	}
	
}
//check sesstion is set for gm user 
function is_front_session_set() {
	// Get the CodeIgniter super object
	$CI = &get_instance();
	$CI->load->library('session');
	$CI->load->model('master_db');
	
	//var_dump($CI->session->userdata(USER_SESSION.'user_type'));die;
	if($CI->session->userdata(USER_SESSION.'is_logged_in') == true && ($CI->session->userdata(USER_SESSION.'user_type') =="USER") || ($CI->session->userdata(USER_SESSION.'user_type')== "AGENT" )){ 
			$session_user = $CI->master_db->select('user_id,users_name,users_email',USERS,array("user_id"=>$CI->session->userdata(USER_SESSION.'user_id'),"users_status"=>'ACTIVE'));
			
			//echo $CI->db->last_query();die;
			if(count($session_user)>0){
				return true;
			}else{
				$CI->load->model('user_model');
				$CI->user_model->unset_user_session(USER_SESSION);				
				return false;
			}  
			//return true;
	}
	return false;
	
}

function is_enduser_front_session_set() {
	// Get the CodeIgniter super object
	$CI = &get_instance();
	$CI->load->library('session');
	$CI->load->model('master_db');
	$className = $CI->router->fetch_class();
	//var_dump($CI->session->userdata(USER_SESSION.'user_type'));die;
	if($CI->session->userdata(USER_SESSION.'is_logged_in') == true && ($CI->session->userdata(USER_SESSION.'user_type') ==4 )){
			$sesstion_user = $CI->master_db->select('ID,fname,lname',USERS,array("ID"=>$CI->session->userdata(USER_SESSION.'userid'),"status"=>'1'));
			
			//echo $CI->db->last_query();die;
			if(count($sesstion_user)>0){
				return true;
			}else{
				$CI->load->model('user_model');
				$CI->user_model->unset_user_session(USER_SESSION);				
				return false;
			}  
			//return true;
	}
	
}

//this finction returns links tag 
//@filename
function load_css($files = false){
	$loadcss ='';
	if(is_array($files)){
			if(count($files)>0){
				foreach($files as $file){
						$loadcss .="<link type='text/css' rel='stylesheet' href='".site_url()."assets/css/".$file."'>\n";
				}	
			}
	}else{		
		$explode = explode(",",$files);
		if(count($explode)>0){
			foreach($explode as $file){
					$loadcss .="<link type='text/css' rel='stylesheet' href='".site_url()."assets/css/".$file."'>\n";
					
			}	
		}
	}
	
	return $loadcss;
		
}

//this finction returns script tag 
//@filename
function load_js($files = false){
	$loadjs ='';
	if(is_array($files)){
			if(count($files)>0){
				foreach($files as $file){
						
						$loadjs .="<script type='text/javascript' src='".site_url()."assets/js/".$file."'></script>\n";
				}	
			}
	}else{
		$explode = explode(",",$files);
		if(count($explode)>0){
			foreach($explode as $file){
					$loadjs .="<script type='text/javascript' src='".site_url()."assets/js/".$file."'></script>\n";
			}	
		}
	}
	
	return $loadjs;
		
}

//function for count no of the infected post and letest 5 infected post

function get_red_post_notification(){
	$CI = &get_instance();
	$CI->load->model('post_model');
	$notification = $CI->post_model->get_notification();
	return $notification;
}

//function for time elapulated string

function time_elapsed_string($ptime){
	
	$etime = time() - strtotime($ptime);

    if ($etime < 1){
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)    {
        $d = $etime / $secs;
        if ($d >= 1){
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
	
}

 //function for calculate total hours
 function getTimeDiff($dtime,$atime){ 	
 $nextDay=$dtime>$atime?1:0;
 $dep=EXPLODE(':',$dtime);
 $arr=EXPLODE(':',$atime);
 $diff=ABS(MKTIME($dep[0],$dep[1],0,DATE('n'),DATE('j'),DATE('y'))-MKTIME($arr[0],$arr[1],0,DATE('n'),DATE('j')+$nextDay,DATE('y')));
 $hours=FLOOR($diff/(60*60));
 $mins=FLOOR(($diff-($hours*60*60))/(60));
 $secs=FLOOR(($diff-(($hours*60*60)+($mins*60))));
 IF(STRLEN($hours)<2){$hours="0".$hours;}
 IF(STRLEN($mins)<2){$mins="0".$mins;}
 IF(STRLEN($secs)<2){$secs="0".$secs;}
 RETURN $hours.' h '.$mins.' m ';
}

//function for time elapulated string only for hours and min
function time_elapsed_string_four_min($dtime,$atime,$dDate,$aDate){
	
	$datetime1 = new DateTime($aDate.' '.$atime.':00');
	$datetime2 = new DateTime($dDate.' '.$dtime.':00');
	$interval = $datetime1->diff($datetime2);
	return $interval->format('%h')." h ".$interval->format('%i')." m";
} 

//function for active menu and submenu
function active_menu($segment=false){
		$active ='';
		if($segment){
			$CI = &get_instance();
			$segmentArr = $CI->uri->segment_array();
			if(in_array($segment,$segmentArr)){
				$active ='active';	
			}
		}
		return $active;
}

//function for send simple email

function send_email($to,$subject,$message){
   $headers  = 'MIME-Version: 1.0' . PHP_EOL;
   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  // More headers
   $headers .= "From:Rumbostar <".ADMIN_MAIL.">";
   $retval 	 = mail($to,$subject,$message,$headers);
   return $retval;

}


//function for removing spacial charactors,spaces etc variable

function remove_spaces($string = false){
	$enc_string  = $string;
	if($string){
		$enc_string=str_replace(array(' '), array('-'), $enc_string);
	}
	return $enc_string;
}

//function decode url varibale
function add_spaces($string = false){
	$dec_string = $string;
	if($string){
		$dec_string=str_replace(array('-'), array(' '), $string);		
	}
	return $dec_string;
}

//function for encoding the url variable

function encode_string($string = false){
	$CI = &get_instance();
	$CI->load->library('encrypt');
	$enc_string  = $string;
	if($string){
		$enc_string=$CI->encrypt->encode($string);
		$enc_string=str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_string);
	}
	return $enc_string;
}

//function decode url varibale
function decode_string($string = false){
	$CI = &get_instance();
	$CI->load->library('encrypt');
	$dec_string = $string;
	if($string){
		$dec_string=str_replace(array('-', '_', '~'), array('+', '/', '='), $string);
		$dec_string=$CI->encrypt->decode($dec_string);
	}
	return $dec_string;
}


//convert_array_value
function convert_array_value($objArr,$key){
	$array = array();
	if(count($objArr)>0){
		$i=0;
		foreach($objArr as $resc){
			$array[$i] = $resc->$key;
			$i++;
		}
		return $array;
	}
	return $array;
}

//function for social media url creation
function create_social_media_url($medialname=false){
	//print_r($medialname);exit;
	$link = '';
	if($medialname !=false){
		$CI = &get_instance();
		$CI->load->library('social_media');
		$link = $CI->social_media->login_url($medialname);
		//print_r($link);exit;
	}
	return $link;
}
function get_current_time($format="m/d/Y")
{
	$d = new DateTime("now", new DateTimeZone("Europe/Athens"));
	$today= $d->format("Y-m-d");
	return date($format,strtotime($today));
}
//public funciton for random strin
function get_random_string(){
	$string = '';
	$alphabets = range('A','Z');
	$numbers = range('0','9');
	$final_array = array_merge($alphabets,$numbers);
	$length =10;  
	while($length--) {
	  $key = array_rand($final_array);
	  $string .= $final_array[$key];
	}
	return $string;
}

function get_settings($seetingName){
	$CI = &get_instance();
	$CI->db->select('sett_value');
	$CI->db->from(SETTING);
	$CI->db->where('sett_name',$seetingName);
	$q = $CI->db->get();
	$result = $q->result();
	return $result[0]->sett_value;
}
function get_mutipale_settings($seetingName=false){
	$settingArr = array();
	if(is_array($seetingName)){
		$CI = &get_instance();
		$CI->db->select('sett_name,sett_value');
		$CI->db->from(SETTING);
		$CI->db->where_in('sett_name',$seetingName);
		$q = $CI->db->get();
		$result = $q->result();
		foreach($result as $key=>$resc){
			$settingArr[$resc->sett_name] = $resc->sett_value;
		}		
	}
	return $settingArr;
}

function create_unique_slug($string,$table,$field,$key=NULL,$value=NULL){
    $t =& get_instance();
    $slug = url_title($string);
    $slug = strtolower($slug);
    $i = 0;
    $params = array ();
    $params[$field] = $slug;
 
    if($key)$params["$key !="] = $value;
 
    while ($t->db->where($params)->get($table)->num_rows())
    {  
        if (!preg_match ('/-{1}[0-9]+$/', $slug ))
            $slug .= '-' . ++$i;
        else
            $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
         
        $params [$field] = $slug;
    }  
    return $slug;  
}



function get_time_diffrence($timestamp){
	$currentTimestamp = date('Y-m-d H:i:s');
	$diff = abs(strtotime($currentTimestamp) - strtotime($timestamp));
	$hour = $diff/(60*60); // in hour
	$hour = floor($hour);
	return $hour;
}

function get_country($countryid){
	if($countryid == '' || $countryid == '0'){
		return '';die;
	}
	$CI = &get_instance();
	$CI->load->model('master_db');
	$cityRes = $CI->master_db->select('country_id,country_name',COUNTRY,array("country_id"=>$countryid)); //
	return $cityRes[0]->country_name;
}
function get_city($cityid){
	if($cityid == '' || $cityid == '0'){
		return '';die;
	}
	$CI = &get_instance();
	$CI->load->model('master_db');
	$cityRes = $CI->master_db->select('city_id,city_name',CITY,array("city_id"=>$cityid)); //COUNTRY
	//echo $CI->db->last_query();die;
	return $cityRes[0]->city_name;
}

function get_all_city(){
	
	$CI = &get_instance();
	$CI->load->model('master_db');
	$cityRes = $CI->master_db->select('city_id,city_name',CITY,'','',array('city_name'=>'ASC')); //COUNTRY
	//echo $CI->db->last_query();die;
	//return $cityRes[0]->city_name;
	$cityArr =array();
	$cityArr[''] = 'Select city';
	if(count($cityRes)>0){
		foreach ($cityRes as $key => $city) {
			$cityArr[$city->city_id] = $city->city_name;
		}
	}
	return $cityArr;
}

function getCatBySlug($slug){
	$CI = &get_instance();
	$CI->load->model('master_db');
	$catRes = $CI->master_db->select('catname,catid',CATEGORY,array("cat_slug"=>$slug));
	$catResArr = array();
	if(count($catRes)>0){
		return $catRes[0]->catid;
	}
	return 0;
}

function getCityByName($city){
	$CI = &get_instance();
	$CI->load->model('master_db');
	$cityRes = $CI->master_db->select('city_id,city_name',CITY,array("city_name"=>$city)); //COUNTRY
	//echo $CI->db->last_query();die;
	if(count($cityRes)>0){
		return $cityRes[0]->city_id;
	}
	return 0;
}


//function for caculating avrage rating by propid

function getAvgRating($propID){
	$CI = &get_instance();
	$CI->load->model('master_db');
	$joinreviewArr = array(
							array('join_table'=>PROPERTY_REVIEWS.' as pr','join_con'=>'pr.prop_id=ipi.prop_id','join_type'=>'inner'),
							array('join_table'=>USERS.' as iu','join_con'=>'pr.userid=iu.ID','join_type'=>'inner')
						);
	$reviewsResc = $CI->master_db->select_join('avg(pr.prop_ratings) as prop_ratings',PROPERTY_INFO.' as ipi',$joinreviewArr,array('pr.prop_id'=>$propID,'pr.rev_status'=>'1'),'','','','',array("ipi.prop_id"));
	//print_r($reviewsResc);die;
	if(isset($reviewsResc) && count($reviewsResc)>0){
		return $reviewsResc[0]->prop_ratings;
	}else{
		return 0;
	}
}

/*function getDataFromRemot($service=FALSE,$action=FALSE,$language=FALSE,$currency=FALSE,$inputarray=FALSE){

	
	$CI = &get_instance();
	$CI->config->load('third_party_api'); 
	$apiconfig=$CI->config->item($service);

	
	
	$postData['akses_kode'] = $apiconfig['akses_kode'];
	$postData['app'] = $apiconfig['app'];
	$postData['action'] = $action;
	//$postData['roundtrip'] = "oneway"; //oneway or return
	//$postData['from'] = "CGK";
	//$postData['to'] = "AMS";
	//$postData['depart'] = date('Y-m-d');
	//$postData['return'] = date('Y-m-d');
	//$postData['adult'] = "1";
	//$postData['child'] = "0";
	//$postData['infant']= "0";
	//$postData['currency']= "USD";

	if(count($inputarray)>0){
		foreach ($inputarray as $key => $value) {
			# code...

			$postData[$key] = $value;
		}
	}
	
	$url = $apiconfig['url'];
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'AT2-JSN');
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, '120');
	curl_setopt($ch, CURLOPT_TIMEOUT, 120);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	if($result === false)
	{
		return curl_error($ch);
	}

	curl_close($ch);
	//print_r($result);die;
	return json_decode($result);
}*/


function getDataFromRemot($service=FALSE,$action=FALSE,$language=FALSE,$currency=FALSE,$inputarray=FALSE){
	//echo '<pre>';
	//echo ($service);
	//echo $action;
	//echo $language;
	//echo $current; exit;
	
	$CI = &get_instance();
	$CI->config->load('third_party_api'); 
	$apiconfig=$CI->config->item($service);
/*
	echo '<pre>';
	
	echo '=apiconfig===';
	print_r($apiconfig);
	echo '=service===';
	print_r($service);
	echo '=action===';
	print_r($action);

	print_r($inputarray);exit;*/

	$postData['akses_kode'] = $apiconfig['akses_kode'];
	if(isset($inputarray['flightRadios']) && ($inputarray['flightRadios'] == 'domestic')) {
		$postData['app'] = 'flight';
	} else if(isset($inputarray['flightRadios']) && ($inputarray['flightRadios'] == 'international')) {
		$postData['app'] ='flightint';
	} else {
		$postData['app'] = $apiconfig['app'];
	}	
	
	$postData['action'] = $action;
	/*$postData['roundtrip'] = "oneway"; //oneway or return
	$postData['from'] = "CGK";
	$postData['to'] = "AMS";
	$postData['depart'] = date('Y-m-d');
	$postData['return'] = date('Y-m-d');
	$postData['adult'] = "1";
	$postData['child'] = "0";
	$postData['infant']= "0";
	$postData['currency']= "USD";*/

	if(count($inputarray)>0){
		foreach ($inputarray as $key => $value) {
			# code...

			$postData[$key] = $value;
		}
	}
	//echo '<pre>';
 //print_r($postData);
	
	$url = $apiconfig['url'];
	//print_r($url);exit;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'AT2-JSN');
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, '120');
	curl_setopt($ch, CURLOPT_TIMEOUT, 120);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	// print_r($result);exit;
	
	if($result === false)
	{
		return curl_error($ch);
	}
	
	curl_close($ch);
	//echo '<pre>';
	//print_r(json_decode($result));die;
	return json_decode($result);
}



/*---------------------------- Amol Avantkar 20-12-2016 --------------------------*/
function getPaginationResult($array,$limit,$pageid,$custUrl=false){
	$totalRecords = count( $array );
	$CI = &get_instance();
        $noOfPage = round($totalRecords/$limit);
        if($custUrl){
        	$url = site_url()."".$custUrl;
        }else{
        	$url = site_url().$CI->uri->segment(1)."/".$CI->uri->segment(2);
        }
        $navPageHTML ='';
        if(count($noOfPage)>0){
        		//echo $pageid;die;
        		 $prevUrl = 'javascript:void(0)';
        		 if($pageid == '' || $pageid==0 || $pageid==1){
					$prevUrl = 'javascript:void(0)';
        		 }else{
        		 	$prePage = $pageid - 1;
        		 	$prevUrl = $url.'/'.$prePage.'/'.$CI->uri->segment(3);

        		}
        		if(count($array)>0)
        		$navPageHTML = '<a href="'.$prevUrl.'" class="pagination-prev"><i class="fa fa-caret-left"></i></a>';

        	 	$j=0;
        	 	for($z=1;$z<=$noOfPage;$z++){
       	 		 	if(!$pageid && $z==1){
       	 		 		$cuActive = 'current';
       	 		 	}else{
       	 		 		$cuActive = ($z == $pageid)?'current':'';	
       	 		 	}
       	 		 	$navPageHTML .=	'<span ><a class="'.$cuActive.'" href="'.$url.'/'.$z.'/'.$CI->uri->segment(3).'">'.$z.'</a></span>';        	 		 	
       	 		 	$j++;
        	 	} 
        	 	$nextUrl = 'javascript:void(0)';
        	 	if($pageid<$j){
        	 		$nextPage = $pageid+1;
        	 		$nextUrl = $url.'/'.$nextPage.'/'.$CI->uri->segment(3);
        	 	}
        	 	if(count($array)>0)
        	 	$navPageHTML .= '<a href="'.$nextUrl.'" class="pagination-next"><i class="fa fa-caret-right"></i></a>';
        }else{

        	$navPageHTML = '<a href="javascript:void(0)" class="pagination-prev"><i class="fa fa-caret-left"></i></a>
        	 				<span><a class="current" href="'.$url.'/1">1</a></span>                                
        	 				<a href="javascript:void(0)" class="pagination-next"><i class="fa fa-caret-right"></i></a>';
        }
        if($pageid){
            $start = ($pageid - 1) * $limit;
        }else{
            $start = 0;
        }
        $offset = $limit;
        $airlineIfoArray = array_slice($array, $start, $offset);

        return array(
        				"no_of_pages"=>$navPageHTML,
        				"outArrResult"=>$airlineIfoArray
        			);
}

function get_arrival_date($depatureDate,$depatureTime,$arrivalTime){
	$explodeArivalT = explode(":", $arrivalTime);
	//print_r($explodeArivalT);die;
	$depatureDateTime = $depatureDate." ".$depatureTime.":00";
	$depatureDateTime = strtotime($depatureDateTime);
	return date('d-M-Y',strtotime('+'.$explodeArivalT[0].' hour +'.$explodeArivalT[1].' minutes',$depatureDateTime));
}


function get_hotel_city_offer($city_name,$actual_price){
	$CI = &get_instance();
	$CI->load->model('master_db');
	$offer_hotel_city = $CI->master_db->select('*',OFFER_MANAGEMENT,array('hotel_city'=>$city_name,'offer_status'=>'1','offer_start_date <='=>date("Y-m-d"),'offer_end_date >='=>date("Y-m-d")));
	//echo $CI->db->last_query();die; 
	if(count($offer_hotel_city)>0){
		if($offer_hotel_city[0]->offer_in ==0){
			 $discounted_price = ($actual_price - ($actual_price * ($offer_hotel_city[0]->offer_amount / 100)));
			return array('actual_price'=>number_format($actual_price),'discounted_price'=>number_format($discounted_price));
		}
		else
		{
			$discounted_price = ($actual_price-$offer_hotel_city[0]->offer_amount);
			return array('actual_price'=>number_format($actual_price),'discounted_price'=>number_format($discounted_price));
		}
	} else {
		$discounted_price = 0;
		return array('actual_price'=>number_format($actual_price),'discounted_price'=>$discounted_price);
	}	
	
	
}

/* End of file general_helper.php */
/* Location: ./application/helpers/general_helper.php */

function getAirlineidByName($airline){
	    $airline_explode = explode("-",$airline);
	    if(count($airline_explode)>0) {
			$airline_name = @$airline_explode[0];
			$airline_code = @$airline_explode[1];
		}
	$CI = &get_instance();
	$CI->load->model('master_db');
	$airlineRes = $CI->master_db->select('dal_id',DOMESTIC_AIRLINE_LIST,array("dal_name"=>$airline_name,"dal_code"=>$airline_code)); //COUNTRY
	//echo $CI->db->last_query();die;
	if(count($airlineRes)>0){
		return $airlineRes[0]->dal_id;
	}
	return 0;
}