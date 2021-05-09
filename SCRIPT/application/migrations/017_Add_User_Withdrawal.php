<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_User_Withdrawal extends CI_Migration {

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
			'type' => array(
				'type' => 'varchar',
				'constraint' => 50,
				'default' => 'payment',
			),
			'amount' => array(
				'type' => 'decimal',
				'constraint' => '20,8',
			),
			'status' => array(
				'type' => 'enum',
				'constraint' => ['PENDING', 'PROCESSING', 'SUCCESS'],
				'default' => 'PENDING',
			),
			'tx' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
			),
			'created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'date_paid' => array(
				'type' => 'timestamp',
				'null' => true,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('user_withdrawal');
	}

	public function down()
	{
		$this->dbforge->drop_table('user_withdrawal');
	}
}
