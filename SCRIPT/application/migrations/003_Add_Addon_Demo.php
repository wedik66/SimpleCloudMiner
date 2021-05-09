<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Addon_Demo extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'key' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
			),
			'value' => array(
				'type' => 'TEXT',
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('addon_demo');
	}

	public function down()
	{
		$this->dbforge->drop_table('addon_demo');
	}
}
