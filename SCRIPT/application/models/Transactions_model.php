<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table_name = 'transactions_history';
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

    public function getByHash($hash)
	{
		if($hash){
			return $this->db->where('hash',xss_clean($hash))->get($this->table_name)->row();
		}
		return false;
	}

	public function update($id,$status,$amount=null,$txid=null)
	{
		if($id){
			return $this->db->where('id',$id)->update($this->table_name,[
				'status' => $status,
				'paid_amount' => $amount,
				'txid' => $txid,
			]);
		}
		return false;
	}
}
