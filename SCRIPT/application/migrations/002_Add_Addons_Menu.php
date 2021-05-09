<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Addons_Menu extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'slug' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
			),
			'route' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
			),
			'icon' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('addons_menu');
		$this->db->insert('addons_menu',['slug' => 'demo_addon', 'name' => 'Demo Addon', 'route' => 'demo_addon', 'icon' => 'fa-cube']);
	}

	public function down()
	{
		$this->dbforge->drop_table('addons_menu');
	}
}
