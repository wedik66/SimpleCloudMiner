<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	protected $table_name;

	function __construct()
	{
		parent::__construct();
	}

	function getTableName()
	{
		return $this->table_name;
	}

	function getById($table, $id)
	{
		return $this->db->where('id',$id)->get($table)->row_array();
	}

	function rowsCount($table)
	{
		return $this->db->get($table)->num_rows();
	}

	function checkReferral($unique_id)
	{
		return $this->db->where('unique_id',$unique_id)->get('users')->num_rows();
	}
}
