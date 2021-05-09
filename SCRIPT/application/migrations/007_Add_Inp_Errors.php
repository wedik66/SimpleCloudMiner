<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Inp_Errors extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'transaction_id' => array(
				'type' => 'int',
				'constraint' => '191',
				'null' => true,
			),
			'message' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'null' => true,
			),
			'content' => array(
				'type' => 'longtext',
				'null' => true,
			),
			'status' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'null' => true,
			),
			'created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('inp_errors');
	}

	public function down()
	{
		$this->dbforge->drop_table('inp_errors');
	}
}
