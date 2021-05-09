<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxauth extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('plans_model');
	}

	public function index()
	{
		//Validate form input
		$this->form_validation->set_rules('username', 'Wallet Address', 'required|alpha_numeric|min_length['.settings('wallet_min').']|max_length['.settings('wallet_max').']');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

		if ($this->form_validation->run() === TRUE)
		{
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);
			//Check if username exists
			if($this->ion_auth->username_check($username)){
				//Try login
				if($this->ion_auth->login($username,$password,true)){
					echo 'success';return;
				}else{
					echo $this->ion_auth->errors();return;
				}
			}else{
				$ref = $this->input->post('reference_user_id',true);
				if($ref){
					$referral = $this->users_model->getUserByUuid($ref)->id;
				}else{
					$referral = 0;
				}
				//Register user
				$register = $this->ion_auth->register(
					$this->input->post('username',true),
					$this->input->post('password',true),
					null,
					['unique_id' => random_int(10000,99999),'reference_user_id'=> $referral],
					[2]
				);
				if($register){
					//Create free plan
					$this->users_model->createFreePlan($register);
					$this->ion_auth->login($username,$password,true);
					echo 'success';return;
				}else{
					echo 'An error occurred while trying to register your account.';return;
				}
			}
		}else{
			echo validation_errors();return;
		}
	}

	public function recoverpassword()
	{
		//Validate form input
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]');

		if ($this->form_validation->run() === TRUE)
		{
			$identity = $this->ion_auth->where('username', $this->input->post('username',true))->users()->row();
			if(!$identity){
				echo 'Account not found!';
				return;
			}
			$forgotten = $this->ion_auth->forgotten_password($identity->username);
			if($forgotten){
				$this->load->library('email');
				//Config
				$config['protocol'] = 'smtp';
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['smtp_host'] = settings('smtp_host');
				$config['smtp_port'] = settings('smtp_port');
				$config['smtp_user'] = settings('smtp_user');
				$config['smtp_pass'] = settings('smtp_pass');
				$config['crlf'] = "\r\n"; //MUST USE DOUBLE QUOTES
				$config['newline'] = "\r\n"; //MUST USE DOUBLE QUOTES
				$config['smtp_crypto'] = settings('smtp_secure');
				$this->email->initialize($config);
				//Send mail
				$message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('email_forgot_password', 'ion_auth'), [
					'identity' => $forgotten['identity'],
					'forgotten_password_code' => $forgotten['forgotten_password_code']
				], TRUE);
				$this->email->clear();
				$this->email->from(settings('smtp_sender'), settings('sitename'));
				$this->email->to($identity->email);
				$this->email->subject(settings('sitename') . ' - ' . $this->lang->line('email_forgotten_password_subject'));
				$this->email->message($message);
				if(!$this->email->send(false)){
					return 'Unable to email the Reset Password link';
				}
				echo 'success';
				return;
			}
			echo $this->ion_auth->errors();
			return;
		}
		echo validation_errors();
	}
}
