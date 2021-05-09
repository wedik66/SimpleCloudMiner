<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plans extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->is_admin_loggedin();
		$this->load->model('plans_model');
	}

	public function index()
    {
    	$results = $this->admin_paginate('plans_model',adminRoute('plans'));
		$this->admin_view('plans/list', [
			'items' => $results['items'],
			'pagination_links' => $results['links'],
		]);
    }

    public function create()
	{
		$this->form_validation->set_rules('plan_name', 'Plan Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('is_default', 'Is Default', 'trim|required|integer');
		$this->form_validation->set_rules('point_per_day', 'Coin Per Day', 'trim|required|decimal');
		$this->form_validation->set_rules('version', 'Version', 'trim|required');
		$this->form_validation->set_rules('earning_rate', 'Earning Rate', 'trim|required|decimal');
		$this->form_validation->set_rules('image', 'Image File Name', 'trim|required');
		$this->form_validation->set_rules('price', 'Plan Price', 'trim|required|decimal');
		$this->form_validation->set_rules('duration', 'Plan Duration', 'trim|required|integer|greater_than_equal_to[0]');
		$this->form_validation->set_rules('profit', 'Plan Profit', 'trim|required|numeric');
		$this->form_validation->set_rules('speed', 'Mining Speed', 'trim|required|numeric');

		if ($this->form_validation->run() === TRUE) {
			if($this->plans_model->create()){
				$this->session->set_flashdata('success_msg','New plan created with success!');
				redirect(adminRoute('plans'));
			}
			redirect(current_url());
		}

		$this->admin_view('plans/add');
	}

    public function edit($id)
	{
		$this->form_validation->set_rules('plan_name', 'Plan Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('is_default', 'Is Default', 'trim|required|integer');
		$this->form_validation->set_rules('point_per_day', 'Coin Per Day', 'trim|required|decimal');
		$this->form_validation->set_rules('version', 'Version', 'trim|required');
		$this->form_validation->set_rules('earning_rate', 'Earning Rate', 'trim|required|decimal');
		$this->form_validation->set_rules('image', 'Image File Name', 'trim|required');
		$this->form_validation->set_rules('price', 'Plan Price', 'trim|required|decimal');
		$this->form_validation->set_rules('duration', 'Plan Duration', 'trim|required|integer|greater_than_equal_to[0]');
		$this->form_validation->set_rules('profit', 'Plan Profit', 'trim|required|numeric');
		$this->form_validation->set_rules('speed', 'Mining Speed', 'trim|required|numeric');

		if ($this->form_validation->run() === TRUE) {
			if($this->plans_model->update($id)){
				$this->session->set_flashdata('success_msg','Plan updated with success!');
				redirect(adminRoute('plans'));
			}
			redirect(current_url());
		}

		$this->admin_view('plans/edit',[
			'item' => $this->plans_model->getById('plans',$id)
		]);
	}

    public function delete($id)
	{
		if($this->plans_model->delete($id)){
			$this->session->set_flashdata('success_msg','Plan deleted with success!');
		}
		redirect(adminRoute('plans'));
	}
}
