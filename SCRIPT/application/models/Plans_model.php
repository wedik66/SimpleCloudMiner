<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plans_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table_name = 'plans';
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

    public function getPaidPlans()
	{
		$this->db->where('is_default',0);
		$this->db->order_by('price','ASC');
		$query = $this->db->get($this->table_name);
		return $query->result_array();
    }

    public function update($id)
	{
		if(isset($id) && (int)($id))
		{
			$data = array(
				'plan_name' => $this->input->post('plan_name', true),
				'is_default' => $this->input->post('is_default', true),
				'point_per_day' => $this->input->post('point_per_day', true),
				'version' => $this->input->post('version', true),
				'earning_rate' => $this->input->post('earning_rate', true),
				'image' => $this->input->post('image', true),
				'price' => $this->input->post('price', true),
				'duration' => $this->input->post('duration', true),
				'profit' => $this->input->post('profit', true),
				'speed' => $this->input->post('speed', true),
			);
			if($this->input->post('is_default', true) == 1)
			{
				$this->db->where('is_default','1')->set('is_default','0',FALSE)->update($this->table_name);
			}
			$this->db->where('id',$id);
			return $this->db->update($this->table_name,$data);
		}
		return FALSE;
	}

    public function create()
	{
		$data = array(
			'plan_name' => $this->input->post('plan_name', true),
			'is_default' => $this->input->post('is_default', true),
			'point_per_day' => $this->input->post('point_per_day', true),
			'version' => $this->input->post('version', true),
			'earning_rate' => $this->input->post('earning_rate', true),
			'image' => $this->input->post('image', true),
			'price' => $this->input->post('price', true),
			'duration' => $this->input->post('duration', true),
			'profit' => $this->input->post('profit', true),
			'speed' => $this->input->post('speed', true),
		);
		if($this->input->post('is_default', true) == 1)
		{
			$this->db->where('is_default','1')->set('is_default','0',FALSE)->update($this->table_name);
		}
		return $this->db->insert($this->table_name,$data);
	}

	public function delete($id)
	{
		return $this->db->delete($this->table_name, array('id'=>$id));
	}
}
