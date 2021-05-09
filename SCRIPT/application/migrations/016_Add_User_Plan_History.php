<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_User_Plan_History extends CI_Migration {

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
				'unsigned' => TRUE,
			),
			'plan_id' => array(
				'type' => 'int',
				'constraint' => 11,
			),
			'status' => array(
				'type' => 'varchar',
				'constraint' => 50,
				'default' => 'inactive',
			),
			'created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'expire_date' => array(
				'type' => 'timestamp',
				'null' => true,
			),
			'last_sum' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('user_plan_history');
	}

	public function down()
	{
		$this->dbforge->drop_table('user_plan_history');
	}
}
