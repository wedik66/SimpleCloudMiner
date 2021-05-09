<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller
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
		$total = $this->users_model->count_users();
		$limit = settings('pagination');
		$config['base_url'] = adminRoute('users');
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

		$results = $this->users_model->getAll($page*$limit,$limit);
		$pagination = $this->pagination->create_links();

		$this->admin_view('users/list', [
			'items' => $results,
			'pagination_links' => $pagination,
		]);
    }

    public function view($id)
	{
		$this->admin_view('users/view',[
			'item' => $this->users_model->getById('users',$id),
			'plans' => $this->users_model->user_plans($id),
			'withdrawals' => $this->users_model->user_withdrawals($id),
			'deposits' => $this->users_model->user_deposits($id),
			'comissions' => $this->users_model->user_comissions($id),
		]);
	}
}
