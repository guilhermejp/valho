<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct(){
		parent::__construct();
        $this->load->model('Properties_model');
        $this->load->model('Leads_model');
        $this->db->cache_off();
    }

	public function index()
	{

        $this->user_session->forcelogin();
        
		$data = array();
        
        $this->db->select('sum(views) as views');
        $views = $this->Properties_model->get_all();
        $count_views = 0;
        if(is_array($views) && count($views) > 0){
            $count_views = $views[0]->views;
        }
        $data['count_views'] = (int) $count_views;
        
        $this->db->select('sum(clicks) as clicks');
        $clicks = $this->Properties_model->get_all();
        $count_clicks = 0;
        if(is_array($clicks) && count($clicks) > 0){
            $count_clicks = $clicks[0]->clicks;
        }
        $data['count_clicks'] = (int) $count_clicks;
        
        $this->db->select('sum(clicks_phone) as clicks_phone');
        $clicks_phone = $this->Properties_model->get_all();
        $count_clicks_phone = 0;
        if(is_array($clicks_phone) && count($clicks_phone) > 0){
            $count_clicks_phone = $clicks_phone[0]->clicks_phone;
        }
        $data['count_clicks_phone'] = (int) $count_clicks_phone;
        
        $count_intentions = $this->Leads_model->count_all();
        $data['count_intentions'] = (int) $count_intentions;
        
		$this->load->view('template/admin/header', $data);
        $this->load->view('admin', $data);
        $this->load->view('template/admin/footer', $data);

	}

}
