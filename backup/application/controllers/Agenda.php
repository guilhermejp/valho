<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

    public function __construct(){
		    parent::__construct();
        $this->load->model('Agenda_model');
        $this->load->model('Brand_model');
        $this->load->model('Model_model');
        $this->load->model('Version_model');
        $this->load->helper('file');
        $this->db->cache_off();
    }

	public function index()
	{

        $this->user_session->forcelogin();

        $data = array();

        $result = $this->Agenda_model->db->query("SELECT a.*, b.name as brand_name, m.name as model_name, v.name as version_name, p.place as place_name from agendas as a
                                                LEFT JOIN brands as b ON a.brand = b.id
                                                LEFT JOIN models as m ON a.model = m.id 
                                                LEFT JOIN versions as v ON a.version = v.fipe_code
                                                LEFT JOIN places as p ON a.place = p.id
                                                GROUP BY a.id
                                                ORDER BY a.datetime DESC")->result();

        $data['agenda'] = $result;

        $this->load->view('template/admin/header', $data);
        $this->load->view('agenda/list', $data);
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
