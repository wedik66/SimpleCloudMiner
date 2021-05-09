<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends Admin_Controller
{
	public function index()
	{
		$this->ion_auth->logout();
		redirect(adminRoute('login'));
	}
}
