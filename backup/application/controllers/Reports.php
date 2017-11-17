<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
    
    public function __construct(){
		parent::__construct();
        $this->load->model('Properties_model');
        $this->load->helper('imovel');
        $this->db->cache_off();
    }

	public function index()
	{

        $this->user_session->forcelogin();
        
		$data = array();
        
        $this->db->order_by('launch_order asc');
        $exclusive = $this->Properties_model->with('images')->get_many_by(array('status <>' => 2, 'exclusive' => 1));
        $exclusive = buildimovel($exclusive);
        $data['exclusive'] = $exclusive;
        
		$this->load->view('admin/template/header', $data);
        $this->load->view('admin/reports/exclusive', $data);
        $this->load->view('admin/template/footer', $data);

	}
    
    public function withoutphotos()
	{

        $this->user_session->forcelogin();
        
		$data = array();
        
        $this->db->order_by('launch_order asc');
        $this->db->join('images', 'images.property_id = properties.id', 'LEFT');
        $withoutphotos = $this->Properties_model->with('images')->get_many_by(array('properties.status <>' => 2, 'path' => NULL));
        $withoutphotos = buildimovel($withoutphotos);
        $data['withoutphotos'] = $withoutphotos;
        
		$this->load->view('admin/template/header', $data);
        $this->load->view('admin/reports/withoutphotos', $data);
        $this->load->view('admin/template/footer', $data);

	}

}
