<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table_name = 'contact';
	}

    public function getAll($start=0,$limit=0)
	{
		if(!empty($limit) || !empty($start)){
			$this->db->limit($limit,$start);
		}
		$this->db->order_by('id','DESC');
		$query = $this->db->get($this->table_name);
		return $query->result_array();
    }

	public function update($id)
	{
		if(isset($id) && (int)($id))
		{
			$data = array(
				'status' => $this->input->post('status', true),
			);

			if($this->input->post('reply')){
				$data['status'] = 'replied';
			}
			$this->db->where('id',$id);
			return $this->db->update($this->table_name,$data);
		}
		return FALSE;
	}

	public function create()
	{
		$data = array(
			'name' => $this->input->post('name', true),
			'email' => $this->input->post('email', true),
			'subject' => $this->input->post('subject', true),
			'message' => $this->input->post('message', true),
		);
		return $this->db->insert($this->table_name,$data);
	}
}
