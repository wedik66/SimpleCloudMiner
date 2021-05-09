<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coinpayments extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->is_admin_loggedin();
		$this->load->model('coinpayments_model');
		$this->check_status = $this->coinpayments_model->checkStatus();
		$this->addon_version = '1.1';
		if ($this->check_status) {
			$this->settings = $this->coinpayments_model->getSettings();
			$this->errorLogs = $this->coinpayments_model->getErrorLogs();
		}
	}

	public function index()
	{
		if (!$this->check_status) {
			return $this->admin_view('addons/coinpayments/install');
		}
		$this->form_validation->set_rules('tx_fee', 'Transaction Fees', 'trim|required|in_list[owner,user]');
		$this->form_validation->set_rules('auto_confirm', 'Payment Mode', 'trim|required|in_list[0,1]');

		if ($this->form_validation->run() === TRUE) {
			if ($this->coinpayments_model->update()) {
				$this->session->set_flashdata('success_msg', 'Settings updated with success!');
			}
			redirect(current_url());
		}
		return $this->admin_view('addons/coinpayments/index', ['config' => $this->settings, 'error_logs' => $this->errorLogs]);
	}

	public function emptyLogs()
	{
		if(!$this->check_status){
			return $this->admin_view('addons/coinpayments/install');
		}
		$this->coinpayments_model->emptyLogs();
		$this->session->set_flashdata('success_msg','Error logs deleted successfully!');
		redirect(adminRoute('coinpayments'));
	}

	public function latestWithdraws()
	{
		if (!$this->check_status) {
			return $this->admin_view('addons/coinpayments/install');
		}
		//Get settings
		$this->config->load('coinpayments');
		$CP_PV = $this->config->item('coin_pv');
		$CP_PB = $this->config->item('coin_pb');
		//Start API
		$cps_api = new CoinpaymentsAPI($CP_PV, $CP_PB, 'json');
		$result = $cps_api->GetWithdrawalHistory(25);
		if ($result['error'] !== 'ok') {
			$this->session->set_flashdata('error_msg', $result['error']);
		} else {
			$this->session->set_flashdata('withdraws', $result['result']);
		}
		redirect(adminRoute('coinpayments'));
	}

	public function install()
	{
		$this->coinpayments_model->install();
		//Update routes
		$getRoutes = file_get_contents(APPPATH . 'config/routes.php');
		$newRoutes = str_replace('$route[\'withdrawal\'][\'post\']', '//$route[\'withdrawal\'][\'post\']', $getRoutes);
		file_put_contents(APPPATH . 'config/routes.php', $newRoutes);
		$this->session->set_flashdata('success_msg', 'Addon installed with success!');
		redirect(adminRoute('coinpayments'));
	}

	public function uninstall()
	{
		$this->coinpayments_model->uninstall();
		//Update routes
		$getRoutes = file_get_contents(APPPATH . 'config/routes.php');
		$newRoutes = str_replace('//$route[\'withdrawal\'][\'post\']', '$route[\'withdrawal\'][\'post\']', $getRoutes);
		file_put_contents(APPPATH . 'config/routes.php', $newRoutes);
		$this->session->set_flashdata('success_msg', 'Addon uninstalled with success!');
		redirect(adminRoute('coinpayments'));
	}
}
