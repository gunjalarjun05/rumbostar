<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {


	function __construct() {
        parent::__construct();               
        $this->lang->load('message','english');       
    }

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index(){
		//$config['front_template'] = default_front;
		$this->load->library('template');
		$data = array();
		$this->template->write('title','Rumbostar');
		//echo '<pre>';
		//print_r($this->session->userdata());exit;
		$social_register = $this->master_db->select('*',USERS,array("user_id"=>$this->session->userdata(USER_SESSION.'user_id')));

		//print_r($social_register);exit;
		if(isset($social_register) && count($social_register)>0){
			$data['social_register'] = $social_register;
		}		
		
		//$this->template->write('headerCss',$css);
		$js = load_js(array('front/jquery.auto-complete.js','front/home.js'));
        $this->template->write('footerJs',$js);
         $css = load_css(array('front/jquery.auto-complete.css'));
        $this->template->write('headerCss',$css);        
		$this->template->write_view('header','includes/header', $data, TRUE);
	    $this->template->write_view('content','home', $data, TRUE);
	   	$this->template->write_view('footer','includes/footer', '', TRUE);
	    $this->template->render();
	}

	public function userdashbord(){
		//$config['front_template'] = default_front;
		$this->load->library('template');
		$data = array();
		$this->template->write('title','Rumbostar');
		//$this->template->write('headerCss',$css);
		$this->template->write_view('header','includes/header', $data, TRUE);
	    $this->template->write_view('content','user-dashboard', $data, TRUE);
	   	$this->template->write_view('footer','includes/footer', '', TRUE);
	    $this->template->render();
	}
	public function userprofile(){
		//$config['front_template'] = default_front;
		$this->load->library('template');
		$data = array();
		$this->template->write('title','Rumbostar');
		//$this->template->write('headerCss',$css);
		$this->template->write_view('header','includes/header', $data, TRUE);
	    $this->template->write_view('content','user-profile', $data, TRUE);
	   	$this->template->write_view('footer','includes/footer', '', TRUE);
	    $this->template->render();
	}

    function switchLang($language = "") {   
        $this->lang->load('message','english');  
        $language = ($language != "") ? $language : "english";         
        $this->session->set_userdata('site_lang', $language);     
        //echo $_SERVER['HTTP_REFERER'];exit;      
        redirect($_SERVER['HTTP_REFERER']);
        
    }



    public function currencyConverter() {    	

		$from_Currency = urlencode($_POST['fromcurr']);
		$to_Currency = urlencode($_POST['tocurr']);
		$amount = $_POST['amount'];		
		$get = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
		
		$get = explode("<span class=bld>",$get);
		$get = explode("</span>",$get[1]);
		$converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);
		//echo 'hiii';
		//echo $converted_currency;exit;		
		$this->session->set_userdata('to_Currency', $to_Currency);  
		echo json_encode($converted_currency);
		exit;
	}


 public function userTypeSession(){ 	
 	$this->load->library('session'); 	
	$this->session->set_userdata(array('social_user_type' => $_POST['user_type']));
	exit;
 }

	/* public function socialUserType(){ 

	 	$this->load->model('user_model','user');
        $dataArr['users_type'] = $_POST['user_type']; 

        $UpdateRec = $this->master_db->update(USERS,$dataArr,array("user_id"=>$_POST['user_id']));  

        if($UpdateRec == 1){
          $datas = 'success';
          $selectData = $this->master_db->select('*',USERS,array("user_id"=>$_POST['user_id'])); 

          if(isset($selectData) && $selectData[0]->users_email != '')
          {
          	$emailid = $selectData[0]->users_email;
          }else{
          	$emailid = '';
          }
        $setSessArr = array(												
					"user_id"=>$selectData[0]->user_id,
					"users_name"=>$selectData[0]->first_name." ".$selectData[0]->last_name,
					"users_email"=>$emailid,
					"users_num"=>$selectData[0]->users_num,
					"users_type"=>$selectData[0]->users_type,
					"users_from" =>$selectData[0]->user_from,
					"users_updated_date"=>$selectData[0]->users_updated_date	
				);
        //echo "<pre>";
        //  print_r($setSessArr);exit;
			$this->user->set_user_sesssion($setSessArr);

         echo  json_encode($datas);exit;
        }else{
            $datas = 'false';
          echo  json_encode($datas);exit;
        }      
    }*/


}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */
