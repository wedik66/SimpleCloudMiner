<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdrawals extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->is_admin_loggedin();
		$this->load->model('withdrawals_model');
	}

	public function index()
    {
		$results = $this->admin_paginate('withdrawals_model',adminRoute('withdrawals'));
		$this->admin_view('withdrawals/list', [
			'items' => $results['items'],
			'pagination_links' => $results['links'],
		]);
    }

    public function edit($id)
	{
		$this->form_validation->set_rules('tx', 'Transaction ID', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			if($this->withdrawals_model->update($id)){
				$this->session->set_flashdata('success_msg','Withdrawal Request updated with success!');
				redirect(adminRoute('withdrawals'));
			}
			redirect(current_url());
		}

		$this->admin_view('withdrawals/edit',[
			'item' => $this->withdrawals_model->getWithdrawalRequest($id)
		]);
	}
}
