<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_session {

    var $CI;
    var $logged = FALSE;

    public function __construct(){
        $this->CI =& get_instance();
        $user_id = $this->CI->session->userdata('user_id');
        if(!empty($user_id)){
            $this->logged = TRUE;
        }else{
            $this->logged = FALSE;
        }
        $uri_string = uri_string();
        if(strpos($uri_string, 'ticket') === FALSE){
            $query_string = isset($_SERVER['query_string'])?'?'.$_SERVER['query_string']:'';
            $this->CI->session->set_userdata('ticket_url', base_url(uri_string()).$query_string);
        }
    }

    function isLogged($location='admin'){
        $session_location = $this->CI->session->userdata('session_location');
        if(empty($session_location) || $session_location != $location){
            return FALSE;
        }
        return $this->logged;
    }

    function create_session($user = null, $location='admin'){
        if($user == null){
            $this->CI->session->sess_destroy();
        }else{
            $user_session = get_object_vars($user);
            $user_session['session_location'] = $location;
            if($location == 'admin'){
                $user_session['user_id'] = $user->id;
            }else{
                $user_session['user_id'] = $user->clients->id;
                $user_session['property_id'] = $user->id;
            }
            $this->CI->session->set_userdata($user_session);
        }
    }

    function forcelogin($location='admin'){
		$page = $this->CI->uri->segment(1);
		if($page != 'send'){
			if(!$this->isLogged($location)){
				if($location == 'admin'){
					redirect('user');
				}else{
					redirect('area-do-cliente/login');
				}
			}
		}
    }

}
