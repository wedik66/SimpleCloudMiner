<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GatewayIpn extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ipnlogs_model');
		$this->load->model('users_model');
		$this->load->model('transactions_model');
		$this->load->model('plans_model');
		$this->config->load('coinpayments');
	}

	public function coinpayments()
	{
		//Settings
		$CP_MID = $this->config->item('coin_mid');
		$CP_SEC = $this->config->item('coin_sec');

		//Post fields
		$post_invoice = $this->input->post('invoice',true);
		$post_txn_id = $this->input->post('txn_id',true);
		$post_item_name = $this->input->post('item_name',true);
		$post_item_number = $this->input->post('item_number',true);
		$post_amount1 = $this->input->post('amount1',true);
		$post_amount2 = $this->input->post('amount2',true);
		$post_currency1 = $this->input->post('currency1',true);
		$post_currency2 = $this->input->post('currency2',true);
		$post_status = $this->input->post('status',true);
		$post_status_text = $this->input->post('status_text',true);
		$cp_ipn_mode = $this->input->post('ipn_mode',true);
		$cp_merchant = $this->input->post('merchant',true);
		$cp_http_hmac = $this->input->server('HTTP_HMAC',true);

		//Get transaction
		$transaction = $this->transactions_model->getByHash($post_invoice);
		if(!$transaction){
			return $this->errorAndDie('Transaction not found!',null,null,$post_invoice);
		}
		//Check if transaction already processed
		if($transaction->status === 'paid'){
			return $this->errorAndDie('Transaction already paid!',$transaction->id,null,$post_invoice);
		}
		/*
		 * Start Coinpayments checks
		 */
		//Check ipn mode
		if(!$cp_ipn_mode or $cp_ipn_mode !== 'hmac'){
			return $this->errorAndDie('IPN Mode is not HMAC!',$transaction->id,null,$cp_ipn_mode);
		}
		//Check hmac
		if(!$cp_http_hmac){
			return $this->errorAndDie('No HMAC signature sent!',$transaction->id,null,$cp_http_hmac);
		}
		//Check input request
		$request = file_get_contents('php://input');
		if ($request === FALSE || empty($request)) {
			return $this->errorAndDie('Error reading POST data',$transaction->id,null,$request);
		}
		//Check merchant
		if (!$cp_merchant || $cp_merchant != $CP_MID) {
			return $this->errorAndDie('No or incorrect Merchant ID passed',$transaction->id,null,$cp_merchant);
		}
		//Check hmac signature
		$hmac = hash_hmac("sha512", $request, $CP_SEC);
		if (!hash_equals($hmac, $cp_http_hmac)) {
			return $this->errorAndDie('HMAC signature does not match',$transaction->id,null,'Hash: '.$hmac.' HMAC: '.$cp_http_hmac);
		}
		/*
		 * End Coinpayments checks
		 */

		// Check the original currency to make sure the buyer didn't change it.
		if ($post_currency1 != settings('coin_cur1')) {
			return $this->errorAndDie('Original currency mismatch!',$transaction->id,null,$post_currency1);
		}

		// Check amount against order total
		if ($post_amount1 < $transaction->amount) {
			return $this->errorAndDie('Amount is less than order total!',$transaction->id,null,$post_amount1);
		}

		//Payment complete
		if ($post_status >= 100 || $post_status == 2) {
			//Update transaction
			$this->transactions_model->update($transaction->id,'paid',$post_amount1,$post_txn_id);
			//Create deposit history
			$this->users_model->createDeposit($transaction->user_id,$post_amount1,$post_txn_id);
			//Get plan data
			$plan = $this->plans_model->getById('plans',$transaction->plan_id);
			//Calculate expiration date
			$expirationDate = date_format(date_add(date_create(),date_interval_create_from_date_string($plan['duration']." days")),'Y-m-d H:i:s');
			if(!$expirationDate){
				return $this->errorAndDie('Error trying to create expiration date!',$transaction->id,null,$expirationDate);
			}
			//Activate user plan
			$this->users_model->activatePlan($transaction->user_id,$plan['id'],$expirationDate);
			//Check upline
			$this->users_model->uplineCredit($transaction->user_id,$post_amount1);
		}
		//Payment awaiting confirmations
		if ($post_status == 1) {
			//Update transaction
			$this->transactions_model->update($transaction->id,'waiting');
		}
		//Cancelled/expired payment
		if ($post_status < 0) {
			//Cancel transaction
			$this->transactions_model->update($transaction->id,'canceled');
		}
		die('IPN OK');
	}

	protected function errorAndDie($error_msg, $tid=null, $status=null, $params=null)
	{
		//Insert ipn error
		$this->ipnlogs_model->create($error_msg, $tid, $status, $params);
		die('IPN Error: '.$error_msg);
	}
}
