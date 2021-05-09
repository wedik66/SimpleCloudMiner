<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{
		$this->installer_view('index');
	}

	public function step1()
	{
		$data = [
			'hasErrors' => false,
			'php' => [
				'version' => '7.1.3',
				'extensions' => ['openssl', 'pdo', 'mysqli', 'mbstring', 'tokenizer', 'json', 'curl', 'ctype', 'xml', 'bcmath', 'gmp'],
			],
			'apache' => [
				'extensions' => ['mod_rewrite'],
			],
		];

		$data['supported'] = version_compare(PHP_VERSION, $data['php']['version']) >= 0 ? TRUE : FALSE;
		$this->installer_view('step1', $data);
	}

	public function step2()
	{
		$data = [
			'hasErrors' => false,
			'folders' => [
				'application/cache/' => 775,
				'application/logs/' => 775,
			],
		];

		$this->installer_view('step2', $data);
	}

	public function step3()
	{
		$this->form_validation->set_rules('db_driver', 'Confirm New Password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('db_host', 'Database Host', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('db_port', 'Database Port', 'trim|required|integer');
		$this->form_validation->set_rules('db_name', 'Database Name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('db_user', 'Database Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('db_pass', 'Database Password', 'trim|required|min_length[3]');

		if ($this->form_validation->run() === TRUE) {
			//Test connection
			$host = $this->input->post('db_host', true);
			$port = $this->input->post('db_port', true);
			$name = $this->input->post('db_name', true);
			$user = $this->input->post('db_user', true);
			$pass = $this->input->post('db_pass', true);
			$testConnection = $this->testConnection($host, $port, $name, $user, $pass);
			if ($testConnection !== TRUE) {
				$this->session->set_flashdata('error_msg', $testConnection);
			} else {
				$db_file = file_get_contents(FCPATH . 'resources/database.php');
				$newcontent = str_replace(array('HOSTNAME', 'USER', 'PASS', 'DATABASE'), array($host, $user, $pass, $name), $db_file);
				$create_db_file = file_put_contents(APPPATH . 'config/database.php', $newcontent);
				if (!$create_db_file) {
					$this->session->set_flashdata('error_msg', 'Error trying to create connection file.');
				} else {
					$importDatabase = $this->importDatabase();
					if ($importDatabase) {
						$this->session->set_userdata('database',true);
						redirect(installRoute('install/step4'));
					} else {
						$this->session->set_flashdata('error_msg', $importDatabase);
					}
				}
			}
		}
		$this->installer_view('step3');
	}

	public function step4()
	{
		if(!$this->session->has_userdata('database')){
			redirect(installRoute('install/step3'));
		}

		$this->form_validation->set_rules('sitename', 'Site Name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('app_url', 'Site URL', 'trim|required|valid_url');
		$this->form_validation->set_rules('hash', 'Security Hash', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('admin_prefix', 'Admin Route Prefix', 'trim|required|min_length[4]|alpha_numeric');
		$this->form_validation->set_rules('mail_host', 'Mail Host', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('mail_port', 'Mail Port', 'trim|required|min_length[2]|integer');
		$this->form_validation->set_rules('mail_user', 'Mail Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('mail_pass', 'Mail Password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('mail_encryption', 'Mail Encryption', 'trim|required|min_length[3]|alpha');
		$this->form_validation->set_rules('mail_sender', 'Send Mail From Address', 'trim|required|min_length[3]|valid_email');
		$this->form_validation->set_rules('merchant', 'Merchant ID', 'trim|required');
		$this->form_validation->set_rules('ipnsecret', 'IPN Secret Key', 'trim|required');
		$this->form_validation->set_rules('privatekey', 'Private Key', 'trim|alpha_numeric');
		$this->form_validation->set_rules('publickey', 'Public Key', 'trim|alpha_numeric');

		if ($this->form_validation->run() === TRUE) {
			//Insert data on settings table
			$this->load->database();
			$update_settings = $this->db->insert('settings',[
				'sitename' => $this->input->post('sitename', true),
				'coin_hash' => $this->input->post('hash', true),
				'smtp_host' => $this->input->post('mail_host', true),
				'smtp_port' => $this->input->post('mail_port', true),
				'smtp_user' => $this->input->post('mail_user', true),
				'smtp_pass' => $this->input->post('mail_pass', true),
				'smtp_secure' => $this->input->post('mail_encryption', true),
				'smtp_sender' => $this->input->post('mail_sender', true),
				'start_date' => date('Y-m-d'),
			]);
			if($update_settings){
				//Update admin_prefix config file
				$admin_prefix_file = file_get_contents(FCPATH . 'resources/admin_prefix.php');
				$new_admin_prefix = str_replace('ADMIN_PREFIX', $this->input->post('admin_prefix', true), $admin_prefix_file);
				$create_admin_prefix_file = file_put_contents(APPPATH . 'config/admin_prefix.php', $new_admin_prefix);
				if($create_admin_prefix_file){
					//Update Coinpayments file
					$coinpayments_file = file_get_contents(FCPATH . 'resources/coinpayments.php');
					$cp_content = str_replace(array('MERCHANTIDHERE','SECRETKEYHERE','PRIVATEKEYHERE','PUBLICKEYHERE'), array($this->input->post('merchant'),$this->input->post('ipnsecret'),$this->input->post('privatekey','PRIVATEKEYHERE'),$this->input->post('publickey','PUBLICKEYHERE')), $coinpayments_file);
					$create_coinpayments_file = file_put_contents(APPPATH . 'config/coinpayments.php', $cp_content);
					if($create_coinpayments_file){
						//Update config file
						$config_file = file_get_contents(FCPATH . 'resources/config.php');
						$new_config = str_replace('APP_URL', $this->input->post('app_url', true), $config_file);
						$create_config_file = file_put_contents(APPPATH . 'config/config.php', $new_config);
						if($create_config_file){
							redirect(installRoute('install/step5'));
						}else{
							$this->session->set_flashdata('error_msg', 'Error trying to create config file');
						}
					}
				}else{
					$this->session->set_flashdata('error_msg', 'Error trying to create admin_prefix file');
				}
			}else{
				$this->session->set_flashdata('error_msg', 'Error trying to insert data into database');
			}
		}
		$this->installer_view('step4');
	}

	public function step5()
	{
		if(!$this->session->has_userdata('database')){
			redirect(installRoute('install/step3'));
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|matches[password_confirmation]');
		$this->form_validation->set_rules('password_confirmation', 'Password Confirm', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|valid_email');

		if ($this->form_validation->run() === TRUE) {
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);
			$email = $this->input->post('email',true);
			//Register user
			$this->load->database();
			$this->load->library('ion_auth');
			$register = $this->ion_auth->register(
				$username,
				$password,
				$email,
				['unique_id' => random_int(10000,99999)],
				[1]
			);
			if($register){
				//$this->ion_auth->login($username,$password,true);
				$this->session->set_userdata('admin_u',$username);
				$this->session->set_userdata('admin_p',$password);
				redirect(installRoute('install/step6'));
			}
			$this->session->set_flashdata('error_msg', 'Error trying to create admin account!');
		}
		$this->installer_view('step5');
	}

	public function step6()
	{
		if(!$this->session->has_userdata('database')){
			redirect(installRoute('install/step3'));
		}

		$this->form_validation->set_rules('finish', 'Finish', 'trim|required|in_list[true]');

		if ($this->form_validation->run() === TRUE) {
			$username = $this->session->userdata('admin_u');
			$password = $this->session->userdata('admin_p');
			//Set installed status
			$config_file = file_get_contents(FCPATH . 'resources/smartyscripts.php');
			$newcontent = str_replace('FALSE', TRUE, $config_file);
			$create_config_file = file_put_contents(APPPATH . 'config/smartyscripts.php', $newcontent);
			if($create_config_file){
				//Unset install session vars
				$this->session->unset_userdata('database');
				$this->session->unset_userdata('admin_u');
				$this->session->unset_userdata('admin_p');
				//Login admin user and redirect to admin
				$this->load->database();
				$this->load->library('ion_auth');
				$this->ion_auth->login($username,$password,true);
				$admin_prefix = config_item('admin_route_prefix');
				redirect(installRoute($admin_prefix));
			}
			$this->session->set_flashdata('error_msg', 'Error trying to create installed status file');
		}
		$this->installer_view('step6');
	}

	private function installer_view($view, $data = null)
	{
		$this->load->view('install/includes/header', $data);
		$this->load->view('install/' . $view, $data);
		$this->load->view('install/includes/footer', $data);
	}

	private function testConnection($host, $port, $name, $user, $pass)
	{
		try {
			$conn = new \PDO("mysql:host=$host;port=$port;dbname=$name", $user, $pass);
			// set the PDO error mode to exception
			$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			return true;
		} catch (\PDOException $e) {
			return $e->getMessage();
		}
	}

	private function importDatabase()
	{
		$this->load->library('migration');

		if ($this->migration->current() === FALSE)
		{
			return $this->migration->error_string();
		}
		return true;
	}
}
