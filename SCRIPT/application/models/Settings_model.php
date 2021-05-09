<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table_name = 'settings';
	}

    public function update()
	{
		$data = array(
			'sitename' => $this->input->post('sitename', true),
			'theme' => $this->input->post('theme', true),
			'keywords' => $this->input->post('keywords', true),
			'description' => $this->input->post('description', true),
			'pagination' => $this->input->post('pagination', true),
			'facebook' => $this->input->post('facebook', true),
			'telegram' => $this->input->post('telegram', true),
			'twitter' => $this->input->post('twitter', true),
			'vk' => $this->input->post('vk', true),
			'min_withdraw' => $this->input->post('min_withdraw', true),
			'max_withdraw' => $this->input->post('max_withdraw', true),
			'aff_comission' => $this->input->post('aff_comission', true),
			'max_pending_transactions' => $this->input->post('max_pending_transactions', true),
			'currency_name' => $this->input->post('currency_name', true),
			'currency_code' => $this->input->post('currency_code', true),
			'currency_symbol' => $this->input->post('currency_symbol', true),
			'currency_decimals' => $this->input->post('currency_decimals', true),
			'wallet_min' => $this->input->post('wallet_min', true),
			'wallet_max' => $this->input->post('wallet_max', true),
			'blockchain' => $this->input->post('blockchain', true),
			'coin_cur1' => $this->input->post('coin_cur1', true),
			'coin_cur2' => $this->input->post('coin_cur2', true),
			'coin_hash' => $this->input->post('coin_hash', true),
			'coin_mode' => $this->input->post('coin_mode', true),
			'smtp_host' => $this->input->post('smtp_host', true),
			'smtp_port' => $this->input->post('smtp_port', true),
			'smtp_secure' => $this->input->post('smtp_secure', true),
			'smtp_user' => $this->input->post('smtp_user', true),
			'smtp_sender' => $this->input->post('smtp_sender', true),
			'show_start_date' => $this->input->post('show_start_date', true),
			'start_date' => $this->input->post('start_date', true),
			'start_date_increment' => $this->input->post('start_date_increment', true),
		);
		if($this->input->post('smtp_pass')){
			$data['smtp_pass'] = $this->input->post('smtp_pass');
		}
		$this->db->where('id',1);
		return $this->db->update($this->table_name,$data);
	}
}
