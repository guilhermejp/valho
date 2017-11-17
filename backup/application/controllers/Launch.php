<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Launch extends CI_Controller {

    public function __construct(){
		    parent::__construct();
        $this->load->model('Releases_model');
        $this->load->model('Releases_media_model');
		$this->load->model('Work_placement_model');
        $this->load->helper('release_helper');
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
                $this->Releases_model->update($id, array('status' => 2));
            }
            $position = $this->input->post('position');
            foreach($position as $i=>$positionitem){
                $this->Releases_model->update($positionitem, array('position' => ($i+1)));
            }
        }

        $this->db->order_by('position asc');
        $launch = $this->Releases_model->get_many_by(array('status' => 1));
        $launch = buildrelease($launch);
        $data['launch'] = $launch;

        $this->load->view('template/header', $data);
        $this->load->view('launch/list', $data);
        $this->load->view('template/footer', $data);

	}

    function order(){
        $id = $this->input->get('id');
        if(!empty($id) && is_array($id)){
            foreach($id as $i=>$iditem){
                $this->Releases_model->update($iditem, array('launch_order' => $i+1));
            }
        }
    }

    function manage(){

        $this->user_session->forcelogin();
        $id = $this->uri->segment(3);

      if($this->input->post()){
        $work_placement_delete = $this->input->post('work_placement_delete');
		$work_placement_save = $this->input->post('work_placement_save');
		$work_placement_add = $this->input->post('work_placement_add');
		
		if(!empty($work_placement_delete)){
			$wp_id = $this->input->post('id');
			$this->Work_placement_model->delete($wp_id);
			$this->session->set_flashdata('launch_feedback', array(
				'message' => 'Estágio da obra excluído com sucesso.',
				'type' => 'success'
			));
		}else if(!empty($work_placement_save)){
			$id = $this->input->post('id');
			$percent = $this->input->post('percent');
			$data_update = array('percent' => $percent);
			$this->Work_placement_model->update($id, $data_update);
			$this->session->set_flashdata('launch_feedback', array(
				'message' => 'Estágio da obra atualizado com sucesso.',
				'type' => 'success'
			));
		}else if(!empty($work_placement_add)){
			$percent = $this->input->post('percent');
			$stage = $this->input->post('stage');
			
			$stage_exist = $this->Work_placement_model->get_by(array('releases_id' => $id, 'position' => $stage));
			if(!$stage_exist){
				$stage_name = '';
				switch($stage){
					case 1: $stage_name = 'Esquadrias'; break;
					case 2: $stage_name = 'Infraestrutura'; break;
					case 3: $stage_name = 'Supraestrutura'; break;
					case 4: $stage_name = 'Serviços Preliminares'; break;
					case 5: $stage_name = 'Vedação - Alvenaria'; break;
					case 6: $stage_name = 'Instalações Hidráulicas e de Incêndio'; break;
					case 7: $stage_name = 'Instalações Elétricas e Sistemas'; break;
					case 8: $stage_name = 'Revestimento Interno'; break;
					case 9: $stage_name = 'Revestimento Externo'; break;
					case 10: $stage_name = 'Pintura'; break;
					case 11: $stage_name = 'Serviços complementares'; break;
					default: $stage_name = 'Impermeabilização e cobertura'; break;
				}
				$data_insert = array(
					'percent' => $percent,
					'releases_id' => $id,
					'title' => $stage_name,
					'position' => $stage,
					'colunn' => 1
				);
				$this->Work_placement_model->insert($data_insert);
				$this->session->set_flashdata('launch_feedback', array(
					'message' => 'Estágio da obra adicionado com sucesso.',
					'type' => 'success'
				));
			}else{
				$this->session->set_flashdata('launch_feedback', array(
					'message' => 'Este estágio da obra já existe.',
					'type' => 'danger'
				));
			}
		}else{
			$name = $this->input->post('name');
			$url = $this->input->post('url');
			$detail_text = $this->input->post('detail_text');
			$title = $this->input->post('title');
			$title_slider = $this->input->post('title_slider');
			$description = $this->input->post('description');
			$description_home = $this->input->post('description_home');
			$address = $this->input->post('address');
			$status = $this->input->post('status');
			$neighborhood = $this->input->post('neighborhood');
			$city = $this->input->post('city');
			$embed_video = $this->input->post('embed_video');
			$show_home = $this->input->post('show_home');
			$value = $this->input->post('value');
			if(!empty($value)){
				$value = str_replace(array('.', ','), array('', '.'), $value);
			}
			$category = $this->input->post('category');
			$useful_area = $this->input->post('useful_area');
			if(empty($useful_area)){
				$useful_area = null;    
			}
			$garage = $this->input->post('garage');
			if(empty($garage)){
				$garage = null;    
			}
			$room = $this->input->post('room');
			if(empty($room)){
				$room = null;    
			}
			$bathroom = $this->input->post('bathroom');
			if(empty($bathroom)){
				$bathroom = null;    
			}
			$suite = $this->input->post('suite');
			if(empty($suite)){
				$suite = null;    
			}
			$update_work = $this->input->post('update_work');
			$status_work = $this->input->post('status_work');

			$detail_text = preg_replace("/\r\n|\r|\n/",'<br/>', $detail_text);
			
			$latitude = $this->input->post('latitude');
			if(empty($latitude)){
				$latitude = null;
			}
			$longitude = $this->input->post('longitude');
			if(empty($longitude)){
				$longitude = null;
			}

			$launch_array = array(
			  'name' => $name,
			  'url' => $url,
			  'detail_text' => $detail_text,
			  'title' => $title,
			  'title_slider' => $title_slider,
			  'description' => $description,
			  'address' => $address,
			  'status' => $status,
			  'neighborhood' => $neighborhood,
			  'description_home' => $description_home,
			  'embed_video' => $embed_video,
			  'show_home' => $show_home,
			  'value' => $value,
			  'garage' => $garage,
			  'useful_area' => $useful_area,
			  'room' => $room,
			  'bathroom' => $bathroom,
			  'suite' => $suite,
			  'category' => $category,
			  'city' => $city,
			  'update_work' => $update_work,
			  'status_work' => $status_work,
			  'latitude' => $latitude,
			  'longitude' => $longitude
			);

			$redirect = FALSE;
			if(!empty($id)){
			  $this->Releases_model->update($id, $launch_array);
			}else{
			  $id = $this->Releases_model->insert($launch_array);
			  $redirect = TRUE;
			}

			$config['upload_path'] = './assets/uploads/releases/'.$id.'/';
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if(!file_exists('./assets/uploads/releases/')){
			  @mkdir('./assets/uploads/releases/');
			}
			if(!file_exists('./assets/uploads/releases/'.$id.'/')){
			  @mkdir('./assets/uploads/releases/'.$id.'/');
			}

			$upload_array = array();
			$upload_error = array();
			if(!empty($_FILES['logo']['tmp_name'])){
				$files = array();
				if(!$this->upload->do_upload('logo')){
					$upload_error[] = $this->upload->display_errors();
				}else{
					$upload_data = $this->upload->data();
					$filename = $upload_data['file_name'];
					$upload_array['logo'] = $filename;
				}
			}
			if(!empty($_FILES['detail_img']['tmp_name'])){
				$files = array();
				if(!$this->upload->do_upload('detail_img')){
					$upload_error[] = $this->upload->display_errors();
				}else{
					$upload_data = $this->upload->data();
					$filename = $upload_data['file_name'];
					$upload_array['detail_img'] = $filename;
				}
			}
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
			if(!empty($_FILES['landing']['tmp_name'])){
				$files = array();
				if(!$this->upload->do_upload('landing')){
					$upload_error[] = $this->upload->display_errors();
				}else{
					$upload_data = $this->upload->data();
					$filename = $upload_data['file_name'];
					$upload_array['landing'] = $filename;
				}
			}
			if(count($upload_array) > 0){
				$this->Releases_model->update($id, $upload_array);
			}
			if(count($upload_error) > 0){
				$this->session->set_flashdata('launch_feedback', array(
					'message' => implode(', ', $upload_error),
					'type' => 'danger'
				));
			}else{
				$this->session->set_flashdata('launch_feedback', array(
					'message' => 'Alterado com sucesso.',
					'type' => 'success'
				));
			}
			if($redirect){
				redirect('launch/manage/'.$id);
			}
		}
      }

      $launch = $this->Releases_model->get($id);
      $data['launch'] = $launch;
	  
	  $this->db->order_by('position asc');
	  $work_placement = $this->Work_placement_model->get_many_by(array('releases_id' => $id));
	  $data['work_placement'] = $work_placement;

      $this->load->view('template/header', $data);
      $this->load->view('launch/manage', $data);
      $this->load->view('template/footer', $data);
    }

    function upload(){
        $id = $this->input->post('id');
        $type = $this->input->post('type');
		$legend = $this->input->post('legend');

        if(!$this->input->is_ajax_request()){
            $position = $this->input->post('position');
            if(!empty($position) && is_array($position)){
				foreach($position as $i=>$positionitem){
					$this->Releases_media_model->update($positionitem, array('position' => ($i+1)));
					if(!empty($legend)){
						$this->Releases_media_model->update($positionitem, array('legend' => $legend[$i]));
					}
				}
                redirect('launch/manage/'.$id);
            }
        }

        //if(!empty($_FILES[$type]['tmp_name'])){

          if(!file_exists(FCPATH.'assets/uploads/releases/')){
            @mkdir(FCPATH.'assets/uploads/releases/');
          }
          if(!file_exists(FCPATH.'assets/uploads/releases/'.$id.'/')){
            @mkdir(FCPATH.'assets/uploads/releases/'.$id.'/');
          }

          $base_upload_path = base_url('assets/uploads/releases/'.$id.'/');
          $config['upload_path'] = FCPATH.'assets/uploads/releases/'.$id.'/';
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

                    $photo = $this->Releases_media_model->get_by(array('releases_id' => $id, 'img' => $fileName, 'type' => $type == 'photos'?1:2));
                    if($photo){
                        $files[$f]['position'] = $photo->position;
                        $files[$f]['id'] = $photo->id;
                        $files[$f]['name'] = $fileName;
						$files[$f]['legend'] = $photo->legend;
                        $files[$f]['size'] = $info['size'];
                        $files[$f]['url'] = $base_upload_path.'/'.$fileName;
                        $files[$f]['thumbnailUrl'] = $base_upload_path.'/'.$fileName;
                        $files[$f]['deleteUrl'] = base_url('launch/mediadelete').'?id='.$photo->id.'&rid='.$id;
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
                $photo_id = $this->Releases_media_model->insert(array(
                  'img' => $filename,
                  'type' => $type == 'photos'?1:2,
                  'status' => 1,
                  'releases_id' => $id,
				  'legend' => $legend[count($legend)-1]
                ));

                $info = new StdClass;
                $info->id = $photo_id;
                $info->name = $upload_data['file_name'];
				
                $info->size = $upload_data['file_size'] * 1024;
                $info->type = $upload_data['file_type'];
                $info->url = $base_upload_path.'/'.$filename;

                $this->db->limit('position DESC');
                $photo = $this->Releases_media_model->get_by(array(
                  'type' => $type == 'photos'?1:2,
                  'releases_id' => $id
                ));

				$info->legend = $legend[count($legend)-1];
                $info->thumbnailUrl = $base_upload_path.'/'.$filename;
                $info->deleteUrl = base_url('launch/mediadelete').'?id='.$photo_id.'&rid='.$id;
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
            	$photo = $this->Releases_media_model->get_by(array('id' => $id, 'releases_id' => $rid));
            	if($photo){
	                $deleted = $this->Releases_media_model->delete_by(array('id' => $id, 'releases_id' => $rid));
	                if($deleted){
	                    @unlink(FCPATH.'assets/uploads/releases/'.$rid.'/'.$photo->img);
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
