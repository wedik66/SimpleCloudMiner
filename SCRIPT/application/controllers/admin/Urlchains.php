<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Urlchains extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->is_admin_loggedin();
		$this->load->model('blockchains_model');
	}

	public function index()
    {
		$results = $this->admin_paginate('blockchains_model',adminRoute('urlchains'));
		$this->admin_view('urlchains/list', [
			'items' => $results['items'],
			'pagination_links' => $results['links'],
		]);
    }

    public function create()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('url', 'Url', 'trim|required|valid_url');

		if ($this->form_validation->run() === TRUE) {
			if($this->blockchains_model->create()){
				$this->session->set_flashdata('success_msg','New Blockchain created with success!');
				redirect(adminRoute('urlchains'));
			}
			redirect(current_url());
		}

		$this->admin_view('urlchains/add');
	}

    public function edit($id)
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('url', 'Url', 'trim|required|valid_url');

		if ($this->form_validation->run() === TRUE) {
			if($this->blockchains_model->update($id)){
				$this->session->set_flashdata('success_msg','Blockchain updated with success!');
				redirect(adminRoute('urlchains'));
			}
			redirect(current_url());
		}

		$this->admin_view('urlchains/edit',[
			'item' => $this->blockchains_model->getById('urlchains',$id)
		]);
	}

    public function delete($id)
	{
		if($this->blockchains_model->delete($id)){
			$this->session->set_flashdata('success_msg','Blockchain deleted with success!');
		}
		redirect(adminRoute('urlchains'));
	}
}
