<?php

class Thirds_model extends MY_Model {
	public $belongs_to = array();
	public $has_many = array('Thirds_media_model');
}
