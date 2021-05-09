<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coinpayments extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('coinpayments_model');
		$this->load->model('users_model');
		$this->check_status = $this->coinpayments_model->checkStatus();
		if ($this->check_status) {
			$this->settings = $this->coinpayments_model->getSettings();
		}
		$this->userdata = $this->ion_auth->user()->row();
	}

	/**
	 * Request Withdrawal
	 */
	public function withdrawal()
	{
		//Check if user is logged in
		if (!$this->ion_auth->logged_in()) {
			redirect(base_url());
		}
		//Validation Rules
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|greater_than_equal_to[' . settings('min_withdraw') . ']|less_than_equal_to[' . settings('max_withdraw') . ']');
		//Validate
		if ($this->form_validation->run() === TRUE) {
			if ($this->userdata->balance <= 0 || $this->userdata->balance < $this->input->post('amount', true)) {
				$this->session->set_flashdata('error_msg', 'You don\'t have enough earning balance to withdrawal the given amount!');
				redirect(current_url());
				return;
			}

			//Start Instant Withdrawal
			$amount = number_format($this->input->post('amount', true), 8, '.', '');

			//Get settings
			$this->config->load('coinpayments');
			$CP_PV = $this->config->item('coin_pv');
			$CP_PB = $this->config->item('coin_pb');
			$auto_confirm = $this->settings['auto_confirm'];
			$tx_fee = $this->settings['tx_fee'] === 'owner' ? '1' : '0';

			//Start API
			$cps_api = new CoinpaymentsAPI($CP_PV, $CP_PB, 'json');

			//Send withdrawal
			$withdrawal = $cps_api->CreateWithdrawal(
				array(
					'amount' => $amount,
					'address' => $this->userdata->username,
					'currency' => settings('currency_code'),
					'auto_confirm' => $auto_confirm,
					'add_tx_fee' => $tx_fee,
					'note' => settings('sitename') . ' - Payment to User #' . $this->userdata->id,
					'ipn_url' => base_url('coinpayments_withdrawal_ipn'),
				)
			);

			if ($withdrawal['error'] !== 'ok') {
				$this->session->set_flashdata('error_msg', 'An unexpected error has occurred and your payment cannot be made. Try again or contact the administrator.');
				//Log error message
				$error_message = 'Coinpayments withdraw error message: ' . $withdrawal['error'] . '. Request: ' . $this->input->post('amount', true) . '. Amount: ' . $amount;
				$this->coinpayments_model->createErrorLog($error_message, $this->userdata->id);
				log_message('error', $error_message);
				redirect(current_url());
			}

			if ($this->coinpayments_model->request_withdrawal($withdrawal['result'], $amount)) {
				if ($withdrawal['result']['status'] === 1) {
					$this->session->set_flashdata('success_msg', 'Your withdrawal request was successfully requested! You will receive your payment in a few minutes.');
				} else {
					$this->session->set_flashdata('success_msg', 'Your withdrawal request was successfully requested! You will receive your payment after approval by the administrator.');
				}
				redirect(current_url());
			}
		}
		$this->site_view('withdrawal');
	}

	/**
	 * Process IPN Notifications
	 */
	public function ipn()
	{
		//Settings
		$this->config->load('coinpayments');
		$CP_MID = $this->config->item('coin_mid');
		$CP_SEC = $this->config->item('coin_sec');

		//Post fields
		$post_id = $this->input->post('id', true);
		$post_txn_id = $this->input->post('txn_id', true);
		//$post_amount1 = $this->input->post('amount', true);
		//$post_amount2 = $this->input->post('amounti', true);
		$post_currency = $this->input->post('currency', true);
		$post_status = $this->input->post('status', true);
		//$post_status_text = $this->input->post('status_text', true);
		$cp_ipn_mode = $this->input->post('ipn_mode', true);
		$cp_merchant = $this->input->post('merchant', true);
		$cp_http_hmac = $this->input->server('HTTP_HMAC', true);

		//Get withdrawal
		$withdrawal = (object)$this->coinpayments_model->get_withdrawal($post_id);
		if (!$withdrawal) {
			return $this->errorAndDie('Withdraw Request not found! Withdraw #' . $post_id);
		}
		//Check if transaction already processed
		if ($withdrawal->status === 'SUCCESS') {
			return $this->errorAndDie('Withdraw request already paid! Withdraw #' . $withdrawal->id);
		}
		/*
		 * Start Coinpayments checks
		 */
		//Check ipn mode
		if (!$cp_ipn_mode or $cp_ipn_mode !== 'hmac') {
			return $this->errorAndDie('IPN Mode is not HMAC! Withdraw #' . $withdrawal->id . ' IPN MODE: ' . $cp_ipn_mode);
		}
		//Check hmac
		if (!$cp_http_hmac) {
			return $this->errorAndDie('No HMAC signature sent! Withdraw #' . $withdrawal->id . ' HMAC: ' . $cp_http_hmac);
		}
		//Check input request
		$request = file_get_contents('php://input');
		if ($request === FALSE || empty($request)) {
			return $this->errorAndDie('Error reading POST data! Withdraw #' . $withdrawal->id . ' INPUT: ' . json_encode($request, JSON_PRETTY_PRINT));
		}
		//Check merchant
		if (!$cp_merchant || $cp_merchant != $CP_MID) {
			return $this->errorAndDie('No or incorrect Merchant ID passed! Withdraw #' . $withdrawal->id . ' MID: ' . $cp_merchant);
		}
		//Check hmac signature
		$hmac = hash_hmac("sha512", $request, $CP_SEC);
		if (!hash_equals($hmac, $cp_http_hmac)) {
			return $this->errorAndDie('HMAC signature does not match! Withdraw #' . $withdrawal->id . ' Hash: ' . $hmac . ' HMAC: ' . $cp_http_hmac);
		}
		/*
		 * End Coinpayments checks
		 */

		// Check the original currency to make sure the buyer didn't change it.
		if ($post_currency != settings('coin_cur1')) {
			return $this->errorAndDie('Original currency mismatch! Withdraw #' . $withdrawal->id . ' Currency: ' . $post_currency);
		}

		//Payment complete
		if ($post_status >= 100 || $post_status == 2) {
			//Update withdraw
			$this->coinpayments_model->update_withdrawal($post_id, $post_txn_id);
		}
		die('IPN OK');
	}

	/**
	 * Log IPN Errors
	 * @param $message string
	 */
	protected function errorAndDie($message)
	{
		log_message('error', 'Coinpayments IPN Error: ' . $message);
		return;
	}
}
