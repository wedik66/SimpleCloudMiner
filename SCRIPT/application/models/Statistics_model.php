<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics_model extends MY_Model
{
    public function index()
    {
    	$data = array();

		$data['pending_withdrawals'] = $this->db->where('status','PENDING')->get('user_withdrawal')->num_rows();
		$data['messages'] = $this->db->where('status','unread')->get('contact')->num_rows();
		$data['plans'] = $this->db->get('plans')->num_rows();
		$data['deposits'] = $this->db->select_sum('amount')->where('status','SUCCESS')->get('user_deposits')->row()->amount ?? 0;
		$data['deposits_today'] = $this->db->select_sum('amount')->where([
				'status'=>'SUCCESS',
				'DATE(date_paid)' => date('Y-m-d')
			])->get('user_deposits')->row()->amount ?? 0;
		$data['withdrawals'] = $this->db->select_sum('amount')->where('status','SUCCESS')->get('user_withdrawal')->row()->amount ?? 0;
		$data['withdrawals_today'] = $this->db->select_sum('amount')->where([
				'status'=>'SUCCESS',
				'DATE(date_paid)' => date('Y-m-d')
			])->get('user_withdrawal')->row()->amount ?? 0;
		$data['users_today'] = $this->db->where([
				'DATE(created_at)' => date('Y-m-d')
			])->get('users')->num_rows();

    	return $data;
    }

    public function latestDeposits($limit = 10)
	{
		return $this->db->order_by('id','DESC')
			->select('user_deposits.*,users.username as username')
			->where('status','SUCCESS')
			->limit($limit)
			->join('users','users.id=user_deposits.user_id')
			->get('user_deposits')->result_array();
	}

    public function latestWithdrawals($limit = 10)
	{
		return $this->db->order_by('id','DESC')
			->select('user_withdrawal.*, users.username as username')
			->where('status','SUCCESS')
			->limit($limit)
			->join('users','users.id=user_withdrawal.user_id')
			->get('user_withdrawal')->result_array();
	}
}
