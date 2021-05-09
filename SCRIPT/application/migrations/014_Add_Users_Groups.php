<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Users_Groups extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type' => 'int',
				'constraint' => 11,
				'unsigned' => true,
			),
			'group_id' => array(
				'type' => 'mediumint',
				'constraint' => 8,
				'unsigned' => true,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users_groups');
	}

	public function down()
	{
		$this->dbforge->drop_table('users_groups');
	}
}
