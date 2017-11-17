<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

    public function __construct(){
		    parent::__construct();
        $this->load->model('Contents_model');
        $this->load->helper('file');
        $this->db->cache_off();
    }

	public function index($id="")
    {
        
      if(empty($id)){
        redirect('admin');
      }

      $this->user_session->forcelogin();

      if($this->input->post()){

        $data_array = array(
          'id' => $id,
          'content' => htmlentities($this->input->post('content')),
        );

        $this->Contents_model->update($id, $data_array);

      }

      $contents = $this->Contents_model->get($id);
      $contents->content = html_entity_decode($contents->content);
      $data['contents'] = $contents;

      $this->load->view('template/admin/header', $data);
      $this->load->view('content/manage', $data);
      $this->load->view('template/admin/footer', $data);

    }

}
