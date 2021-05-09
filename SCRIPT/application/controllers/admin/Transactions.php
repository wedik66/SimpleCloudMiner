<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->is_admin_loggedin();
		$this->load->model('transactions_model');
	}

	public function index()
    {
		$results = $this->admin_paginate('transactions_model',adminRoute('transactions'));
		$this->admin_view('transactions/list', [
			'items' => $results['items'],
			'pagination_links' => $results['links'],
		]);
    }
}
