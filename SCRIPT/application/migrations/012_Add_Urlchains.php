<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Urlchains extends CI_Migration {

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
				'constraint' => 191,
			),
			'url' => array(
				'type' => 'VARCHAR',
				'constraint' => 191,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('urlchains');
		$this->db->insert('urlchains', ['name' => 'DogeChain(DOGE)', 'url' => 'https://dogechain.info/tx/']);
		$this->db->insert('urlchains', ['name' => 'Blockchain(BTC)', 'url' => 'https://www.blockchain.com/btc/tx/']);
		$this->db->insert('urlchains', ['name' => 'Etherchain(ETH)', 'url' => 'https://www.etherchain.org/tx/']);
		$this->db->insert('urlchains', ['name' => 'Litecoin Explorer(LTC)', 'url' => 'http://explorer.litecoin.net/tx/']);
		$this->db->insert('urlchains', ['name' => 'Chainso(ZEC)', 'url' => 'https://chain.so/tx/ZEC/']);
		$this->db->insert('urlchains', ['name' => 'Chainso(DASH)', 'url' => 'https://chain.so/tx/DASH/']);
	}

	public function down()
	{
		$this->dbforge->drop_table('urlchains');
	}
}
