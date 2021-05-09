<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdrawals_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table_name = 'user_withdrawal';
	}

    public function getAll($start=0,$limit=0)
	{
		if(!empty($limit) || !empty($start)){
			$this->db->limit($limit,$start);
		}else{
			$this->db->order_by('id','ASC');
		}
		$this->db->select('user_withdrawal.*,users.username as username');
		$this->db->order_by('id','ASC');
		$this->db->join('users', 'users.id=user_withdrawal.user_id');
		$this->db->where('status !=','SUCCESS');
		$query = $this->db->get($this->table_name);
		return $query->result_array();
    }

    public function rowsCount($table)
	{
		$this->db->where('status !=','SUCCESS');
		return $this->db->get($this->table_name)->num_rows();
	}

    public function update($id)
	{
		if(isset($id) && (int)($id))
		{
			$data = array(
				'tx' => $this->input->post('tx', true),
				'status' => $this->input->post('status', true),
			);
			$this->db->where('id',$id);
			$this->db->update($this->table_name,$data);
			if($this->input->post('status')==='SUCCESS'){
				$withdrawal = $this->getWithdrawalRequest($id);
				//Set paid date
				$this->db->where('id',$id);
				$this->db->update($this->table_name,['date_paid' => date('Y-m-d H:i:s')]);
				//Update user balance
				$this->db->where('id',$withdrawal['user_id']);
				$this->db->set('cashouts','cashouts+'.$withdrawal['amount'],FALSE);
				/*if($withdrawal['type']==='affiliate'){
					$this->db->set('affiliate_earns','affiliate_earns-'.$withdrawal['amount'],FALSE);
					$this->db->set('affiliate_paid','affiliate_paid+'.$withdrawal['amount'],FALSE);
				}*/
				$this->db->update('users');
			}
			return true;
		}
		return FALSE;
	}

	public function getWithdrawalRequest($id)
	{
		$this->db->select('user_withdrawal.*,users.username as username');
		$this->db->join('users', 'users.id=user_withdrawal.user_id');
		$this->db->where('user_withdrawal.id',$id);
		return $this->db->get($this->table_name)->row_array();
	}
}
