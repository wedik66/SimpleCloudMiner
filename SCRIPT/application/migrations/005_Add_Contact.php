<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Contact extends CI_Migration {

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
				'constraint' => '191',
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
			),
			'subject' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
			),
			'message' => array(
				'type' => 'longtext',
			),
			'created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'status' => array(
				'type' => 'enum',
				'constraint' => array('unread', 'read', 'replied'),
				'default' => 'unread'
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('contact');
	}

	public function down()
	{
		$this->dbforge->drop_table('contact');
	}
}
