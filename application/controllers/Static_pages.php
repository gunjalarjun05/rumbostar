<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_pages extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function contactus(){
		//print_r($this->input->post());exit;
		if($this->input->post('regsubmit') == 'Submit'){ 
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'name', 'trim|required');
			$this->form_validation->set_rules('email', 'email ID', 'trim|required');
			$this->form_validation->set_rules('contactno', 'mobile number', 'trim|required');
			$this->form_validation->set_rules('subject', 'subject', 'trim|required');
			$this->form_validation->set_rules('message', 'message', 'trim|required');			
			if ($this->form_validation->run() == true){ 
				$adminMailData = array();
				$subject = $this->input->post('subject');
				$adminMailData['welcomemsg'] = 'Hi Rumbostar Admin,<br/>You have message from '.$this->input->post('name').'<br/>';
				$adminMailData['mailInfoKey'] = array(
													'Name' => $this->input->post('name'),
													'Email_ID'=>$this->input->post('email'),
													"Contact_Number"=>$this->input->post('contactno'),
													"Message"=>$this->input->post('message')
												);
				$adminMailBody = $this->load->view('mail-template/email-temp-new',$adminMailData,TRUE);

				$sendMail = send_email(ADMIN_MAIL,$subject,$adminMailBody);

				if($sendMail){
					$status ="success";
					$msg="Your message has been successfully sent. We will contact you very soon!";
				}else{
					$status ="error";
					$msg = "Oops! error. Please try again.";
				}
				$msgArr = array(
						'msg'=>$msg,
						'msg_type'=>$status
					);
				$this->session->set_flashdata($msgArr);
				redirect('contact-us');exit;
			}else{
				//echo validation_errors();die;
			}
		}

		$this->load->library('template');
		$data = array();
		$this->template->write('title','Rumbostar | Contact Us');
		$this->template->write_view('header','includes/header', $data, TRUE);
        $this->template->write_view('content','contact-us', $data, TRUE);
        $this->template->write_view('footer','includes/footer', '', TRUE);
        $this->template->render();
		//$this->load->view('welcome_message');
	}
	public function faqs(){
		//$config['front_template'] = default_front;
		$this->load->library('template');
		$data = array();
		$this->template->write('title','InspireME Global | FAQs');
		$this->template->write_view('header','includes/header', $data, TRUE);
        $this->template->write_view('content','faqs', $data, TRUE);
        $this->template->write_view('footer','includes/footer', '', TRUE);
        $this->template->render();
		//$this->load->view('welcome_message');
	}
	public function ourservice(){
		$this->load->library('template');
		$data = array();
		$this->template->write('title','InspireME Global | Ourservice');
		$this->template->write_view('header','includes/header', $data, TRUE);
        $this->template->write_view('content','ourservice', $data, TRUE);
        $this->template->write_view('footer','includes/footer', '', TRUE);
        $this->template->render();
	}
	public function cancellation_policies(){
		$this->load->library('template');
		$data = array();
		$this->template->write('title','InspireME Global | Cancellation Policies');
		$this->template->write_view('header','includes/header', $data, TRUE);
        $this->template->write_view('content','cancellation-policies', $data, TRUE);
        $this->template->write_view('footer','includes/footer', '', TRUE);
        $this->template->render();
	}
	public function terms_and_conditions(){
		$this->load->library('template');
		$data = array();
		$this->template->write('title','InspireME Global | Terms and Conditions');
		$this->template->write_view('header','includes/header', $data, TRUE);
        $this->template->write_view('content','terms-and-conditions', $data, TRUE);
        $this->template->write_view('footer','includes/footer', '', TRUE);
        $this->template->render();
	}
	public function privacy_policy(){
		$this->load->library('template');
		$data = array();
		$this->template->write('title','InspireME Global | Privacy Policy');
		$this->template->write_view('header','includes/header', $data, TRUE);
        $this->template->write_view('content','privacy-policy', $data, TRUE);
        $this->template->write_view('footer','includes/footer', '', TRUE);
        $this->template->render();
	}
	public function about_inspireme(){

		$this->load->library('template');
		$data = array();
		$this->template->write('title','InspireME Global | Privacy Policy');
		$this->template->write_view('header','includes/header', $data, TRUE);
        $this->template->write_view('content','about-inspireme', $data, TRUE);
        $this->template->write_view('footer','includes/footer', '', TRUE);
        $this->template->render();
	}

	public function how_can_we_help(){
		$this->load->library('template');
		$data = array();

		if($this->input->post('help_submit') == 'help_submit'){ 
			$this->load->library('form_validation');
			/*$this->form_validation->set_rules('contactus_name', 'name', 'trim|required');
			$this->form_validation->set_rules('contactus_emailid', 'email ID', 'trim|required');
			$this->form_validation->set_rules('contactus_number', 'mobile number', 'trim|required');
			$this->form_validation->set_rules('contactus_subject', 'subject', 'trim|required');
			$this->form_validation->set_rules('contactus_message', 'message', 'trim|required');	*/		
			//if ($this->form_validation->run() == true){ 
				$adminMailData = array();
				
				$adminMailData['templateHeader'] = HOW_CAN_WE_HELP_SUB;
				if($this->input->post('help_contact_using')==1){
					$contactME = "Email";
				}else{
					$contactME = "Call";
				}
				if($this->input->post('help_flexible') == 1){
					$flexible = 'flexible';
				}else{
					$flexible = 'not flexible';
				}
				$adminMailData['welcomemsg'] = 'Hi InspireME Admin,<br/><br/> I am searching for accommodation in '.$this->input->post('help_city').'<br/><br/>';
				$adminMailData['mailInfoKey'] = array(
													'Accommodation_Type' => $this->input->post('help_acctype'),
													'Arrival_Date'=>$this->input->post('help_form'),
													"Departure_Date"=>$this->input->post('help_to'),
													"Location"=>$this->input->post('help_city'),
													"Appropriate_Budget"=>$this->input->post('help_currency')." ".$this->input->post('help_amount'),
													"Adults"=>$this->input->post('help_adults'),
													"Children"=>$this->input->post('help_childern'),
													"Toddlers"=>$this->input->post('help_toddlers'),
													"Babies"=>$this->input->post('help_babies'),
													"Message"=>$this->input->post('help_message'),
													"Email_Address"=>$this->input->post('help_email'),
													"Mobile_Number"=>$this->input->post('help_mobileno'),
													"Contact_Me"=>$contactME,
													"Dates_Are"=>$flexible											
												);
				$adminMailBody = $this->load->view('mail-template/email-temp-new',$adminMailData,TRUE);			
				$sendMail = send_email(ADMIN_BOOKING_MAIL,HOW_CAN_WE_HELP_SUB,$adminMailBody);
				//if($sendMail){
					$status ="success";
					$msg="Your message has been submited successfully. Admin will respond within 24 hr.";
				//}else{
				//	$status ="error";
				//	$msg = "Oops! error. Please try again.";
				//}
				$msgArr = array(
						'msg'=>$msg,
						'msg_type'=>$status
					);
				$this->session->set_flashdata($msgArr);
				redirect('how-can-we-help');exit;
			//}else{
			//	//echo validation_errors();die;
			//}
		}

		$data['catList'] = $this->master_db->select('catid,catname',CATEGORY,array('status'=>1));
		$data['cities'] = $this->master_db->select('city_id,city_name',CITY,'','',array('city_name'=>'ASC'));
		$this->template->write('title','InspireME Global | How can we help');
		$this->template->write_view('header','includes/header', $data, TRUE);
        $this->template->write_view('content','how-can-we-help', $data, TRUE);
        $this->template->write_view('footer','includes/footer', '', TRUE);
        $this->template->render();
	}
	
}

/* End of file Static_pages.php */
/* Location: ./application/controllers/Static_pages.php */
