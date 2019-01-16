<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_db extends CI_Model {

	public function __construct(){
		parent:: __construct();
	}
	//function for inser single record in database table
	public function insert($table,$dataArr){
		
		$this->db->insert($table,$dataArr);
		return $this->db->insert_id();
	}
	//function for insert mutiple records at a time in a table
	public function insert_batch($table,$dataArr){
		if($this->db->insert_batch($table,$dataArr)){
			//return $this->db->insert_id();
			return true;
		}else{
			return false;
		}
	}
	//function for update single record using single or mutiple condition
	public function update($table,$dataArr,$where=false){
		if($where){
			$this->db->where($where);
		}
		
		return $this->db->update($table,$dataArr);
	}
	
	//function for get single or mutiple records form database table
	public function select($fields,$table,$wheres=false,$likes=false,$filters=false,$group_by=false,$distinct=false,$where_in=false, $order_by=false){
		//print_r($fields);exit;
		$this->db->select($fields);
		$this->db->from($table);
		if($wheres && is_array($wheres)){
			$this->db->where($wheres);
		}
		if($likes && is_array($likes)){
			$this->db->like($likes);
		}
		if($filters && is_array($filters)){
			foreach($filters as $key=>$filter){
				$this->db->order_by($key,$filter);
			}			
		}
		if($group_by && is_array($group_by)){
			$this->db->group_by($group_by);
		}
		if($distinct && is_array($distinct)){
			foreach($distinct as $key=>$dist){
				$this->db->distinct($dist);
			}
		}	
		if($where_in){
			foreach($where_in as $key=>$resc){
				$this->db->where_in($key,$resc);
			}				
		}	
		//sk add condition for admin issue flight_offer list desc order 15-12-2017
		//print_r($order_by);exit;
		if(count($order_by)>0 && $order_by != ''){
			foreach($order_by as $key => $val)
			{
				$this->db->order_by($key, $val);
			}
		}
		$query = $this->db->get();
		//echo $this->db->last_query();
       // exit;
        //print_r($query->result());
		return $query->result();	
	}


	function selectQuery($sel,$table,$cond = array(),$orderBy=array(),$join=array(),$joinType=array())
	{
		$this->db->select($sel, FALSE);
		$this->db->from($table);
		foreach ($cond AS $k => $v)
		{
			$this->db->where($k,$v);
		}
		foreach($orderBy as $key => $val)
		{
			$this->db->order_by($key, $val);
		}
        foreach($join as $key => $val)
        {
            if(!empty($joinType) && $joinType[$key]!=""){
                $this->db->join($key, $val,$joinType[$key]);
            }else{
                $this->db->join($key, $val);    
            }
        }
        $query = $this->db->get();
        /*echo $this->db->last_query();
        exit;*/
		
		return $query->result();
	}

	
	public function select_limit($fields,$table,$wheres=false,$likes=false,$filters=false,$group_by=false,$distinct=false,$limit=false){
		$this->db->select($fields);
		$this->db->from($table);
		if($wheres && is_array($wheres)){
			$this->db->where($wheres);
		}
		if($likes && is_array($likes)){
			$this->db->like($likes);
		}
		if($filters && is_array($filters)){
			foreach($filters as $key=>$filter){
				$this->db->order_by($key,$filter);
			}			
		}
		if($group_by && is_array($group_by)){
			$this->db->group_by($group_by);
		}
		if($distinct && is_array($distinct)){
			foreach($distinct as $key=>$dist){
				$this->db->distinct($dist);
			}
		}
		if($limit!=''){
			$this->db->limit($limit['limit'], $limit['start']);
		}	
		$query = $this->db->get();
		return $query->result();	
	}

	
	//function for delete record form table
	public function delete($table,$where=false,$where_in=false){
			if($where){
				$this->db->where($where);
			}
			if($where_in){
				foreach($where_in as $key=>$resc){
					$this->db->where_in($key,$resc);
				}				
			}
			$rec = $this->db->delete($table);
			if($rec){
				return true;
			}else{
				return false;
			}
	}	
	//function for join
	public function select_join($fields,$table,$joinsArr=false,$wheres=false,$likes=false,$filters=false,$wheresOr=false,$where_in=false,$group_by=false){
		$this->db->select($fields);
		$this->db->from($table);
		if(count($joinsArr)>0 && is_array($joinsArr)){
			foreach($joinsArr as $joinSingArr){
				$this->db->join($joinSingArr['join_table'],$joinSingArr['join_con'],$joinSingArr['join_type']);
			}
		}
		if($wheres && is_array($wheres)){
			$this->db->where($wheres);
		}
		if($likes && is_array($likes)){
			$this->db->like($likes);
		}
		if($wheresOr && is_array($wheresOr)){
			$whereStr = '';
			foreach($wheresOr as $wKey =>$whereOr ){
				$whereStr .= $wKey." = '".$whereOr."' or ";
			}
			if($whereStr !=''){
				$whereStr = substr($whereStr,0,-3);
			}
			$this->db->where($whereStr);
		}
		if(count($where_in)>0 && is_array($where_in)){
			foreach($where_in as $where_inRes){
				if($where_inRes['condition'] == 'where_in'){
					$this->db->where_in($where_inRes['key'],$where_inRes['value']);
				}else if($where_inRes['condition'] == 'where_not_in'){
					$this->db->where_not_in($where_inRes['key'],$where_inRes['value']);
				}else{
					$this->db->where_in($where_inRes['key'],$where_inRes['value']);
				}
			}
		}
		if($filters && is_array($filters)){
			foreach($filters as $key=>$filter){
				$this->db->order_by($key,$filter);
			}			
		}	
		if($group_by && is_array($group_by)){
			$this->db->group_by($group_by);
		}
		$query = $this->db->get();
		return $query->result();
	}

	//function for join with limit
	public function select_join_limit($fields,$table,$joinsArr=false,$wheres=false,$likes=false,$filters=false,$wheresOr=false,$where_in=false,$group_by=false,$start=0){
		$this->db->select($fields);
		$this->db->from($table);
		if(count($joinsArr)>0 && is_array($joinsArr)){
			foreach($joinsArr as $joinSingArr){
				$this->db->join($joinSingArr['join_table'],$joinSingArr['join_con'],$joinSingArr['join_type']);
			}
		}
		if($wheres && is_array($wheres)){
			$this->db->where($wheres);
		}
		if($likes && is_array($likes)){
			$this->db->like($likes);
		}
		if($wheresOr && is_array($wheresOr)){
			$whereStr = '';
			foreach($wheresOr as $wKey =>$whereOr ){
				$whereStr .= $wKey." = '".$whereOr."' or ";
			}
			if($whereStr !=''){
				$whereStr = substr($whereStr,0,-3);
			}
			$this->db->where($whereStr);
		}
		if(count($where_in)>0 && is_array($where_in)){
			foreach($where_in as $where_inRes){
				if($where_inRes['condition'] == 'where_in'){
					$this->db->where_in($where_inRes['key'],$where_inRes['value']);
				}else if($where_inRes['condition'] == 'where_not_in'){
					$this->db->where_not_in($where_inRes['key'],$where_inRes['value']);
				}else{
					$this->db->where_in($where_inRes['key'],$where_inRes['value']);
				}
			}
		}
		if($filters && is_array($filters)){
			foreach($filters as $key=>$filter){
				$this->db->order_by($key,$filter);
			}			
		}	
		if($group_by && is_array($group_by)){
			$this->db->group_by($group_by);
		}
		if(count($start)>0 && is_array($start)){
			$this->db->limit($start['limit'], $start['start']);
		}else{
			$this->db->limit(LISTING_PAGE_LIMIT, $start);
		}
		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function select_serach_list($fields,$table,$joinsArr=false,$wheres=false,$wheresOr=false,$likes=false,$filters=false,$where_in=false,$start=0,$group_by=false,$whStr=false){
		$this->db->select($fields);
		$this->db->from($table);
		if(count($joinsArr)>0 && is_array($joinsArr)){
			foreach($joinsArr as $joinSingArr){
				$this->db->join($joinSingArr['join_table'],$joinSingArr['join_con'],$joinSingArr['join_type']);
			}
		}
		if($wheres && is_array($wheres)){
			$this->db->where($wheres);
		}
		if($wheresOr && is_array($wheresOr)){
			$whereStr = '';
			foreach($wheresOr as $wKey =>$whereOr ){
				$whereStr .= $wKey." = '".$whereOr."' or ";
			}
			if($whereStr !=''){
				$whereStr = substr($whereStr,0,-3);
			}
			$this->db->where($whereStr);
		}
		if($whStr && is_array($whStr)){
			//$whStrr = '';
			$this->db->or_where($whStr);
			//$this->db->or_where($whStrr);
		}

		if(count($where_in)>0 && is_array($where_in)){
			foreach($where_in as $where_inRes){
				if($where_inRes['condition'] == 'where_in'){
					$this->db->where_in($where_inRes['key'],$where_inRes['value']);
				}else if($where_inRes['condition'] == 'where_not_in'){
					$this->db->where_not_in($where_inRes['key'],$where_inRes['value']);
				}else{
					$this->db->where_in($where_inRes['key'],$where_inRes['value']);
				}
			}
		}
		if($likes && is_array($likes)){
			$likeStr = '(';
			foreach($likes as $lKey =>$like ){
				$likeStr .= $lKey." LIKE '%".$like."%' or ";
			}
			if($likeStr !=''){
				$likeStr = substr($likeStr,0,-3);
			}
			
			$likeStr .=')';
			$this->db->where($likeStr);
		}
		if($filters && is_array($filters)){
			foreach($filters as $key=>$filter){
				$this->db->order_by($key,$filter);
			}			
		}	
		if($group_by && is_array($group_by)){
			$this->db->group_by($group_by);
		}
		$this->db->limit(LISTING_PAGE_LIMIT, $start);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function search_suggestion($searchKey=false,$flightType=false,$from_to=false,$departure=false,$airline=false){
		//$accTypeResc = $this->select('catname,cat_slug',CATEGORY,'',array("catname"=>$key));
		  $this->load->helper('general');
		$finalArr = array();
		if($searchKey){
			if($flightType == 'domestic'){ 
				if($from_to == 'from'){ 
					$airline = getAirlineidByName($airline); 
					$inputArray['airline'] = $airline;    
					 $result = getDataFromRemot('info','get_departure_airport','','',$inputArray);

					 // $cResult = json_decode($result);
						//var_dump($result);
						foreach($result->departure_airport as $airport_data){
							$pos = stripos($airport_data->airport_city.'-'.$airport_data->airport_code, $searchKey);
							if ($pos === false) {
								
							}else {
								$finalArr[] = $airport_data->airport_city.'-'.$airport_data->airport_code;
							}	
					}
				} else if($from_to == 'to'){ 
					 
					$airline = getAirlineidByName($airline);
					$inputArray['airline'] = $airline;  
					$departure1 = explode("-",$departure);
					$inputArray['departure'] = $departure1[1];
					 $result = getDataFromRemot('info','get_arrival_airport','','',$inputArray);
					 // $cResult = json_decode($result);
						//var_dump($result);
						foreach($result->arrival_airport as $airport_data){
							$pos = stripos($airport_data->airport_city.'-'.$airport_data->airport_code, $searchKey);
							if ($pos === false) {
								
							}else {
								$finalArr[] = $airport_data->airport_city.'-'.$airport_data->airport_code;
							}	
					}
				}
					
			}	else { 
				//for category
				$sql = "select * from ".AIRPORT_LIST." where ap_code like '%".$searchKey."%' or ap_name like '%".$searchKey."%' or ap_city like '%".$searchKey."%' ";
				$accTypeResc = $this->sel_exe_query($sql);
				foreach($accTypeResc as $key=>$accRes){
					$finalArr[] = $accRes->ap_city.'-'.$accRes->ap_code;
				}
			}
				
		}else{ return "else";
			$this->db->select('ap_id,ap_code,ap_city');
			$this->db->from(AIRPORT_LIST);
			$query = $this->db->get();
			$accTypeResc = $query->result();
			foreach($accTypeResc as $key=>$accRes){
				$finalArr[] = $accRes->ap_city.'-'.$accRes->ap_code;
			}
			
		}
		return $finalArr;
	}
	public function search_domestic_airline_suggestion($searchKey=false){ 
		//$accTypeResc = $this->select('catname,cat_slug',CATEGORY,'',array("catname"=>$key));
		$finalArr = array();
		if($searchKey){
			//for category
			$sql = "select * from ".DOMESTIC_AIRLINE_LIST." where dal_code like '%".$searchKey."%' or dal_name like '%".$searchKey."%'";
			$accTypeResc = $this->sel_exe_query($sql);
			foreach($accTypeResc as $key=>$accRes){
				$finalArr[] =$accRes->dal_name."-".$accRes->dal_code;
			}
			
		}else{
			$this->db->select('*');
			$this->db->from(DOMESTIC_AIRLINE_LIST);
			$query = $this->db->get();
			$accTypeResc = $query->result();
			foreach($accTypeResc as $key=>$accRes){
				$finalArr[] = $accRes->dal_name." - ".$accRes->dal_code;
			}
			
		}
		//echo '<pre>';
		//print_r($finalArr);exit;
		return $finalArr;
	}
	public function get_settings($sttings=false){
		if($sttings && is_array($sttings)){
			$this->db->select('sett_name,sett_value');
			$this->db->from(SETTING);
			$this->db->where_in("sett_name",$sttings);
			$query = $this->db->get();
			$result =  $query->result();
			$returnArr = array();
			foreach ($result as $key => $value) {
				$returnArr[$value->sett_name] = $value->sett_value;
			}
			return $returnArr;
		}
		return false;

	}

	public function update_setting($table,$sttingsArr){
		foreach ($sttingsArr as $key => $value) {
			$arrKey = array_keys($value);
			//print_r($arrKey[0]);die;
			$this->db->update($table,array("sett_value"=>$value[$arrKey[0]]),array("sett_name"=>$arrKey[0]));
			$lastQuery[] = $this->db->last_query();
		}
		return true;
	}

	public function sel_exe_query($query){

		$query = $this->db->query($query);
		return $query->result();
	}

	/* @author : Smita
	 * @function use : fetchMyFlightBooking function use for fetch all booking flight.
	 * @date : 20-12-2017
	*/
	public function fetchMyFlightBooking($userId){
		//echo $userId;exit;
		$this->db->select('cibd.*');
		$this->db->from(CUST_INFO_BOOKING_DETAILS.' as cibd');
	//	$this->db->join(PASSENGER_DETAILS.' as pd',"pd.cust_id = cibd.cust_id","inner" );		
		$this->db->where('cibd.user_id',$userId);		
		$query = $this->db->get();
		//echo $this->db->last_query();
       // exit;
		$bookFlightRes = $query->result();		
		return $bookFlightRes;
	}

	

	public function fetchMyFlightbyflightid($userId, $flightId){

		$this->db->select('cibd.*');
		$this->db->from(CUST_INFO_BOOKING_DETAILS.' as cibd');		
		$this->db->where('cibd.user_id',$userId);	
		$this->db->where('cibd.flight_no',$flightId);	
		$query = $this->db->get();
		//echo $this->db->last_query();
       // exit;
		$bookFlightRes = $query->result();		
		return $bookFlightRes;
	}

	/* @author : Smita
	 * @function use : fetchPessagerDetailWithFlight function use for fetch 
	  pessager details with booking flight  details.
	 * @date : 5-1-2018
	*/
	public function fetchPessagerDetailWithFlight($userId,$cust_id){
		$this->db->select('pd.*');
		$this->db->from(CUST_INFO_BOOKING_DETAILS.' as cibd');
		$this->db->join(PASSENGER_DETAILS.' as pd',"pd.cust_id = cibd.cust_id OR cibd.cust_id = pd.cust_dept_id","inner" );		
		$this->db->where('pd.user_id',$userId);
		$this->db->where('cibd.cust_id',$cust_id);	
		//$this->db->where('cibd.')	
		$query = $this->db->get();

		//echo $this->db->last_query();
        //exit;
		$pessagerbookFlightRes = $query->result();		
		return $pessagerbookFlightRes;
	}

	/* @author : Smita
	 * @function Use : fetchFlightCustRecord function use for fetch flight customer recored in flight mode is retrun and select 2 fligh flight
	 * @date : 11-1-2018
	*/

	public function fetchFlightCustRecord($data){

		$this->db->select('*');
		$this->db->from(CUST_INFO_BOOKING_DETAILS);
		$this->db->where_in('cust_id', $data);

		$query = $this->db->get();
		$flightCustRes = $query->result();		
		return $flightCustRes;

	}


	public function fetchTrainCustRecord($data){
		$this->db->select('*');
		$this->db->from(CUST_TRAIN_BOOKING_DETAILS);
		$this->db->where_in('cust_id', $data);

		$query = $this->db->get();
		$trainCustRes = $query->result();
		return $trainCustRes;
	}


	public function fetchMyReferFriends($user_id){
		$this->db->select('u.parent_user_id, u.my_referral_code AS self_referal_code, uifc.email_id, uifc.first_name, uifc.last_name, uifc.referral_code, uifc.id');
		$this->db->from(USERS. ' as u');
		$this->db->join(USER_INVITE_REFERRAL_CODE. ' as uifc', "uifc.id = u.invite_referral_code_id", "RIGHT" );
		$this->db->where('uifc.user_id', $user_id);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$myreferralFirends = $query->result();
		return $myreferralFirends;
	}


	public function fetchFriendByEmailId($emailId){
		
		$this->db->select('*');
		$this->db->from(USER_INVITE_REFERRAL_CODE);
		$this->db->where('email_id', $emailId);
		$query = $this->db->get();
		$existFriend = $query->result();
		return $existFriend;
	}

	public function fetchfriendsById($inviteId){

		$this->db->select('*');
		$this->db->from(USER_INVITE_REFERRAL_CODE);
		$this->db->where('id', $inviteId);
		$query = $this->db->get();
		$resendfriend = $query->result();
		return $resendfriend;	

	}


	public function fetchAllReferalUser(){

		$this->db->select('us.first_name AS refer_first_name, us.last_name AS refer_last_name, us.user_id AS refer_userId, u.user_id AS referal_user_id, uirc.first_name AS referal_firstname, uirc.last_name AS referal_lastname, uirc.email_id AS referal_email_id, uirc.referral_code');
		$this->db->from(USERS. ' as u');
		$this->db->join(USER_INVITE_REFERRAL_CODE. ' as uirc', "uirc.id = u.invite_referral_code_id", "INNER" );
		$this->db->join(USERS. ' as us', "us.user_id = uirc.user_id", "LEFT" );
		
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$myreferralFirends = $query->result();
		return $myreferralFirends;	
	}

   /* @suthor : Smita
	* @function use : socialShareInsert function use for share tickit on social site and update values in database
	* @date : 1-2-2018
	*/
	public function socialShareInsert($data){
		
		$datas = array(
	        'share_by' => $data['social_from'],
	        'is_share' => $data['is_share'],
	        'cust_id' => $data['cust_id'],
	        'user_id'=> $data['userId'],
	        'booking_type'=>$data['booking_type'],
		);

		$this->db->insert(SOCIAL_SHARE_MASTER, $datas);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function shareingExits($social_from, $cust_id,$booking_type){

		$this->db->select("*");
		$this->db->from(SOCIAL_SHARE_MASTER);
		$this->db->where("share_by",$social_from);
		$this->db->where('cust_id', $cust_id);
		$this->db->where('booking_type', $booking_type);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$recoredexits = $query->result();
		return $recoredexits;	
	}

   /* @author : Smita
	* @function use: fetchAllFlightOnSocialShare function use for booking flight 
	  share on social site details
	* @date : 1-2-2018
	*/
	public function fetchAllFlightOnSocialShare(){

		$this->db->select('ssm.* , cibd.cust_name, cibd.cust_email, cibd.flight_name, cibd.flight_no');
		$this->db->from(SOCIAL_SHARE_MASTER. ' as ssm');
		$this->db->join(CUST_INFO_BOOKING_DETAILS.' as cibd', 'cibd.cust_id = ssm.cust_id', 'inner');
		$this->db->where('ssm.is_share', '1');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$allsharebookingflight = $query->result();
		return $allsharebookingflight;
		
	}

   /* @author :Smita
    * @function use : fetchUserIdbyEmail function use for fetch user name, id for flight discount
    * @date : 5-2-2018 
    */

	public function fetchUserIdbyEmail($emailid){
		$this->db->select('user_id, first_name,last_name,users_email');
		$this->db->from(USERS);
		$this->db->where('users_email', $emailid);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$userId = $query->result();
		//echo '<pre>';
		//print_r($userId);exit;
		return $userId;
	}

   /* @author :Smita
    * @function use : fetchflightDiscountUser function fetch user and fligh assign to discount
    * @date : 5-2-2018 
    */
	public function fetchflightDiscountUser(){
		
		$this->db->select('lud.travel_id, lud.user_id, lud.coupon_code, lud.coupon_generated_date, lud.coupon_exp_date,lud.use_copone_status,cibd.flight_name,lud.use_copone_status, IFNULL( u.first_name,  "N/A" ) AS first_name, IFNULL( u.last_name,  "N/A") AS last_name,u.users_email');
		$this->db->from(LOYALTY_USER_DISCOUNT.' as lud');
		$this->db->join(USERS. ' as u', 'u.user_id = lud.user_id', 'inner');
		$this->db->join(CUST_INFO_BOOKING_DETAILS. ' as cibd', 'cibd.flight_no = lud.travel_id', 'inner');
		$this->db->where('lud.travel_type', '0');
		 $this->db->group_by('cibd.flight_name'); 
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$result = $query->result();
		return $result;
	}


	public function fetchCustomerbyEmailId($emailID){

		$this->db->select("*");
		$this->db->from(CUSTOMER_DETAILS);
		$this->db->where('cust_email_id', $emailID);
		$query = $this->db->get();
		$result = $query->result();
		return $result;

	}


	public function fetchCustomerbyId($cust_id){
		$this->db->select("*");
		$this->db->from(CUSTOMER_DETAILS);
		$this->db->where('id', $cust_id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function fetch_customer($limit, $start){
		$this->db->select("*");
		$this->db->from(CUSTOMER_DETAILS);
		$this->db->limit($limit, $start);
	    $query = $this->db->get();

	    $result = $query->result();
		return $result;
	}
}

/* End of file user_model.php */
/* Location: ./application/model/user_model.php */
