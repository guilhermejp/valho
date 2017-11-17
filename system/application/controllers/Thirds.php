<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thirds extends CI_Controller {

    public function __construct(){
		    parent::__construct();
        $this->load->model('Thirds_model');
        $this->load->model('Thirds_media_model');
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
                $this->Thirds_model->update($id, array('status' => 2));
            }
            $position = $this->input->post('position');
            if(!empty($position)){
              foreach($position as $i=>$positionitem){
                  $this->Thirds_model->update($positionitem, array('position' => ($i+1)));
              }
            }
        }

        $this->db->order_by('position asc');
        $thirds = $this->Thirds_model->get_many_by(array('status' => 1));
        //$thirds = buildrelease($thirds);
        $data['thirds'] = $thirds;

        $this->load->view('template/header', $data);
        $this->load->view('thirds/list', $data);
        $this->load->view('template/footer', $data);

	}

    function order(){
        $id = $this->input->get('id');
        if(!empty($id) && is_array($id)){
            foreach($id as $i=>$iditem){
                $this->Thirds_model->update($iditem, array('position' => $i+1));
            }
        }
    }

    function manage(){

        $this->user_session->forcelogin();
        $id = $this->uri->segment(3);

      if($this->input->post()){
        $neighborhood = $this->input->post('neighborhood');
        $description = $this->input->post('description');
        $status = $this->input->post('status');
        $price = $this->input->post('value');
        if(!empty($price)){
            $price = str_replace(array('.', ','), array('', '.'), $price);
        }
    
        $description = preg_replace("/\r\n|\r|\n/",'<br/>', $description);

        $launch_array = array(
          'neighborhood' => $neighborhood,
          'description' => $description,
          'status' => $status,
          'price' => $price
        );

        $redirect = FALSE;
        if(!empty($id)){
          $this->Thirds_model->update($id, $launch_array);
        }else{
          $id = $this->Thirds_model->insert($launch_array);
          $redirect = TRUE;
        }

        $this->session->set_flashdata('launch_feedback', array(
            'message' => 'Alterado com sucesso.',
            'type' => 'success'
        ));

        if($redirect){
            redirect('thirds/manage/'.$id);
        }
      }

      $thirds = $this->Thirds_model->get($id);
      $data['thirds'] = $thirds;

      $this->load->view('template/header', $data);
      $this->load->view('thirds/manage', $data);
      $this->load->view('template/footer', $data);
    }

    function upload(){
        $id = $this->input->post('id');
        $type = $this->input->post('type');

        if(!$this->input->is_ajax_request()){
            $position = $this->input->post('position');
            if(!empty($position) && is_array($position)){
                foreach($position as $i=>$positionitem){
                    $this->Thirds_media_model->update($positionitem, array('position' => ($i+1)));
                }
                redirect('thirds/manage/'.$id);
            }
        }

        //if(!empty($_FILES[$type]['tmp_name'])){

          if(!file_exists(FCPATH.'assets/uploads/thirds/')){
            @mkdir(FCPATH.'assets/uploads/thirds/');
          }
          if(!file_exists(FCPATH.'assets/uploads/thirds/'.$id.'/')){
            @mkdir(FCPATH.'assets/uploads/thirds/'.$id.'/');
          }

          $base_upload_path = base_url('assets/uploads/thirds/'.$id.'/');
          $config['upload_path'] = FCPATH.'assets/uploads/thirds/'.$id.'/';
          $config['allowed_types'] = 'jpg|jpeg|gif|png';
          $config['file_ext_tolower'] = TRUE;
          $config['encrypt_name'] = TRUE;

          $this->load->library('upload', $config);

          $files = array();
          if(!$this->upload->do_upload($type)){
            $existingFiles = @get_dir_file_info($config['upload_path']);

            $f = 0;

            if($existingFiles){
                foreach ($existingFiles as $fileName => $info) {
                  if(strpos($fileName, 'thumb_') === FALSE){
                    //Skip over thumbs directory
                    //set the data for the json array

                    $photo = $this->Thirds_media_model->get_by(array('thirds_id' => $id, 'img' => $fileName, 'type' => $type == 'photos'?1:2));
                    if($photo){
                        $files[$f]['position'] = $photo->position;
                        $files[$f]['id'] = $photo->id;
                        $files[$f]['name'] = $fileName;
                        $files[$f]['size'] = $info['size'];
                        $files[$f]['url'] = $base_upload_path.'/'.$fileName;
                        $files[$f]['thumbnailUrl'] = $base_upload_path.'/'.$fileName;
                        $files[$f]['deleteUrl'] = base_url('thirds/mediadelete').'?id='.$photo->id.'&rid='.$id;
                        $files[$f]['deleteType'] = 'DELETE';
                        $files[$f]['error'] = null;

                        $f++;
                    }
                  }
                }
                usort($files, function($a, $b){
                    return ($a['position'] > $b['position'])?1:-1;
                });
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('files' => $files)));
          }else{
                $upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];
                $photo_id = $this->Thirds_media_model->insert(array(
                  'img' => $filename,
                  'type' => $type == 'photos'?1:2,
                  'status' => 1,
                  'thirds_id' => $id
                ));

                $info = new StdClass;
                $info->id = $photo_id;
                $info->name = $upload_data['file_name'];
                $info->size = $upload_data['file_size'] * 1024;
                $info->type = $upload_data['file_type'];
                $info->url = $base_upload_path.'/'.$filename;

                $this->db->limit('position DESC');
                $photo = $this->Thirds_media_model->get_by(array(
                  'type' => $type == 'photos'?1:2,
                  'thirds_id' => $id
                ));

                $info->thumbnailUrl = $base_upload_path.'/'.$filename;
                $info->deleteUrl = base_url('thirds/mediadelete').'?id='.$photo_id.'&rid='.$id;
                $info->deleteType = 'DELETE';
                $info->error = null;
                $info->position = $photo->position+1;
                $files[] = $info;

                if ($this->input->is_ajax_request()) {
                    echo json_encode(array("files" => $files));
                }
            }
        //}
    }

    function mediadelete(){
    	$response = array();
        if($this->user_session->isLogged()){
            $id = $this->input->get('id');
            $rid = $this->input->get('rid');

            if(!empty($id) && !empty($rid)){
            	$photo = $this->Thirds_media_model->get_by(array('id' => $id, 'thirds_id' => $rid));
            	if($photo){
	                $deleted = $this->Thirds_media_model->delete_by(array('id' => $id, 'thirds_id' => $rid));
	                if($deleted){
	                    @unlink(FCPATH.'assets/uploads/thirds/'.$rid.'/'.$photo->img);
	                    $response[$photo->img] = $deleted;
	                }else{
	                	$response[$photo->img] = $deleted;
	            	}
	            }
            }
        }
        echo json_encode($response);
    }
}
