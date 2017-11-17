<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_session {

    var $CI;
    var $logged = FALSE;

    public function __construct(){

        $this->CI =& get_instance();

        $userid_session = $this->CI->session->userdata('user_id');
        if(!empty($userid_session)){
            $this->logged = TRUE;
        }else{
            $this->logged = FALSE;
        }

    }

    function forceLogin(){
        if(!$this->isLogged()){
            redirect('admin/login');
        }
    }

    function isLogged(){
        if($this->logged == TRUE){
            return TRUE;
        }
        return FALSE;
    }

    function create_session($user){

        if($user){

            $this->CI->session->set_userdata($user);

        }else{

            $this->CI->session->sess_destroy();

        }

    }
}