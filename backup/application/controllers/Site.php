<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
    
    private $facebook_appId = "156873018174785";
    private $array_days = array("SUNDAY"=>"DOMINGO",
                                "MONDAY"=>"SEGUNDA",
                                "TUESDAY"=>"TERÇA",
                                "WEDNESDAY"=>"QUARTA",
                                "THURSDAY"=>"QUINTA",
                                "FRIDAY"=>"SEXTA",
                                "SATURDAY"=>"SÁBADO");

    private $array_months = array("JANUARY"=>"JANEIRO",
                                "FEBRUARY"=>"FEVEREIRO",
                                "MARCH"=>"MARÇO",
                                "APRIL"=>"ABRIL",
                                "MAY"=>"MAIO",
                                "JUNE"=>"JUNHO",
                                "JULY"=>"JULHO",
                                "AUGUST"=>"AGOSTO",
                                "SEPTEMBER"=>"SETEMBRO",
                                "OCTOBER"=>"OUTUBRO",
                                "NOVEMBER"=>"NOVEMBRO",
                                "DECEMBER"=>"DEZEMBRO");
    
    public function __construct(){
		parent::__construct();
        $this->load->model('Contents_model');
        $this->load->model('Testimonials_model');
        $this->load->model('Brand_model');
        $this->load->model('Model_model');
        $this->load->model('Version_model');
        $this->load->model('Places_model');
        $this->load->model('Agenda_model');
        $this->db->cache_off();
    }

	public function index(){

        $this->Testimonials_model->order_by('position');
        $testimonials = $this->Testimonials_model->get_many_by(array('status' => 1));
        $data['testimonials'] = $testimonials;

		$this->load->view('template/header');
        $this->load->view('home', $data);
        $this->load->view('template/footer');

	}

    public function valho(){

        $contents = $this->Contents_model->get('a_valho');
        $contents->content = html_entity_decode($contents->content);
        $data['contents'] = $contents;

        $this->load->view('template/header');
        $this->load->view('valho', $data);
        $this->load->view('template/footer');

    }

    public function fale_conosco(){

        $contents = $this->Contents_model->get('fale_conosco');
        $contents->content = html_entity_decode($contents->content);
        $data['contents'] = $contents;

        $this->load->view('template/header');
        $this->load->view('fale_conosco', $data);
        $this->load->view('template/footer');

    }

    public function detalhe(){

        $this->load->view('template/header');
        $this->load->view('detalhe');
        $this->load->view('template/footer');

    }

    public function como_funciona(){

        $contents = $this->Contents_model->get('como_funciona');
        $contents->content = html_entity_decode($contents->content);
        $data['contents'] = $contents;
        
        $this->load->view('template/header');
        $this->load->view('como_funciona', $data);
        $this->load->view('template/footer');

    }

    public function blog(){

        $this->load->view('template/header');
        $this->load->view('blog');
        $this->load->view('template/footer');

    }

    public function agende_inspecao(){
        $data['message'] = "";
        $data['error'] = false;

        if($this->input->post()){

            $brandId = @$this->input->post('brand');
            $modelId = @$this->input->post('model');
            $versionFipeCode = @$this->input->post('version');
            $placeId = @$this->input->post('place');

            $data['name'] = $name = @$this->input->post('name');
            $data['email'] = $email = @$this->input->post('email');
            $data['mobile'] = $mobile = @$this->input->post('mobile');

            $data['date'] = $date = @$this->input->post('date');
            $data['hour'] = $hour = @$this->input->post('hour');

            $data['brand_id'] = $brandId;
            $data['model_id'] = $modelId;
            $data['version_fipe_code'] = $versionFipeCode;
            $data['place_id'] = $placeId;

            switch ($this->input->post('event')) {
                case 'submit':
                    $datetime = $date." ".substr($hour,0,5).":00";
                    $data_array = array('brand' => $brandId,
                                        'model' => $modelId,
                                        'version' => $versionFipeCode,
                                        'name' => $name,
                                        'email' => $email,
                                        'mobile' => $mobile,
                                        'place' => $placeId,
                                        'datetime' => $datetime
                                        );

                    $id = $this->Agenda_model->insert($data_array);
                    if(is_numeric($id)){
                        $data['message'] = "Agendamento efetuado com sucesso, logo entraremos em contato!";
                        $data['error'] = false;
                    }else{
                        $data['message'] = "Erro ao agendar a avaliação, entre em contato com nosso suporte!";
                        $data['error'] = true;
                    }
                    break;

                case 'brand':
                    $this->Model_model->order_by('name');
                    $model = $this->Model_model->get_many_by(array('brand_id'=>$brandId));
                    echo json_encode($model);
                    exit();
                    break;

                case 'model':
                    $this->Version_model->order_by('name');
                    $version = $this->Version_model->get_many_by(array('brand_id'=>$brandId,'model_id'=>$modelId));
                    echo json_encode($version);
                    exit();
                    break;

            }
        }

        $data['urlFacebook'] = "https://www.facebook.com/v2.8/dialog/oauth?client_id=".$this->facebook_appId."&redirect_uri=".base_url('facebook_return')."&scope=email";

        $this->Brand_model->order_by('name');
        $brands = $this->Brand_model->get_all();
        $data['brand'] = $brands;
        
        $places = $this->Places_model->get_all();
        $data['places'] = $places;

        $data['days'] = $this->returnDays();
        $data['hours'] = $this->returnHours();

        $this->load->view('template/header');
        $this->load->view('agende_inspecao', $data);
        $this->load->view('template/footer');

    }

    public function facebook_return(){

        $this->load->view('facebook_return');

    }    

    private function returnDays(){

        $days_in_calendar = 15;
        $days = array();

        for($i=0;$i<$days_in_calendar;$i++){

            $date = strtotime("NOW +$i day");
            $litteral_day = $this->array_days[strtoupper(date('l',$date))];
            $litteral_month = $this->array_months[strtoupper(date('F',$date))];
            $day = date('d',$date);
            
            $days[$i]['date'] = date('Y-m-d',$date);
            $days[$i]['number'] = $day;
            $days[$i]['day'] = $litteral_day;
            $days[$i]['month'] = $litteral_month;
            $days[$i]['disabled'] = ($litteral_month == "SUNDAY" || $litteral_month == "SATURDAY" || $i == 0) ? "true" : "false";
            $days[$i]['selected'] = ($i == 1) ? "true" : "false";
        }

        return $days;
        
    }

    private function returnHours(){

        $hour_ini = '08:00'; // hour 0 to 23 
        $hour_fim = '18:30'; // hour 0 to 23
        $interval = '30'; // in minutes
        $hours = array();

        for($hour_curr = $hour_ini; $hour_curr != $hour_fim;){
            $hour_curr_ant = $hour_curr;
            $hour_curr = date('H:i',strtotime($hour_curr." + ".$interval." minutes"));
            $hours[] = $hour_curr_ant." às ".$hour_curr;

        }

        return $hours;
        
    }

}