<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Foreign_Keys extends CI_Migration {

	public function up()
	{
		//Add foreing keys
		$this->db->query('ALTER TABLE affiliate_history ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT');
		$this->db->query('ALTER TABLE transactions_history ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT');
		$this->db->query('ALTER TABLE user_deposits ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT');
		$this->db->query('ALTER TABLE user_plan_history ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT');
		$this->db->query('ALTER TABLE user_withdrawal ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT');
		$this->db->query('ALTER TABLE users_groups ADD UNIQUE uc_users_groups (user_id, group_id)');
		$this->db->query('ALTER TABLE users_groups ADD INDEX fk_users_groups_users1_idx (user_id)');
		$this->db->query('ALTER TABLE users_groups ADD INDEX fk_users_groups_groups1_idx (group_id)');
	}
}
