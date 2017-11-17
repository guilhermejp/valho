<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {

    public function __construct(){
		    parent::__construct();
        $this->load->model('Banners_model');
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
                $this->Banners_model->update($id, array('status' => 2));
            }
            $position = $this->input->post('position');
            foreach($position as $i=>$positionitem){
                $this->Banners_model->update($positionitem, array('position' => ($i+1)));
            }
        }

        $this->db->order_by('position asc');
        $banners = $this->Banners_model->get_many_by(array('status' => 1));
        $data['banners'] = $banners;

        $this->load->view('template/header', $data);
        $this->load->view('banners/list', $data);
        $this->load->view('template/footer', $data);

	}

    function order(){
        $id = $this->input->get('id');
        if(!empty($id) && is_array($id)){
            foreach($id as $i=>$iditem){
                $this->Banners_model->update($iditem, array('position' => $i+1));
            }
        }
    }

    function manage(){

        $this->user_session->forcelogin();
        $id = $this->uri->segment(3);

      if($this->input->post()){
        $title = $this->input->post('title');
		$subtitle = $this->input->post('subtitle');
        $url = $this->input->post('url');
        $begin_date = $this->input->post('begin_date');
        if(!empty($begin_date)){
            $begin_date = str_replace(array('/'), array('.'), $begin_date);
            $begin_date = date('Y-m-d H:i', strtotime($begin_date));
        }else{
            $begin_date = null;
        }
        $end_date = $this->input->post('end_date');
        if(!empty($end_date)){
            $end_date = str_replace(array('/'), array('.'), $end_date);
            $end_date = date('Y-m-d H:i', strtotime($end_date));
        }else{
            $end_date = null;
        }
        $new_window = $this->input->post('new_window');
        $status = $this->input->post('status');

        $data_array = array(
          'title' => $title,
		  'subtitle' => $subtitle,
          'url' => $url,
          'begin_date' => $begin_date,
          'end_date' => $end_date,
          'new_window' => $new_window,
          'status' => $status,
        );

        $redirect = FALSE;
        if(!empty($id)){
          $this->Banners_model->update($id, $data_array);
        }else{
          $id = $this->Banners_model->insert($data_array);
          $redirect = TRUE;
        }

        $config['upload_path'] = './assets/uploads/banners/';
        $config['allowed_types'] = 'jpg|jpeg|gif|png';
        $config['file_ext_tolower'] = TRUE;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if(!file_exists('./assets/uploads/banners/')){
          @mkdir('./assets/uploads/banners/');
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
            $this->Banners_model->update($id, $upload_array);
        }
        if(count($upload_error) > 0){
            $this->session->set_flashdata('banner_feedback', array(
                'message' => implode(', ', $upload_error),
                'type' => 'danger'
            ));
        }else{
            $this->session->set_flashdata('banner_feedback', array(
                'message' => 'Alterado com sucesso.',
                'type' => 'success'
            ));
        }
        if($redirect){
            redirect('banner/manage/'.$id);
        }
      }

      $banner = $this->Banners_model->get($id);
      $data['banner'] = $banner;

      $this->load->view('template/header', $data);
      $this->load->view('banners/manage', $data);
      $this->load->view('template/footer', $data);
    }

}
