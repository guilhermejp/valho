<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimony extends CI_Controller {

    public function __construct(){
		    parent::__construct();
        $this->load->model('Testimonials_model');
        $this->load->helper('file');
        $this->db->cache_off();
    }

	public function index()
	{

        $this->user_session->forcelogin();

        $data = array();

        if($this->input->post()){
            $launch_remove = $this->input->post('launch-remove');
            if(!empty($launch_remove)){
                $id = $this->input->post('id');
                $this->Testimonials_model->update($id, array('status' => 2));
            }
            $position = $this->input->post('position');
            foreach($position as $i=>$positionitem){
                $this->Testimonials_model->update($positionitem, array('position' => ($i+1)));
            }
        }

        $this->db->order_by('position asc');
        $testimonials = $this->Testimonials_model->get_many_by(array('status' => 1));
        $data['testimonials'] = $testimonials;

        $this->load->view('template/admin/header', $data);
        $this->load->view('testimony/list', $data);
        $this->load->view('template/admin/footer', $data);

	}

    function order(){
        $id = $this->input->get('id');
        if(!empty($id) && is_array($id)){
            foreach($id as $i=>$iditem){
                $this->Informatives_model->update($iditem, array('position' => $i+1));
            }
        }
    }

    function manage(){

        $this->user_session->forcelogin();
        $id = $this->uri->segment(3);

      if($this->input->post()){
        $name = $this->input->post('name');
        $profission = $this->input->post('profission');
        $status = $this->input->post('status');
        $testimony = $this->input->post('testimony');

        $data_array = array(
          'name' => $name,
          'profission' => $profission,
          'status' => $status,
          'testimony' => $testimony
        );

        $redirect = FALSE;
        if(!empty($id)){
          $this->Testimonials_model->update($id, $data_array);
        }else{
          $id = $this->Testimonials_model->insert($data_array);
          $redirect = TRUE;
        }

        $config['upload_path'] = './assets/uploads/testimonials/';
        $config['allowed_types'] = 'jpg|jpeg|gif|png';
        $config['file_ext_tolower'] = TRUE;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if(!file_exists('./assets/uploads/testimonials/')){
          @mkdir('./assets/uploads/testimonials/');
        }

        $upload_array = array();
        $upload_error = array();
        if(!empty($_FILES['img']['tmp_name'])){
            $files = array();
            if(!$this->upload->do_upload('img')){
                $upload_error[] = $this->upload->display_errors();
            }else{
                $upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];
                $upload_array['img'] = $filename;
            }
        }
        if(count($upload_array) > 0){
            $this->Testimonials_model->update($id, $upload_array);
        }
        if(count($upload_error) > 0){
            $this->session->set_flashdata('testimonials_feedback', array(
                'message' => implode(', ', $upload_error),
                'type' => 'danger'
            ));
        }else{
            $this->session->set_flashdata('testimonials_feedback', array(
                'message' => 'Alterado com sucesso.',
                'type' => 'success'
            ));
        }
        if($redirect){
            redirect('testimony/manage/'.$id);
        }
      }

      $testimonials = $this->Testimonials_model->get($id);
      $data['testimonials'] = $testimonials;

      $this->load->view('template/admin/header', $data);
      $this->load->view('testimony/manage', $data);
      $this->load->view('template/admin/footer', $data);
    }

}
