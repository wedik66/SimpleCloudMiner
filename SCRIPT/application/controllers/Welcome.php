<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('plans_model');
		$this->load->model('statistics_model');
		$this->load->model('contacts_model');
		$this->load->helper('cookie');
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect(base_url());
	}

	public function index()
	{
		if($this->ion_auth->logged_in()){
			redirect(base_url('dashboard'));
		}
		$statistics = $this->statistics_model->index();
		$this->site_view('home',[
			'allplans' => $this->plans_model->getAll(),
			'totalUsers' => $this->ion_auth->users('members')->num_rows(),
			'totalDeposits' => $statistics['deposits'],
			'totalPaid' => $statistics['withdrawals'],
		]);
	}

	public function referral(int $unique_id)
	{
		//Verify unique_id
		if($this->plans_model->checkReferral(xss_clean($unique_id))){
			//Set cookie
			set_cookie('ref',xss_clean($unique_id),86400);
		}
		//Redirect to index
		redirect(base_url());
	}

	public function affiliate()
	{
		$this->site_view('affiliate');
	}

	public function faq()
	{
		$this->site_view('faq');
	}

	public function payouts()
	{
		$this->site_view('payouts',[
			'deposits' => $this->statistics_model->latestDeposits(),
			'withdrawals' => $this->statistics_model->latestWithdrawals(),
			'totalpayments' => $this->statistics_model->index()['withdrawals'],
		]);
	}

	public function contact()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[10]');

		if ($this->form_validation->run() === TRUE)
		{
			if($this->contacts_model->create()){
				$this->session->set_flashdata('success_msg','Message sent with success!');
				redirect(current_url());
			}
		}
		$this->site_view('contact');
	}

	public function reset_password($code)
	{
		if(!$code)
		{
			show_404();
		}
		$user = $this->ion_auth->forgotten_password_check($code);

		if($user){
			$new_password = mt_rand(10000000,90000000);
			$change = $this->ion_auth->reset_password($user->username, $new_password);
			if($change){
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
				$this->email->clear();
				$this->email->from(settings('smtp_sender'), settings('sitename'));
				$this->email->to($user->email);
				$this->email->subject(settings('sitename') . ' - New Password');
				$this->email->message('Your new password: '.$new_password);
				if(!$this->email->send(false)){
					$this->session->set_flashdata('error_msg','Unable to email the Reset Password link!');
					redirect(base_url('contact'));
				}
				$this->session->set_flashdata('success_msg','New password sent to your email!');
				redirect(base_url('contact'));
			}
			$this->session->set_flashdata('error_msg','Your account password can not be changed!');
			redirect(base_url('contact'));
		}
		$this->session->set_flashdata('error_msg','Account not found!');
		redirect(base_url('contact'));
	}
}
