<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->is_admin_loggedin();
		$this->load->model('contacts_model');
	}

	public function index()
    {
		$results = $this->admin_paginate('contacts_model',adminRoute('contact'));
		$this->admin_view('contact/list', [
			'items' => $results['items'],
			'pagination_links' => $results['links'],
		]);
    }

	public function edit($id)
	{
		$item = $this->contacts_model->getById('contact',$id);
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('reply', 'Reply Message', 'trim|min_length[4]');

		if ($this->form_validation->run() === TRUE) {
			if($this->input->post('reply')){
				//Send reply to email
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
				$this->email->from(settings('smtp_sender'), settings('sitename'));
				$this->email->to($item['email']);
				$this->email->subject('RE: '.$item['subject']);
				$this->email->message($this->input->post('reply').'<br><br>--------------------<br>'.$item['message']);
				if(!$this->email->send(false)){
					return $this->email->print_debugger(array('headers', 'subject', 'body'));
				}
			}
			if($this->contacts_model->update($id)){
				$this->session->set_flashdata('success_msg','Message updated with success!');
				redirect(adminRoute('contact'));
			}
			redirect(current_url());
		}

		$this->admin_view('contact/edit',[
			'item' => $item
		]);
	}
}
