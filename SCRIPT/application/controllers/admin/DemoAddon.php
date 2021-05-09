<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DemoAddon extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->is_admin_loggedin();
		$this->load->model('demoaddon_model');
	}

	public function index()
	{
		$check_status = $this->demoaddon_model->checkStatus();
		if(!$check_status){
			return $this->admin_view('addons/demo_addon/install');
		}
		return $this->admin_view('addons/demo_addon/index');
	}

	public function install()
	{
		$this->demoaddon_model->install();
		$this->session->set_flashdata('success_msg','Addon installed with success!');
		redirect(adminRoute('demo_addon'));
	}

	public function uninstall()
	{
		$this->demoaddon_model->uninstall();
		$this->session->set_flashdata('success_msg','Addon uninstalled with success!');
		redirect(adminRoute('demo_addon'));
	}
}
