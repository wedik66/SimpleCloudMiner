<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demoaddon_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table_name = 'addon_demo';
	}

	function checkStatus()
	{
		return $this->db->table_exists($this->table_name);
	}

    public function install()
    {
		//Register addon
		$this->db->insert('addons',[
			'name' => 'demo_addon'
		]);
		//Register addon menu
		$this->db->insert('addons_menu',[
			'slug' => 'demo_addon',
			'route' => 'demo_addon',
			'name' => 'Demo Addon',
			'icon' => 'fa-cube'
		]);
		//Create tables
		$this->db->query("CREATE TABLE `addon_demo` ( `id` INT NOT NULL AUTO_INCREMENT , `key` VARCHAR(191) NOT NULL , `value` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB");
    }

	public function uninstall()
	{
		//Register addon
		$this->db->delete('addons',[
			'name' => 'demo_addon'
		]);
		//Register addon menu
		$this->db->delete('addons_menu',[
			'slug' => 'demo_addon'
		]);
		//Create tables
		$this->db->query("DROP TABLE `addon_demo`");
	}
}
