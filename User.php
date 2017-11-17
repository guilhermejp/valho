<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct(){
		parent::__construct();
        $this->load->model('Users_model');
        $this->db->cache_off();
    }

	public function index()
	{

		$data = array();
        
        if($this->input->post()){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->Users_model->get_by(array('username' => $username, 'password' => sha1(md5($password))));
            if($user){
                $this->user_session->create_session($user);
                redirect('admin');
            }else{
                $this->user_session->create_session(null);
                $this->session->set_flashdata('login_feedback', array(
                    'message' => 'Usuário e/ou senha inválidos.',
                    'type' => 'danger'
                ));
            }
        }
        
		$this->load->view('login', $data);

	}
    
    function logout(){
        $this->user_session->create_session(null);
        redirect('user');
    }

}
