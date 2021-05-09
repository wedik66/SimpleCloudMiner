<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->is_admin_loggedin();
		$this->load->model(['settings_model','blockchains_model']);
	}

    public function index()
    {
		$this->form_validation->set_rules('sitename', 'Site Name', 'trim|required');
		$this->form_validation->set_rules('keywords', 'Site Keywords', 'trim|required');
		$this->form_validation->set_rules('theme', 'Active Theme', 'trim|required|alpha');
		$this->form_validation->set_rules('description', 'Site Description', 'trim|required');
		$this->form_validation->set_rules('pagination', 'Admin Pagination', 'trim|required|integer');
		$this->form_validation->set_rules('facebook', 'Facebook', 'trim|valid_url');
		$this->form_validation->set_rules('telegram', 'Telegram', 'trim|valid_url');
		$this->form_validation->set_rules('twitter', 'Twitter', 'trim|valid_url');
		$this->form_validation->set_rules('vk', 'Vk', 'trim|valid_url');
		$this->form_validation->set_rules('min_withdraw', 'Min. Withdrawal', 'trim|required|decimal');
		$this->form_validation->set_rules('max_withdraw', 'Max. Withdrawal', 'trim|required|decimal');
		$this->form_validation->set_rules('aff_comission', 'Affiliate Commission', 'trim|required|numeric');
		$this->form_validation->set_rules('max_pending_transactions', 'Max Pending Transactions', 'trim|required|integer');
		$this->form_validation->set_rules('currency_name', 'Currency Name', 'trim|required');
		$this->form_validation->set_rules('currency_code', 'Currency Code', 'trim|required');
		$this->form_validation->set_rules('currency_symbol', 'Currency Symbol', 'trim|required');
		$this->form_validation->set_rules('currency_decimals', 'Decimals', 'trim|required|integer');
		$this->form_validation->set_rules('wallet_min', 'Wallet Address Min Characters', 'trim|required|integer');
		$this->form_validation->set_rules('wallet_max', 'Wallet Address Max Characters', 'trim|required|integer');
		$this->form_validation->set_rules('blockchain', 'Blockchain Tracking URL', 'trim|required|integer');
		$this->form_validation->set_rules('coin_cur1', 'Site Currency', 'trim|required');
		$this->form_validation->set_rules('coin_cur2', 'Receive Currency', 'trim|required');
		$this->form_validation->set_rules('coin_hash', 'Security Hash', 'trim|required');
		$this->form_validation->set_rules('coin_mode', 'Payment Mode', 'trim|required');
		$this->form_validation->set_rules('smtp_host', 'SMTP Host', 'trim|required');
		$this->form_validation->set_rules('smtp_port', 'SMTP Port', 'trim|required|integer');
		$this->form_validation->set_rules('smtp_secure', 'SMTP Secure', 'trim|required');
		$this->form_validation->set_rules('smtp_user', 'SMTP Username', 'trim|required');
		$this->form_validation->set_rules('smtp_pass', 'SMTP Password', 'trim');
		$this->form_validation->set_rules('smtp_sender', 'SMTP Sender Email', 'trim|required');
		$this->form_validation->set_rules('show_start_date', 'Show Start Date', 'trim|required|in_list[yes,no]');
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('start_date_increment', 'Add Days', 'trim|required|numeric|greater_than_equal_to[0]');

		if ($this->form_validation->run() === TRUE) {
			if($this->ion_auth->user()->row()->id != 1){
				$this->session->set_flashdata('error_msg','You are not authorized to modify this data!');
				redirect(current_url());
			}
			if($this->settings_model->update()){
				$this->load->driver('cache',['adapter' => 'file']);
				$this->cache->save('settings',$this->settings_model->getById('settings',1), 1800); // 30min
				$this->session->set_flashdata('success_msg','Settings updated with success!');
			}
			redirect(current_url());
		}

		$this->admin_view('settings',[
			'item' => $this->settings_model->getById('settings',1),
			'urlchains' => $this->blockchains_model->getAll(),
		]);
    }
}
