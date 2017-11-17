<?php

class Agenda_model extends MY_Model {
	public $belongs_to = array();
	public $has_many = array('brands' => array('id'=>'brand'));
}
