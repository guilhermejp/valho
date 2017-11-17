<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Generic {

	var $CI;

	function __construct() {

		$this -> CI = &get_instance();
		$this->CI->load->model('Properties_model');
        $this->CI->load->model('Leads_model');

        $this->CI->session->set_userdata(array('gclid' => 1));
        /*$gclid = $this->CI->input->get('gclid');
        if(!empty($gclid)){
            $this->CI->session->set_userdata(array('gclid' => 1));
        }*/

        if($this->CI->input->post()){
            $contact_email = $this->CI->input->post('contact-email');
            $contact_call = $this->CI->input->post('contact-call');
            if(!empty($contact_email) || !empty($contact_call)){
                if(!empty($contact_email)){
                    $subject = 'Atendimento por email';
                }else{
                    $subject = 'Ligamos para você';
                }
                $name = $this->CI->input->post('name');
                $email = $this->CI->input->post('email');
                $phone = $this->CI->input->post('phone');
                $mobile = $this->CI->input->post('mobile');
                $message = $this->CI->input->post('message');

                $message .= '<br><br>URL origem: '.$this->CI->session->userdata('ticket_url');

                $contact_array = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'mobile' => $mobile,
                    'message' => $message,
                    'subject' => $subject,
                    'control_id' => 171
                );
                if($this->CI->Leads_model->insert($contact_array)){
                    $this->CI->session->set_flashdata(array(
                        'feedback' => array(
                            'type' => 'success',
                            'message' => 'Mensagem enviada com sucesso!'
                        )
                    ));
                }else{
                    $this->CI->session->set_flashdata(array(
                        'feedback' => array(
                            'type' => 'danger',
                            'message' => 'Sua mensagem não foi enviada. Tente novamente mais tarde.'
                        )
                    ));
                }

								redirect($this->CI->session->userdata('ticket_url').'?atendimento_enviado=1');
            }
        }

	}

	function getCategorias($where = null){
		$this->CI->db->distinct();
		$this->CI->db->select('type');
		$this->CI->db->order_by('type ASC');
        if($where != null){
			$this->CI->db->where($where);
		}
		return $this->CI->Properties_model->get_all();
	}

	function getCidades($where = null){
		$this->CI->db->distinct();
		$this->CI->db->select('city');
		$this->CI->db->order_by('city ASC');
		if($where != null){
			$this->CI->db->where($where);
		}
		return $this->CI->Properties_model->get_all();
	}

	function getBairros($where = null){

		if($where != null){
			$this->CI->db->distinct();
			$this->CI->db->select('neighborhood');
			$this->CI->db->order_by('neighborhood ASC');
			$this->CI->db->where($where);
			return $this->CI->Properties_model->get_all();
		}
		return FALSE;

	}

    function minifyqueue($type = 'js', $files = array()){
        $this->CI->minify->$type($files);
    }

}
