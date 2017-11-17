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
                                "SATURDAY"=>"SABADO");

    private $array_months = array("JANUARY"=>"JANEIRO",
                                "FEBRUARY"=>"FEVEREIRO",
                                "MARCH"=>"MARCO",
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

        $blogDB = $this->load->database('blog', TRUE);

        $query = $blogDB->query(" SELECT ID, post_title, post_date, post_content, guid FROM wp_posts WHERE post_type = 'post' ORDER BY post_date DESC LIMIT 2 ");

        $data['posts'] = $query->result();

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
            $km = @$this->input->post('km');
            $placeId = @$this->input->post('place');

            $data['name'] = $name = @$this->input->post('name');
            $data['email'] = $email = @$this->input->post('email');
            $data['mobile'] = $mobile = @$this->input->post('mobile');

            $data['date'] = $date = @$this->input->post('date');
            $data['hour'] = $hour = @$this->input->post('hour');

            $data['brand_id'] = $brandId;
            $data['model_id'] = $modelId;
            $data['version_fipe_code'] = $versionFipeCode;
            $data['km'] = $km;
            $data['place_id'] = $placeId;

            switch ($this->input->post('event')) {
                case 'getHours':
                    echo json_encode($this->returnHours($date, $placeId));
                    exit();
                    break;
                case 'submit':
                    $datetime_start = $date." ".substr($hour,0,5).":00";
                    $datetime_end = date('Y-m-d H:i:s',strtotime($date." ".substr($hour,0,5).":00 + 30 minutes"));
                    $data_array = array('brand' => $brandId,
                                        'model' => $modelId,
                                        'version' => $versionFipeCode,
                                        'km' => $km,
                                        'name' => $name,
                                        'email' => $email,
                                        'mobile' => $mobile,
                                        'place' => $placeId,
                                        'datetime_start' => $datetime_start,
                                        'datetime_end' => $datetime_end,
                                        'status' => '1'
                                        );

                    $id = $this->Agenda_model->insert($data_array);
                    if(is_numeric($id)){
                        $data = "";
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
        
        $places = $this->Places_model->get_many_by(array('status' => 1));
        $data['places'] = $places;

        $data['days'] = $this->returnDays();

        $this->load->view('template/header');
        $this->load->view('agende_inspecao', $data);
        $this->load->view('template/footer');

    }

    public function facebook_return(){

        $this->load->view('facebook_return');

    }    

    private function returnDays(){

        // Return 15 days after today
        $days_in_calendar = 8;
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
            $days[$i]['disabled'] = ($litteral_day == "DOMINGO") ? "true" : "false";
            $days[$i]['selected'] = ($i == 1) ? "true" : "false";
        }

        return $days;

    }

    private function returnHours($date, $place){

        $hour_ini = '08:00'; // hour 0 to 23
        $hour_fim = '18:00'; // hour 0 to 23
        $interval = '30'; // in minutes
        $hours = array();

        $dateInt = (int) date("Hi", strtotime('+2 hours'));

        if(($dateInt > 800) && $date == date("Y-m-d")){
            $hour_ini = date("H:00", strtotime('+2 hours'));
        }

        if( ( (int) substr($hour_ini, 0,2) ) > ( (int) substr($hour_fim, 0,2) )){
            return "";
        }



        $this->Agenda_model->order_by('datetime_start');
        $reservations = $this->Agenda_model->get_many_by(array( 'status' => '1',
                                                                'place' => $place,
                                                                'datetime_start >=' => $date." 00:00:00",
                                                                'datetime_end <=' => date("Y-m-d 00:00:00",strtotime($date."+ 24 hours"))));
        
        for($hour_curr = $hour_ini; $hour_curr != $hour_fim;){
            $hour_curr_ant = $hour_curr;
            $hour_curr = date('H:i',strtotime($hour_curr." + ".$interval." minutes"));
            $hours[] = $hour_curr_ant." às ".$hour_curr;
        }

        // Remove hours has been blocking
        if(is_array($reservations)){
            foreach($reservations as $reserv){

                $hourStart = (int) substr($reserv->datetime_start,11,2).substr($reserv->datetime_start,14,2);
                $hourEnd = (int) substr($reserv->datetime_end,11,2).substr($reserv->datetime_end,14,2);

                if($hourStart == 0 && $hourEnd == 0){
                    return "";
                }

                foreach($hours as $key => $h){
                    $hStart = (int) substr($h,0,2).substr($h,3,2);
                    $hEnd = (int) substr($h,10,2).substr($h,13,2);

                    if(($hStart >= $hourStart && $hStart < $hourEnd) || ($hEnd > $hourStart && $hEnd <= $hourEnd)){
                        unset($hours[$key]);
                    }
                }
            }
        }

        return $hours;
        
    }

}