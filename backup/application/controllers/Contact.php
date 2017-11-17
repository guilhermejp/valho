<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct(){
		    parent::__construct();
        $this->load->model('Contacts_model');
        $this->load->helper('file');
        $this->db->cache_off();
    }

	public function index()
	{

        $this->user_session->forcelogin();

        $data = array();
        $this->Contacts_model->order_by('datetime', 'DESC');
        $contacts = $this->Contacts_model->get_all();
        $data['contacts'] = $contacts;

        $this->load->view('template/admin/header', $data);
        $this->load->view('contact/list', $data);
        $this->load->view('template/admin/footer', $data);

	}

    public function insert(){

      if($this->input->post()){
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $mobile = $this->input->post('mobile');
        $message = $this->input->post('message');

        $data_array = array(
          'name' => $name,
          'email' => $email,
          'phone' => $phone,
          'mobile' => $mobile,
          'message' => $message
        );

        $id = $this->Contacts_model->insert($data_array);

      }

      redirect('send?ru=fale_conosco#enviado-venda-sucesso');

    }


    public function view($id=""){

      $this->user_session->forcelogin();

      $testimonials = $this->Contacts_model->get($id);
      $data['contacts'] = $contacts;

      $this->load->view('template/admin/header', $data);
      $this->load->view('contact/manage', $data);
      $this->load->view('template/admin/footer', $data);
    }

}
