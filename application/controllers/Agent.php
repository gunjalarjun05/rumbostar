<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agent extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    public function agentRegister() {
         if(is_front_session_set() == true){
         redirect("/");exit;
        } 
        if($this->input->post('regsubmit') == "Register"){
             $this->form_validation->set_rules('first_name', 'first_name', 'required');
            $this->form_validation->set_rules('last_name', 'last_name', 'required');
            //$this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique['.USERS.'.users_email]');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
            $this->form_validation->set_rules('conpassword', 'conpassword', 'required|matches[password]');
            $this->form_validation->set_rules('countries', 'countries', 'required');
            $this->form_validation->set_rules('number', 'number', 'required|numeric|min_length[10]|max_length[14]');
            if ($this->form_validation->run()){
                $first_name=$this->input->post('first_name');
                $last_name=$this->input->post('last_name');
                $country_code=$this->input->post('countries');
                //$name=$this->input->post('name');
                $email=$this->input->post('email');
                $password=$this->input->post('password');
                $number=$this->input->post('number');
                $my_referral_code = uniqid(); //$this->input->post('referral_code');
                $newpass=md5($password);
                $verificationCode=get_random_string(); 
                $user_updated_date=date("Y-m-d H:i:s");

                $data= array('first_name'=>$first_name,'last_name'=>$last_name,'users_name' => $first_name,'users_email' => $email,'users_psw'=> $newpass,'country_code'=>$country_code,'users_num'=> $number,'users_verification_code'=>$verificationCode,'users_updated_date'=>$user_updated_date,'users_type'=>'AGENT','my_referral_code'=>$my_referral_code);
                
                if($this->master_db->insert(USERS,$data)){
                   /* $link=site_url().'user-verification/'.encode_string($verificationCode);
                    $msgbody=str_replace("%USER_NAME%", $first_name, USER_BODY);
                    $msgbody=str_replace("%LINK%", $link, $msgbody);

                    send_email($email,USER_REG_SUBJECT,$msgbody);*/
                    $msgArr = array(
                        "status"=>"success",
                        "msg"=>"Thank you. Agent registered successfully with rumbostar.Admin will contact you Soon."
                        );
                    $this->session->set_flashdata($msgArr);
                    redirect('agent-register');
                }     
            }
        }
        $this->load->library('template');
        $data = array();

         //sk added following 2 line for show country code in dropbox 21-12-2017
        $countriesdata = $this->master_db->select('*',COUNTRIES);        
        $data['countrries_codedata'] = $countriesdata;

        $this->template->write('title', 'Agent register');
        //$this->template->write('headerCss',$css);
        $this->template->write_view('header', 'includes/header', $data, TRUE);
        $this->template->write_view('content', AGENT_VIEWS.'agent_register', $data, TRUE);
        $this->template->write_view('footer', 'includes/footer', '', TRUE);
        $this->template->render();  
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */
