<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Groups extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
			),
			'description' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('groups');
		$this->db->insert_batch('groups',[
			['name' => 'admin', 'description' => 'Administrator'],
			['name' => 'members', 'description' => 'General User']
		]);
	}

	public function down()
	{
		$this->dbforge->drop_table('groups');
	}
}
