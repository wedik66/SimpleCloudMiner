<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Settings extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'sitename' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'default' => 'DogeMiner Demo',
			),
			'keywords' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'default' => 'Keywords, here',
			),
			'description' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'default' => 'Site description here',
			),
			'pagination' => array(
				'type' => 'int',
				'constraint' => 5,
				'default' => 10,
			),
			'max_pending_transactions' => array(
				'type' => 'int',
				'constraint' => 11,
				'default' => 3,
			),
			'min_withdraw' => array(
				'type' => 'float',
				'constraint' => '20,8',
				'default' => '0.00000000',
			),
			'max_withdraw' => array(
				'type' => 'float',
				'constraint' => '20,8',
				'default' => '100.00000000',
			),
			'aff_comission' => array(
				'type' => 'int',
				'constraint' => 11,
				'default' => 2,
			),
			'currency_name' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'default' => 'Dogecoin',
			),
			'currency_symbol' => array(
				'type' => 'varchar',
				'constraint' => 5,
				'default' => 'Đ',
			),
			'currency_code' => array(
				'type' => 'varchar',
				'constraint' => 10,
				'default' => 'DOGE',
			),
			'currency_decimals' => array(
				'type' => 'int',
				'constraint' => 1,
				'default' => 8,
			),
			'coin_cur1' => array(
				'type' => 'varchar',
				'constraint' => 20,
				'default' => 'DOGE',
			),
			'coin_cur2' => array(
				'type' => 'varchar',
				'constraint' => 20,
				'default' => 'DOGE',
			),
			'coin_hash' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'default' => '3ncrypt3dh4ash@',
			),
			'coin_mode' => array(
				'type' => 'enum',
				'constraint' => ['api', 'gateway'],
				'default' => 'gateway',
			),
			'smtp_host' => array(
				'type' => 'varchar',
				'constraint' => 191,
			),
			'smtp_user' => array(
				'type' => 'varchar',
				'constraint' => 191,
			),
			'smtp_pass' => array(
				'type' => 'varchar',
				'constraint' => 191,
			),
			'smtp_port' => array(
				'type' => 'int',
				'constraint' => 10,
			),
			'smtp_secure' => array(
				'type' => 'enum',
				'constraint' => ['ssl', 'tls', 'null'],
				'default' => 'null',
			),
			'smtp_sender' => array(
				'type' => 'varchar',
				'constraint' => 191,
			),
			'facebook' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
			),
			'telegram' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
			),
			'twitter' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
			),
			'vk' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
			),
			'wallet_min' => array(
				'type' => 'int',
				'constraint' => 5,
				'default' => 20,
			),
			'wallet_max' => array(
				'type' => 'int',
				'constraint' => 5,
				'default' => 50,
			),
			'blockchain' => array(
				'type' => 'int',
				'constraint' => 11,
				'default' => 1,
			),
			'theme' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'default' => 'dogeminer',
			),
			'start_date' => array(
				'type' => 'date',
			),
			'show_start_date' => array(
				'type' => 'enum',
				'constraint' => ['yes', 'no'],
				'default' => 'no',
			),
			'start_date_increment' => array(
				'type' => 'int',
				'constraint' => 11,
				'default' => 0,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('settings');
	}

	public function down()
	{
		$this->dbforge->drop_table('settings');
	}
}
