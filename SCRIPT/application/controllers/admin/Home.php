<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends  Admin_Controller
{
	public function index()
	{
		$this->is_admin_loggedin();

		$this->load->model('Statistics_model');
		$all_users = $this->ion_auth->users('members')->num_rows();
		$all_admins = $this->ion_auth->users('admin')->num_rows();
		$statistics = $this->Statistics_model->index();
		$profit = $statistics['deposits']-$statistics['withdrawals'];
		$profit_today = $statistics['deposits_today']-$statistics['withdrawals_today'];
		$this->admin_view('home', [
			'all_users' => $all_users,
			'all_admins' => $all_admins,
			'statistics' => $statistics,
			'profit' => $profit,
			'profit_today' => $profit_today,
		]);
	}
}
