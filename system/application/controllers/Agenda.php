<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

    public function __construct(){
		    parent::__construct();
        $this->load->model('Agenda_model');
        $this->load->model('Brand_model');
        $this->load->model('Model_model');
        $this->load->model('Version_model');
        $this->load->model('Places_model');
        $this->load->helper('file');
        $this->db->cache_off();
    }

	public function index()
	{
        $this->user_session->forcelogin();

        $data = array();

        if($this->input->post()){
          $place = $this->input->post('place');
        /*  $result = $this->Agenda_model->db->query("SELECT a.*, b.name as brand_name, m.name as model_name, v.name as version_name, p.place as place_name from agendas as a
                                                LEFT JOIN brands as b ON a.brand = b.id
                                                LEFT JOIN models as m ON a.model = m.id 
                                                LEFT JOIN versions as v ON a.version = v.fipe_code
                                                LEFT JOIN places as p ON a.place = p.id
                                                WHERE p.id = '$place' AND a.status = '1'
                                                GROUP BY a.id
                                                ORDER BY a.datetime_end DESC")->result();

          $data['agenda'] = $result;*/
        }

        $places = $this->Places_model->get_many_by(array('status' => 1));
        $data['places'] = $places;
        $data['place'] = @$place;

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

    public function evento($id=""){

      $this->user_session->forcelogin();

      if($id != ""){
          $place = $this->input->post('place');
          $result = $this->Agenda_model->db->query("SELECT a.*, a.km as km, b.name as brand_name, m.name as model_name, v.name as version_name, p.place as place_name from agendas as a
                                                LEFT JOIN brands as b ON a.brand = b.id
                                                LEFT JOIN models as m ON a.model = m.id 
                                                LEFT JOIN versions as v ON a.version = v.fipe_code
                                                LEFT JOIN places as p ON a.place = p.id
                                                WHERE a.id = '$id'
                                                GROUP BY a.id
                                                ORDER BY a.datetime_end DESC")->result();

        echo json_encode($result);
      }

      return true;
    }

    public function update(){

      $this->user_session->forcelogin();

      if($this->input->post()){
        $id = $this->input->post('id');
        $start = $this->input->post('datetime_start');
        $end = $this->input->post('datetime_end');
        $start = str_replace("T", " ", $start);
        $end = str_replace("T", " ", $end);
        
        $this->Agenda_model->update($id, array('datetime_start' => $start, 'datetime_end' => $end));
        return true;

      }

      return false;
    }

    public function delete(){
      $this->user_session->forcelogin();

      if($this->input->post()){
        $id = $this->input->post('id');
        $this->Agenda_model->update($id, array('status' => '2'));
        echo json_encode(true);
        return true;
      }

      return false;

    }

    public function create(){
      $this->user_session->forcelogin();

      if($this->input->post()){
        $name = $this->input->post('name');
        $placeId = $this->input->post('place');
        $start = $this->input->post('datetime');
        $end = "";

        if(strlen($start)<=10){
          $start .= " 00:00:00";
          $end .= date('Y-m-d H:i:s',strtotime($start." + 24 hours"));
        }else{
          $start = str_replace("T", " ", $start);
          $end .= date('Y-m-d H:i:s',strtotime($start." + 2 hours"));
        }

        $data_array = array('name' => $name,
                            'place' => $placeId,
                            'datetime_start' => $start,
                            'datetime_end' => $end,
                            'status' => "1"
                            );
        $id = $this->Agenda_model->insert($data_array);
        
        echo json_encode($id);

        return true;

      }

      return false;
    }

    public function get_events($place){
      
        $result = $this->Agenda_model->db->query("SELECT a.*, b.name as brand_name, m.name as model_name, v.name as version_name, p.place as place_name from agendas as a
                                                  LEFT JOIN brands as b ON a.brand = b.id
                                                  LEFT JOIN models as m ON a.model = m.id 
                                                  LEFT JOIN versions as v ON a.version = v.fipe_code
                                                  LEFT JOIN places as p ON a.place = p.id
                                                  WHERE p.id = '$place' AND a.status = '1'
                                                  GROUP BY a.id
                                                  ORDER BY a.datetime_end DESC")->result();

        foreach($result as $i=>$agendaitem){
          $events[] = array(
                            'id'=>$agendaitem->id,
                            'title'=>$agendaitem->brand_name." ".$agendaitem->model_name." ".$agendaitem->name,
                            'start'=>$agendaitem->datetime_start,
                            'end'=>$agendaitem->datetime_end
                        );
        }

        echo json_encode($events);

        //return true;
      
        //return false;
    }

}
