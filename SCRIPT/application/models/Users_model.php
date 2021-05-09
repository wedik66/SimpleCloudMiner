<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table_name = 'users';
	}

	public function getAll($start = 0, $limit = 0,$role_id = 2)
	{
		return $this->users_query($start, $limit, $role_id)->result_array();
	}

	function count_users($role=2)
	{
		return $this->users_query(0,0,$role)->num_rows();
	}

	function users_query($start = 0, $limit = 0, $role_id = '2')
	{
		$this->db->select('users.*,users_groups.group_id');
		$this->db->order_by('id', 'DESC');
		$this->db->join(
			'users_groups',
			'users_groups.user_id=users.id'
		);
		$this->db->where('users_groups.group_id', $role_id); //only users

		if (!empty($limit) || !empty($start)) {
			$this->db->limit($limit, $start);
		}

		return $this->db->get($this->table_name);
	}

	function user_plans($id)
	{
		$this->db->select('user_plan_history.*,plans.plan_name as name');
		$this->db->join(
			'plans',
			'plans.id=user_plan_history.plan_id'
		);
		$this->db->where('user_id',$id);
		return $this->db->get('user_plan_history')->result_array();
	}

	function user_withdrawals($id)
	{
		$this->db->where('user_id',$id);
		return $this->db->get('user_withdrawal')->result_array();
	}

	function user_referrals($id)
	{
		return $this->db->where('reference_user_id',$id)->order_by('id','DESC')->get('users')->result_array();
	}

	function user_pending_transactions($id)
	{
		return $this->db->where('user_id',$id)->where('status !=','paid')->order_by('id','DESC')->get('transactions_history')->result_array();
	}

	function user_deposits($id)
	{
		$this->db->where('user_id',$id);
		return $this->db->get('user_deposits')->result_array();
	}

	function user_comissions($id)
	{
		$this->db->where('user_id',$id);
		return $this->db->get('affiliate_history')->result_array();
	}

	function check_password($id)
	{
		$user = $this->ion_auth->user($id)->row();
		return $this->ion_auth->verify_password($this->input->post('password',TRUE),$user->password,$id);
	}

	function update($id)
	{
		if(isset($id) && (int)($id))
		{
			$data = array(
				'username' => $this->input->post('username', true),
				'email' => $this->input->post('email', true),
			);
			if($this->input->post('new_password')){
				$data['password'] = $this->input->post('new_password');
			}
			return $this->ion_auth->update($id,$data);
		}
		return FALSE;
	}

	function update_user($id)
	{
		if(isset($id) && (int)($id))
		{
			$data = array(
				'email' => $this->input->post('email', true),
			);
			if($this->input->post('new_password')){
				$data['password'] = $this->input->post('new_password');
			}
			return $this->ion_auth->update($id,$data);
		}
		return FALSE;
	}

	function create_admin()
	{
		return $this->ion_auth->register(
			$this->input->post('username',true),
			$this->input->post('password',true),
			$this->input->post('email',true),
			['unique_id' => mt_rand(10000,99999)],
			[1]
		);
	}

	function getUserActivePlans()
	{
		$user = $this->ion_auth->user()->row();
		return $this->db->where('user_id',$user->id)
			->select('user_plan_history.*,p.plan_name as name,p.earning_rate as earning_rate,p.speed as speed,p.version as version,p.point_per_day as point_per_day,p.duration as duration')
			->where('status','active')
			->join('plans as p','p.id=plan_id')
			->get('user_plan_history')->result();
	}

	function getUserMiningSpeed()
	{
		return array_sum(array_column($this->getUserActivePlans(),'earning_rate'));
	}

	function updateUserBalance()
	{
		$user = $this->ion_auth->user()->row();
		//Get active plans
		$plans = $this->getUserActivePlans();
		//Calculate earnings
		foreach($plans as $plan){
			//Disable expired plan
			if($plan->expire_date !== null && date('Y-m-d H:i:s') >= $plan->expire_date){
				$this->db->where('id',$plan->id)->update('user_plan_history',['status' => 'inactive']);
			}else{
				$now = time();
				$last_sum = $plan->last_sum?$plan->last_sum:strtotime($plan->created_at);
				$seconds = $now - $last_sum;
				$earnings = ($seconds * ($plan->earning_rate/60));
				//Update lastsum
				$this->db->where('id',$plan->id)->update('user_plan_history',['last_sum' => $now]);
				//Update user balance
				$this->db->where('id',$user->id)->set('balance','balance+'.$earnings,FALSE)->update('users');
			}
		}
	}

	function request_withdrawal()
	{
		$user = $this->ion_auth->user()->row();
		$amount = $this->input->post('amount',true);
		//Create withdrawal request
		$this->db->insert('user_withdrawal',[
			'user_id' => $user->id,
			'amount' => $amount,
		]);
		//Debit user balance
		return $this->db->where('id',$user->id)->set('balance','balance-'.$amount,FALSE)->update('users');
	}

	function getUserByUuid($uuid)
	{
		return $this->db->where('unique_id',$uuid)->get('users')->row();
	}

	function count_user_pending_transactions($user_id,$plan_id)
	{
		return $this->db->where('user_id',$user_id)
			->where('plan_id',$plan_id)
			->where('status','pending')
			->get('transactions_history')->num_rows();
	}

	function purchasePlan($user_id, $plan_id, $amount, $hash, $params =null)
	{
		return $this->db->insert('transactions_history',[
			'plan_id' => $plan_id,
			'user_id' => $user_id,
			'amount' => $amount,
			'hash' => $hash,
			'params' => $params,
			'date' => date('Y-m-d H:i:s')
		]);
	}

	function getInvoice($hash)
	{
		if($hash){
			return $this->db->where('hash',$hash)->get('transactions_history')->row_array();
		}
	}

	function createDeposit($user,$amount,$tx)
	{
		if($user && $amount && $tx){
			return $this->db->insert('user_deposits',[
				'user_id' => $user,
				'amount' => $amount,
				'tx' => $tx,
				'status' => 'SUCCESS',
				'date_paid' => date('Y-m-d H:i:s'),
			]);
		}
		return false;
	}

	function activatePlan($user_id, $plan_id, $expire_date)
	{
		if($user_id && $plan_id && $expire_date){
			return $this->db->insert('user_plan_history',[
				'user_id' => $user_id,
				'plan_id' => $plan_id,
				'created_at' => date('Y-m-d H:i:s'),
				'expire_date' => $expire_date,
				'created_at' => date_format(date_create(),'Y-m-d H:i:s'),
				'status' => 'active',
			]);
		}
		return false;
	}

	function uplineCredit($user_id, $amount)
	{
		if($user_id && $amount){
			//Check
			$user = $this->getById('users',$user_id);
			if($user['reference_user_id']){
				$comission = number_format($amount * settings('aff_comission')/100,8,'.','');
				//Get upline
				$upline = $this->getById('users',$user['reference_user_id']);
				//Credit upline
				$this->db->where('id',$upline['id'])
					->set('balance','balance+'.$comission,FALSE)
					->set('affiliate_earns','affiliate_earns+'.$comission,FALSE)
					->update('users');
				//Create affiliate history
				return $this->db->insert('affiliate_history',[
					'user_id' => $upline['id'],
					'amount' => $comission,
					'status' => 'paid',
				]);
			}
		}
		return false;
	}

	function createFreePlan($user_id)
	{
		if($user_id){
			$plan = $this->db->where('is_default','1')->get('plans')->row();
			$expirationDate = date_format(date_add(date_create(),date_interval_create_from_date_string($plan->duration." days")),'Y-m-d H:i:s');
			return $this->db->insert('user_plan_history',[
				'user_id' => $user_id,
				'plan_id' => $plan->id,
				'status' => 'active',
				'created_at' => date_format(date_create(),'Y-m-d H:i:s'),
				'expire_date' => $expirationDate
			]);
		}
		return false;
	}
}
