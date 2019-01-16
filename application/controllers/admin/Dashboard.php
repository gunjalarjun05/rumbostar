<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct(){
        parent:: __construct(); 
        $params = array('default_template' => 'admin_index');
        $this->load->library('template',$params);
        $this->load->library('form_validation');   
    }

    /**
    * Index Page for this controller.
    *
    */

    public function index(){
        $data = array();
        $userCount = $this->master_db->select('user_id',USERS,array("users_type"=>'USER'));
        $data['userCount'] = count($userCount);
        $agentCount = $this->master_db->select('user_id',USERS,array("users_type"=>'AGENT'));
        $data['agentCount'] = count($agentCount);
        $this->template->write('title', 'Dashboard');
        $this->template->write_view('header', ADMIN_VIEWS.'includes/header', $data, TRUE);
        $this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
        $this->template->write_view('content', ADMIN_VIEWS.'dashbord', $data, TRUE);
        $this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
        $this->template->render();  
    }

    public function profile(){
        $this->load->model('user_model','user');
        if($this->input->post('userinfo') == "profileupdate"){
      $this->form_validation->set_rules('username', 'username', 'required');
      $this->form_validation->set_rules('mobileno', 'mobileno', 'required|numeric|min_length[10]|max_length[10]');
            if ($this->form_validation->run()){
                $name=$this->input->post('username');
                $number=$this->input->post('mobileno'); 
                $user_updated_date=date("Y-m-d H:i:s");
                $data= array('users_name' => $name,'users_num'=> $number,'users_updated_date'=>$user_updated_date);
                $this->user->update_info($data);
                $msgArr = array(
                        "status"=>"success",
                        "msg"=>"User account details updated sucessfully."
                        );

                $this->session->set_flashdata($msgArr);
                redirect('admin/profile');
                }     
            }
        $data = array();
        $data['userinfo'] = $this->user->get_userinfo();
      //print_r($data['userinfo']);exit;
        $this->template->write('title', 'Profile');
        $this->template->write_view('header', ADMIN_VIEWS.'includes/header', $data, TRUE);
        $this->template->write_view('left_bar', ADMIN_VIEWS.'includes/left_bar', $data, TRUE);
        $this->template->write_view('content', ADMIN_VIEWS.'adminprofile', $data, TRUE);
        $this->template->write_view('footer', ADMIN_VIEWS.'includes/footer', '', TRUE);
        $this->template->render();  
    }

    public function change_password(){
        $this->load->model('user_model','user');
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = $dataheader = $datafooter = array();
        if(trim($_POST['hform']) == '1'){
            $oldpass = $_POST['oldpassword'];
            $newpass = $_POST['newpassword'];
            $oldPassRes = $this->user->check_old_pass($oldpass,$this->session->userdata(ADMIN_SESSION.'userid'));
            if($oldPassRes){    
                $dataArr = array(
                                    'users_psw'=>md5($newpass)
                                );
                $insRec = $this->user->update_password($dataArr);
                $msg = 'Password update successfully.';
                if($insRec){
                    $msg = $msg;
                    $msg_type = 'success';
                    $msgArr = array(
                                        'msg'=>$msg,
                                        'msg_type'=>$msg_type
                                    );
                    $this->session->set_flashdata($msgArr);
                }else{
                    $msg ='Opps! error please try agin.';
                    $msg_type = 'error';
                    $msgArr = array(
                                        'msg'=>$msg,
                                        'msg_type'=>$msg_type
                                    );
                    $this->session->set_flashdata($msgArr);
                }
            }else{
                $msg_type = 'error';
                $msg ='Old password not matched.';
            }
            echo json_encode(array("status"=>$msg_type,"msg"=>$msg));die;                   
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */
