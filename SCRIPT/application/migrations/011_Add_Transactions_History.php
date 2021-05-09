<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Transactions_History extends CI_Migration {

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
			'amount' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
			),
			'paid_amount' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => true,
			),
			'status' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'default' => 'pending',
			),
			'hash' => array(
				'type' => 'VARCHAR',
				'constraint' => 191,
				'null' => true,
			),
			'txid' => array(
				'type' => 'VARCHAR',
				'constraint' => 191,
				'null' => true,
			),
			'params' => array(
				'type' => 'text',
				'null' => true,
			),
			'date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('transactions_history');
	}

	public function down()
	{
		$this->dbforge->drop_table('transactions_history');
	}
}
