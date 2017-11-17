<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Send extends CI_Controller {
    
    public function __construct(){
		parent::__construct();
		$this->load->library('email');
    }

	public function index()
	{
		$r = $this->input->get('ru');
		
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$mobile = $this->input->post('mobile');
		$message = $this->input->post('message');
				
		$body  ='Nome: '.$name.'<br>'.
				'Email: '.$email.'<br>'.
				'Telefone: '.$phone.'<br>'.
				'Celular: '.$mobile.'<br>'.
				'Mensagem: '.$message;

/* TODO: ALTERAR PARA VALHO*/
		$this->email->from('guilherme@gcoder.com.br', 'GUILHERME');
		$this->email->to('guilhermejp@gmail.com');
		$this->email->subject('Contato via Site');
		$this->email->message(utf8_decode($body));
		$this->email->send();
				
		if(!empty($r)){
			redirect($r);
		}

	}

}
