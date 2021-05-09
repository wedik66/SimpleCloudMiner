<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ipnlogs extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->is_admin_loggedin();
		$this->load->model('ipnlogs_model');
	}

	public function index()
    {
		$results = $this->admin_paginate('ipnlogs_model',adminRoute('ipnlogs'));
		$this->admin_view('ipnlogs/list', [
			'items' => $results['items'],
			'pagination_links' => $results['links'],
		]);
    }

	public function view($id)
	{
		$this->admin_view('ipnlogs/view',[
			'item' => $this->ipnlogs_model->getById('inp_errors',$id),
		]);
	}
}
