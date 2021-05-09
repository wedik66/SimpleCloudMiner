<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->is_admin_loggedin();
		$this->load->model('users_model');
	}

	public function index()
    {
    	//Pagination
		$total = $this->users_model->count_users(1);
		$limit = settings('pagination');
		$config['base_url'] = adminRoute('admins');
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['num_links'] = 2;
		$config['use_page_numbers'] = true;
		$config['first_link'] = $this->lang->line('pagination_first_link');
		$config['first_url'] = $config['base_url'];
		$config['last_link'] = $this->lang->line('pagination_last_link');
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_close'] = '</a></li>';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);

		$page = $this->uri->segment(3)?$this->uri->segment(3)-1:0 ;

		$results = $this->users_model->getAll($page*$limit, $limit, 1);
		$pagination = $this->pagination->create_links();

		$this->admin_view('admins/list', [
			'items' => $results,
			'pagination_links' => $pagination,
		]);
    }

    public function edit($id)
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|callback_edit_unique[users.username.'.$id.']');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_edit_unique[users.email.'.$id.']');
		$this->form_validation->set_rules('password', 'Current Password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|min_length[4]|matches[new_password_confirmation]');
		$this->form_validation->set_rules('new_password_confirmation', 'Confirm New Password', 'trim|min_length[4]');

		if ($this->form_validation->run() === TRUE) {
			if($id == 1 && $this->ion_auth->user()->row()->id != 1){
				$this->session->set_flashdata('error_msg','You are not authorized to modify this account!');
				redirect(current_url());
			}
			if(!$this->users_model->check_password($id)){
				$this->session->set_flashdata('error_msg','Invalid Current Password!');
				redirect(current_url());
			}
			if($this->users_model->update($id)){
				$this->session->set_flashdata('success_msg','Admin updated with success!');
				redirect(adminRoute('admins'));
			}
			redirect(current_url());
		}

		$this->admin_view('admins/edit',[
			'item' => $this->users_model->getById('users',$id),
		]);
	}

    public function create()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'New Password', 'trim|min_length[4]|required|matches[password_confirmation]');
		$this->form_validation->set_rules('password_confirmation', 'Confirm New Password', 'trim|min_length[4]');

		if ($this->form_validation->run() === TRUE) {
			if($this->users_model->create_admin()){
				$this->session->set_flashdata('success_msg','Admin created with success!');
				redirect(adminRoute('admins'));
			}
			redirect(current_url());
		}

		$this->admin_view('admins/add');
	}

	public function remove($id)
	{
		if($id == 1){
			$this->session->set_flashdata('error_msg','You are not authorized to modify this account!');
			return redirect(adminRoute('admins'));
		}
		if($id == $this->ion_auth->user()->row()->id){
			$this->session->set_flashdata('error_msg','You can not remove your own rights!');
			return redirect(adminRoute('admins'));
		}
		if($this->ion_auth->remove_from_group(1,$id) && $this->ion_auth->add_to_group(2,$id)){
			$this->session->set_flashdata('success_msg','User successfully removed from admin group!');
			return redirect(adminRoute('admins'));
		}
	}

	public function promove($id)
	{
		if($this->ion_auth->remove_from_group(2,$id) && $this->ion_auth->add_to_group(1,$id)){
			$this->session->set_flashdata('success_msg','User successfully added to admin group!');
			return redirect(adminRoute('admins'));
		}
	}
}
