<?php

class Releases_model extends MY_Model {
	public $belongs_to = array();
	public $has_many = array('releases_medias' => array('model' => 'releases_media_model', 'primary_key' => 'releases_id'));
}
