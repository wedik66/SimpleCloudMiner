<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Plans extends CI_Migration
{

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'plan_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
			),
			'is_default' => array(
				'type' => 'tinyint',
				'constraint' => 1,
				'default' => '0',
			),
			'point_per_day' => array(
				'type' => 'decimal',
				'constraint' => '20,8',
				'null' => true,
			),
			'version' => array(
				'type' => 'varchar',
				'constraint' => 30,
				'null' => true,
			),
			'earning_rate' => array(
				'type' => 'decimal',
				'constraint' => '20,8',
				'null' => true,
			),
			'image' => array(
				'type' => 'varchar',
				'constraint' => 100,
				'default' => '1.png',
			),
			'price' => array(
				'type' => 'float',
				'constraint' => '20,8',
			),
			'duration' => array(
				'type' => 'int',
				'constraint' => 11,
			),
			'profit' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'null' => true,
			),
			'speed' => array(
				'type' => 'varchar',
				'constraint' => 191,
				'default' => 1,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('plans');
		$this->db->insert('plans', array('plan_name' => 'Free Plan', 'is_default' => '1', 'point_per_day' => '0.02000000', 'version' => 'V 1.0', 'earning_rate' => '0.00001389', 'image' => '1.png', 'price' => '0.00000000', 'duration' => '1825', 'profit' => '2', 'speed' => '1'));
		$this->db->insert('plans', array('plan_name' => 'Plan V1.1', 'point_per_day' => '15.00000000', 'version' => 'V 1.1', 'earning_rate' => '0.01041667', 'image' => '2.png', 'price' => '0.03000000', 'duration' => '90', 'profit' => '5', 'speed' => '10'));
		$this->db->insert('plans', array('plan_name' => 'Plan V1.2', 'point_per_day' => '53.00000000', 'version' => 'V 1.2', 'earning_rate' => '0.03680556', 'image' => '3.png', 'price' => '1000.00000000', 'duration' => '90', 'profit' => '5.25', 'speed' => '100'));
	}

	public function down()
	{
		$this->dbforge->drop_table('plans');
	}
}
