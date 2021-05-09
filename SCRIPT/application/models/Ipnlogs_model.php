<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ipnlogs_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table_name = 'inp_errors';
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

    public function create($message,$transaction_id=null,$status=null,$content=null)
	{
		$this->db->insert($this->table_name,[
			'message' => $message,
			'content' => json_encode($content),
			'status' => $status,
			'transaction_id' => $transaction_id,
		]);
	}
}
