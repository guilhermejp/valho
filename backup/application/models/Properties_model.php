<?php

class Properties_model extends MY_Model {
	public $belongs_to = array('clients' => array('model' => 'clients_model', 'primary_key' => 'client_id'));
	public $has_many = array('images' => array('model' => 'images_model', 'primary_key' => 'property_id'));
}
