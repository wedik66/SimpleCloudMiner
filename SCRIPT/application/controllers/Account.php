<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('plans_model');
		$this->load->model('users_model');

		if(!$this->ion_auth->logged_in()){
			redirect(base_url());
		}
		$this->userdata = $this->ion_auth->user()->row();
		$this->activeplans = $this->users_model->getUserActivePlans();
	}

	public function index()
	{
		$this->site_view('dashboard',[
			'allplans' => $this->plans_model->getPaidPlans(),
			'userEarningRate' => $this->users_model->getUserMiningSpeed(),
			'active_plans' => $this->activeplans
		]);
	}

	public function history()
	{
		$user = $this->userdata;

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_edit_unique[users.email.'.$user->id.']');
		$this->form_validation->set_rules('password', 'Current Password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|min_length[4]|matches[new_password_confirmation]');
		$this->form_validation->set_rules('new_password_confirmation', 'Confirm New Password', 'trim|min_length[4]');

		if ($this->form_validation->run() === TRUE) {
			if(!$this->users_model->check_password($user->id)){
				$this->session->set_flashdata('error_msg','Invalid Current Password!');
				redirect(current_url());
			}
			if($this->users_model->update_user($user->id)){
				$this->session->set_flashdata('success_msg','Account updated with success!');
			}
			redirect(current_url());
		}

		$this->site_view('account',[
			'referrals' => $this->users_model->user_referrals($user->id),
			'aff_earns' => $this->users_model->user_comissions($user->id),
			'deposits' => $this->users_model->user_deposits($user->id),
			'withdrawals' => $this->users_model->user_withdrawals($user->id),
			'transactions' => $this->users_model->user_pending_transactions($user->id),
		]);
	}

	public function withdrawal()
	{
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|greater_than_equal_to['.settings('min_withdraw').']|less_than_equal_to['.settings('max_withdraw').']');

		if ($this->form_validation->run() === TRUE)
		{
			if($this->input->post('amount',true) > $this->userdata->balance){
				$this->session->set_flashdata('error_msg','You don\'t have enough earning blance to withdrawal the given amount!');
				redirect(current_url());
			}
			if($this->users_model->request_withdrawal()){
				$this->session->set_flashdata('success_msg','Withdraw requested successfully!');
				redirect(current_url());
			}
		}
		$this->site_view('withdrawal');
	}

	public function purchase(int $plan_id)
	{
		$this->config->load('coinpayments');
		$CP_PV = $this->config->item('coin_pv');
		$CP_PB = $this->config->item('coin_pb');
		$CP_MID = $this->config->item('coin_mid');

		$plan = $this->plans_model->getById('plans',xss_clean($plan_id));
		if($plan)
		{
			$transaction_limit = settings('max_pending_transactions');
			$cp_mode = settings('coin_mode');
			//Count pending transactions
			$pending_transactions = $this->users_model->count_user_pending_transactions($this->userdata->id,$plan_id);
			if($pending_transactions < $transaction_limit){
				$hash = md5(settings('coin_hash') . time());
				//Payment
				if($cp_mode==='api'){
					//Check user email
					if(!$this->userdata->email){
						$this->session->set_flashdata('error_msg','Before made a purchase, you need update your contact email in your account!');
						redirect(base_url('dashboard'));
					}
					//Start API
					$cps_api = new CoinpaymentsAPI($CP_PV, $CP_PB, 'json');
					//Create transaction
					$result = $cps_api->CreateCustomTransaction([
						'amount' => $plan['price'],
						'currency1' => settings('coin_cur1'),
						'currency2' => settings('coin_cur2'),
						'item_name' => 'Purchase of Mining Plan '.$plan['version'].' on '.settings('sitename'),
						'item_number' => $plan['id'],
						'invoice' => $hash,
						'ipn_url' => base_url('ipn'),
						//'timeout' => 86399,
						'buyer_email' => $this->userdata->email,
					]);

					if($result['error'] !== 'ok'){
						$this->session->set_flashdata('error_msg','Error while trying to create payment. Contact admin.');
						redirect(base_url('dashboard'));
					}
					//Create transaction history
					$this->users_model->purchasePlan($this->userdata->id,$plan_id,$plan['price'], $hash,json_encode($result['result']));
					//Redirect to invoice
					redirect(base_url('invoice/'.$hash));
				}
				if($cp_mode==='gateway'){
					//Create Payment Link
					$req = [];
					$req['cmd'] = '_pay';
					$req['reset'] = 1;
					$req['merchant'] = $CP_MID;
					$req['item_name'] = html_entity_decode('Purchase of Mining Plan ' . $plan['version'] . ' on ' . settings('sitename'), ENT_QUOTES, 'UTF-8');
					$req['item_number'] = $plan['id'];
					$req['amountf'] = $plan['price'];
					$req['want_shipping'] = 0;
					$req['currency'] = settings('coin_cur1');
					$req['invoice'] = $hash;
					$req['success_url'] = base_url();
					$req['ipn_url'] = base_url('ipn');
					$req['cancel_url'] = base_url();
					$url = 'https://www.coinpayments.net/index.php';
					$url .= '?'.http_build_query($req);
					//Create transaction history
					$this->users_model->purchasePlan($this->userdata->id,$plan_id,$plan['price'], $hash, $url);
					redirect($url);
				}
			}
			$this->session->set_flashdata('error_msg','You have reached the transaction limit, wait for pending transactions to expire, or contact us if you have any questions.');
			redirect(base_url('dashboard'));
		}
		redirect(base_url('dashboard'));
	}

	public function invoice($hash)
	{
		if($hash){
			$invoice = $this->users_model->getInvoice(xss_clean($hash));
			if($invoice){
				$cp_mode = settings('coin_mode');
				if($cp_mode==='gateway'){
					redirect($invoice['params']);
				}
				$params = json_decode($invoice['params'],true);
				$left_time = date_add(date_create($invoice['date']), date_interval_create_from_date_string($params['timeout'].' seconds'));
				if(date_format($left_time, 'Y-m-d H:i:s') <= date('Y-m-d H:i:s')){
					$this->session->set_flashdata('error_msg','The payment deadline for this invoice has expired.');
					redirect(base_url('account'));
				}
				return $this->site_view('purchase',[
					'invoice' => $invoice,
					'params' => $params,
					'time_left' => $left_time->diff(date_create())
				]);
			}
		}
		redirect(base_url('dashboard'));
	}
}
