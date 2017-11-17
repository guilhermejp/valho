<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place extends CI_Controller {

    public function __construct(){
		    parent::__construct();
        $this->load->model('Places_model');
        $this->load->helper('file');
        $this->db->cache_off();
    }

	public function index()
	{
		$this->load->helper('url');
        $this->user_session->forcelogin();

        if($this->input->post()){
            $launch_remove = $this->input->post('launch-remove');
            if(!empty($launch_remove)){
                $id = $this->input->post('id');
                $this->Places_model->update($id, array('status' => 2));
            }
        }

        $data = array();
        $places = $this->Places_model->get_many_by(array('status' => 1));
        $data['places'] = $places;

        $this->load->view('template/admin/header', $data);
        $this->load->view('place/list', $data);
        $this->load->view('template/admin/footer', $data);

	}

    
  public function view($id=""){

    $this->user_session->forcelogin();

    $testimonials = $this->Contacts_model->get($id);
    $data['contacts'] = $contacts;

    $this->load->view('template/admin/header', $data);
    $this->load->view('contact/manage', $data);
    $this->load->view('template/admin/footer', $data);

  }


    function manage(){

        $this->user_session->forcelogin();
        $id = $this->uri->segment(3);
        $redirect = FALSE;     

      if($this->input->post()){
        $name = $this->input->post('name');

        $data_array = array('place'=> $name,
                            'status'=> 1);

        if(!empty($id)){
          $this->Places_model->update($id, $data_array);
        }else{
          $id = $this->Places_model->insert($data_array);
        }

        $redirect = TRUE;     
      }

      $places = $this->Places_model->get($id);
      $data['places'] = $places;

      if($redirect){
        redirect("place/");
      }

      $this->load->view('template/header', $data);
      $this->load->view('place/manage', $data);
      $this->load->view('template/footer', $data);
    }

}
