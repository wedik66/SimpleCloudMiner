<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coinpayments_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table_name = 'addon_coinpayments';
	}

	/**
	 * Check if plugin is installed
	 * @return bool
	 */
	function checkStatus()
	{
		return $this->db->table_exists($this->table_name);
	}

	/**
	 * Get settings
	 * @return array
	 */
	function getSettings()
	{
		return $this->db->where('id', 1)->get($this->table_name)->row_array();
	}

	/**
	 * Update settings
	 * @return bool
	 */
	function update()
	{
		return $this->db->where('id', 1)->update($this->table_name, [
			'tx_fee' => $this->input->post('tx_fee', true),
			'auto_confirm' => $this->input->post('auto_confirm', true),
		]);
	}

	/**
	 * @param $withdrawal array Result array with withdrawal details
	 * @param $amount array Payment amount without fees
	 * @return mixed
	 */
	function request_withdrawal($withdrawal, $amount)
	{
		$user = $this->ion_auth->user()->row();
		$total_amount = $amount;
		$status = $withdrawal['status'] === 1 ? 'PROCESSING' : 'PENDING';
		//Create withdrawal request
		$this->db->insert('user_withdrawal', [
			'user_id' => $user->id,
			'amount' => $total_amount,
			'tx' => $withdrawal['id'],
			'status' => $status,
			'date_paid' => date('Y-m-d H:i:s'),
		]);
		//Debit user balance
		return $this->db->where('id', $user->id)->set('balance', 'balance-' . $amount, FALSE)->update('users');
	}

	/**
	 * Get withdrawal by txid
	 * @param $tx_id string Coinpayments transaction id
	 * @return array|bool
	 */
	public function get_withdrawal(string $tx_id)
	{
		return $this->db->where('tx', $tx_id)->get('user_withdrawal')->row_array();
	}

	/**
	 * Update withdraw request
	 * @param $id string Coinpayments TXID
	 * @param $txid string Blockchain TXID
	 * @return bool
	 */
	function update_withdrawal($id, $txid)
	{
		return $this->db->where('tx', $id)->update('user_withdrawal', [
			'status' => 'SUCCESS',
			'tx' => $txid,
		]);
	}

	/**
	 * Install plugin
	 */
	public function install()
	{
		//Register addon
		$this->db->insert('addons', [
			'name' => 'coinpayments'
		]);
		//Register addon menu
		$this->db->insert('addons_menu', [
			'slug' => 'coinpayments',
			'route' => 'coinpayments',
			'name' => 'Coinpayments',
			'icon' => 'fa-cube'
		]);
		//Create tables
		$this->db->query("CREATE TABLE `addon_coinpayments` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `tx_fee` ENUM('owner','user') NOT NULL DEFAULT 'user' , `auto_confirm` TINYINT(1) NOT NULL DEFAULT '1' , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
		$this->db->query("CREATE TABLE `addon_coinpayments_logs` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `user_id` INT(11) NOT NULL , `message` TEXT NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;");

		//Insert default config
		$this->db->insert('addon_coinpayments', ['tx_fee' => 'user', 'auto_confirm' => '1']);
	}

	function getErrorLogs()
	{
		return $this->db->order_by('id','DESC')->get($this->table_name.'_logs')->result_array();
	}

	function emptyLogs()
	{
		return $this->db->empty_table($this->table_name.'_logs');
	}

	function createErrorLog($message, $user)
	{
		$this->db->insert($this->table_name.'_logs',[
			'message' => $message,
			'user_id' => $user,
		]);
	}

	/**
	 * Uninstall plugin
	 */
	public function uninstall()
	{
		//Register addon
		$this->db->delete('addons', [
			'name' => 'coinpayments'
		]);
		//Register addon menu
		$this->db->delete('addons_menu', [
			'slug' => 'coinpayments'
		]);
		//Create tables
		$this->db->query("DROP TABLE `addon_coinpayments`");
		$this->db->query("DROP TABLE `addon_coinpayments_logs`");
	}
}
