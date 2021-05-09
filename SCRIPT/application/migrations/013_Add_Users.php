<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Users extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'ip_address' => array(
				'type' => 'VARCHAR',
				'constraint' => 45,
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => 191,
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => 191,
				'null' => true,
			),
			'unique_id' => array(
				'type' => 'int',
				'constraint' => 6,
			),
			'balance' => array(
				'type' => 'decimal',
				'constraint' => '30,8',
				'default' => '0.00000000',
			),
			'cashouts' => array(
				'type' => 'decimal',
				'constraint' => '30,8',
				'default' => '0.00000000',
			),
			'plan_id' => array(
				'type' => 'int',
				'constraint' => 11,
				'null' => true,
			),
			'reference_user_id' => array(
				'type' => 'int',
				'constraint' => 11,
				'default' => 0,
			),
			'affiliate_earns' => array(
				'type' => 'decimal',
				'constraint' => '30,8',
				'default' => '0.00000000',
			),
			'affiliate_paid' => array(
				'type' => 'decimal',
				'constraint' => '30,8',
				'default' => '0.00000000',
			),
			'activation_selector' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
				'unique' => true,
			),
			'activation_code' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
			),
			'forgotten_password_selector' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
				'unique' => true,
			),
			'forgotten_password_code' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
			),
			'forgotten_password_time' => array(
				'type' => 'int',
				'constraint' => 11,
				'null' => true,
				'unsigned' => true,
			),
			'remember_selector' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
				'unique' => true,
			),
			'remember_code' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
			),
			'last_login' => array(
				'type' => 'int',
				'constraint' => 11,
				'null' => true,
				'unsigned' => true,
			),
			'active' => array(
				'type' => 'tinyint',
				'constraint' => 1,
				'null' => true,
				'unsigned' => true,
			),
			'created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users');
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}
}
