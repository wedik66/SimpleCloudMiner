<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Affiliate_History extends CI_Migration {

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
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
			),
			'amount' => array(
				'type' => 'DECIMAL',
				'constraint' => '30,8',
			),
			'status' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'default' => 'paid'
			),
			'date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('affiliate_history');

	}

	public function down()
	{
		$this->dbforge->drop_table('affiliate_history');
	}
}
