<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Admin_Controller
{
	public function index()
	{
		$this->admin_loggedin_redirect();

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');

		if ($this->form_validation->run() === TRUE) {
			if($this->ion_auth->login($this->input->post('username'),$this->input->post('password'))){
				$this->admin_loggedin_redirect();
			}
			$this->session->set_flashdata('error_msg',$this->ion_auth->errors());
			redirect(current_url());
		}

		$this->load->view('admin/auth/login');
	}
}
