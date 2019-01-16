<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct(){
		parent:: __construct();
	}
	public function insert($table,$dataArr)
	{
		return 1;
	}
	public function update($dataArr,$id){
		$this->db->where('user_id',$id);
		return $this->db->update(USERS,$dataArr);
	}
	public function check_user($emailid,$password){
		$this->db->select('*');
		$this->db->from(USERS);
		$this->db->where('users_email',$emailid);
		$this->db->where('users_psw',md5($password));
		$this->db->where_in('users_type',array('ADMIN'));
		$this->db->where('users_status','ACTIVE');
		$this->db->where('is_verified','1');
		$query1 = $this->db->get();
		$userRes = $query1->result();
		//echo $this->db->last_query();die;
		if(count($userRes)>0){ 
				$newdata = array(
                   ADMIN_SESSION.'userid'	  => $userRes[0]->user_id,
                   ADMIN_SESSION.'fullname'  => $userRes[0]->users_name,
                   ADMIN_SESSION.'email'     => $userRes[0]->users_email,
                   ADMIN_SESSION.'mobileno'     => $userRes[0]->users_num,
                   ADMIN_SESSION.'user_type' => $userRes[0]->users_type,
                   ADMIN_SESSION.'updated_date' => $userRes[0]->users_updated_date,
                   ADMIN_SESSION.'is_logged_in' => TRUE
               );

				$this->session->set_userdata($newdata);
				return 1;
		}else{
				return 0;
		}
	}
	public function check_user_front($emailid,$password){
		
		$this->db->select('*');
		$this->db->from(USERS);
		$this->db->where('users_email',$emailid);
		$this->db->where('users_psw',md5($password));
		$this->db->where_in('users_type',array('USER','AGENT')); 
		//$this->db->where('status','1');
		//$this->db->where('is_verified','1');
		$query1 = $this->db->get();
		$userRes = $query1->result();
		//echo $this->db->last_query();die
		//echo '<pre>'; print_r($userRes);die;
		//$agentId = ($userRes[0]->agent_id !='')?$userRes->agent_id:'';

		if(count($userRes)>0){ 
			if($userRes[0]->is_verified != 1 || $userRes[0]->users_status == 'DACTIVE'){
					return $userRes;
			}
				$newdata = array(
                   USER_SESSION.'user_id'	  => $userRes[0]->user_id,
                   USER_SESSION.'name'  => $userRes[0]->users_name,         
                   USER_SESSION.'emailid'  => $userRes[0]->users_email,           
                   USER_SESSION.'contact_no'     => $userRes[0]->users_num,  
                   USER_SESSION.'country_code' => $userRes[0]->country_code,               
                   USER_SESSION.'user_type' => $userRes[0]->users_type,
                   USER_SESSION.'my_referral_code' => $userRes[0]->my_referral_code,
                   USER_SESSION.'agent_id'=>$userRes[0]->agent_id,
                   USER_SESSION.'updated_date' => $userRes[0]->users_updated_date,
                   USER_SESSION.'is_logged_in' => TRUE
               );

				$this->session->set_userdata($newdata);
				return 1;
		}else{
				return 0;
		}
	}
	
	//update user password in admin table
	public function update_password($dataArr){
			$this->db->where('user_id',$this->session->userdata(ADMIN_SESSION.'userid'));
			return $this->db->update(USERS,$dataArr);		
			
	}

        //update user password in user table
	public function update_passworduser($dataArr){
			$this->db->where('user_id',$this->session->userdata(USER_SESSION.'user_id'));
			return $this->db->update(USERS,$dataArr);		
			
	}  
    
	//function for user information using sesstion id
	
	public function get_userinfo(){
			$this->db->select('*');
			$this->db->from(USERS);
			$this->db->where('user_id',$this->session->userdata(ADMIN_SESSION.'userid'));
			$query = $this->db->get();
			return $query->result();
	}

        //function for user information using sesstion id
	
	public function get_userinfop(){
			$this->db->select('u.*, con.sortname');
			$this->db->from(USERS.' as u');
			$this->db->join(COUNTRIES.' as con',"con.country_code = u.country_code","left" );
			$this->db->where('u.user_id',$this->session->userdata(USER_SESSION.'user_id'));
			$query = $this->db->get();
			return $query->result();
	}
	
	/* @author : smita
	 * @function use : get_userinfobyId use for fetch my profile data for view
	 * @date : 22-12-2017
	*/
	public function get_userinfobyId(){

			$this->db->select('u.*, cd.card_type');
			$this->db->from(USERS.' as u');
			$this->db->join(CARDS.' as cd',"cd.code = u.card_id","LEFT" );
			$this->db->where('user_id',$this->session->userdata(USER_SESSION.'user_id'));
			$query = $this->db->get();
			//echo $this->db->last_query();die;
			return $query->result();
	}



	//function for update profile information for admin user
	
	public function update_info($updateArr){
		$this->db->where('user_id',$this->session->userdata(ADMIN_SESSION.'userid'));
		$rec = $this->db->update(USERS,$updateArr);
		if($rec){
		
				$newdata = array(
                   ADMIN_SESSION.'fullname'  => $this->input->post('username'),
                   ADMIN_SESSION.'mobileno'     => $this->input->post('mobileno'),
               );

				$this->session->set_userdata($newdata);
				return 1;
		}
	}
	
      //function for update user profile information 
	public function updateuser_info($updateArr){ 
		$this->db->where('user_id',$this->session->userdata(USER_SESSION.'user_id'));
		$rec = $this->db->update(USERS,$updateArr);
		//echo $this->db->last_query(); die;
		if($rec){
		
				$newdata = array(
                   USER_SESSION.'name'  => $updateArr['users_name'],         
                   USER_SESSION.'emailid'  => $updateArr['users_email'],         
                   USER_SESSION.'contact_no'     => $updateArr['users_num'],                  
                   USER_SESSION.'updated_date' => $updateArr['users_updated_date'],
               );

				$this->session->set_userdata($newdata);
				return 1;
		}
	}
	 
	
	
	//function for check old password
	public function check_old_pass($password,$userid){
			$this->db->select('*');
			$this->db->from(USERS);
			$this->db->where('user_id',$userid);
			$this->db->where('users_psw',md5($password));
			$query = $this->db->get();
			$recs = $query->result();
			if(count($recs)>0){
				return 1;
			}else{
					return 0;
			}
	}
	
	//function for emailid exits or not for emailid
	
	public function check_user_email($emailid){
			$this->db->select('*');
			$this->db->from(USERS);
			$this->db->where('users_email',$emailid);
			$query = $this->db->get();
			$recs = $query->result();
			if(count($recs)>0){
				//return 1;
				return $recs;
			}else{
					return 0;
			}
	}
	
	
	public function set_user_sesssion($userData){
		//print_r($userData);exit;
		if($userData['users_from'] == 'facebook'){
			
			$newdata = array(
	           USER_SESSION.'user_id' => $userData['user_id'],
	           USER_SESSION.'name'  => $userData['users_name'],         
	           USER_SESSION.'emailid'  => $userData['users_email'],           
	          // USER_SESSION.'contact_no'     => $userData['users_num'],                  
	           USER_SESSION.'user_type' => $userData['users_type'],
	           USER_SESSION.'user_from' => $userData['users_from'],
	          // USER_SESSION.'updated_date' => $userData['users_updated_date'],
	           USER_SESSION.'is_logged_in' => TRUE
       		);
		}else{

			if(isset($userData['country_code']) != NULL) {
				$countryCode = $userData['country_code'];
			} else {
				$countryCode = 0;
			}

			$newdata = array(
	           USER_SESSION.'user_id'	  => $userData['user_id'],
	           USER_SESSION.'name'  => $userData['users_name'],         
	           USER_SESSION.'emailid'  => $userData['users_email'],           
	           USER_SESSION.'contact_no'     => $userData['users_num'],          
	           USER_SESSION.'country_code' => $countryCode,       
	           USER_SESSION.'user_type' => $userData['users_type'],
	           USER_SESSION.'user_from' => $userData['users_from'],
	          // USER_SESSION.'my_referral_code' => $userData['my_referral_code'],
	           USER_SESSION.'updated_date' => $userData['users_updated_date'],
	           USER_SESSION.'is_logged_in' => TRUE
       		);
		}
		//print_r($newdata);exit;

		$this->session->set_userdata($newdata);
		return 1;
	}


	
	
	//functio for unset sesstion 
	public function unset_user_session($session){
		$array_items = array($session.'user_id', $session.'name',$session.'emailid',$session.'contact_no',$session.'user_type',$session.'updated_date',$session.'is_logged_in');
		//$this->session->unset_userdata($array_items);
		$this->session->sess_destroy();
	}
	
	
	
}

/* End of file user_model.php */
/* Location: ./application/model/user_model.php */
