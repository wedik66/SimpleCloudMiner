<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addons_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table_name = 'addons';
	}

    public function getAddonsMenu()
	{
		return $this->db->order_by('name','ASC')->get('addons_menu')->result_array();
	}
}
