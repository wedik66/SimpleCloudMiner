<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blockchains_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table_name = 'urlchains';
	}

    public function getAll($start=0,$limit=0)
	{
		if(!empty($limit) || !empty($start)){
			$this->db->limit($limit,$start);
		}
		$this->db->order_by('id','ASC');
		$query = $this->db->get($this->table_name);
		return $query->result_array();
    }

    public function update($id)
	{
		if(isset($id) && (int)($id))
		{
			$data = array(
				'name' => $this->input->post('name', true),
				'url' => $this->input->post('url', true),
			);
			$this->db->where('id',$id);
			return $this->db->update($this->table_name,$data);
		}
		return FALSE;
	}

    public function create()
	{
		$data = array(
			'name' => $this->input->post('name', true),
			'url' => $this->input->post('url', true),
		);
		return $this->db->insert($this->table_name,$data);
	}

	public function delete($id)
	{
		return $this->db->delete($this->table_name, array('id'=>$id));
	}

	public function getDefault()
	{
		return $this->getById($this->table_name, settings('blockchain'));
	}
}
