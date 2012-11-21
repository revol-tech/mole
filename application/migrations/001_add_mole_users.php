<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_mole_users extends CI_Migration {

	public function __construct(){
		parent::__construct();

		$this->load->dbforge();
	}


	public function up()
	{
		//--------------------------------------------
		/**
		 * Generates the sql :
		 * 	CREATE TABLE `mole_users` ( 
		 * 		`user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
		 * 		`username` VARCHAR(127) NOT NULL, 
		 * 		`password` VARCHAR(127) NOT NULL, 
		 * 		PRIMARY KEY `user_id` (`user_id`) 
		 * 	) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
		 */ 
		$this->dbforge->add_field(array(
			'user_id' => array(
				'type' 			=> 'INT',
				'unsigned' 		=> TRUE,
				'auto_increment'=> TRUE
			),
			'username' => array(
				'type' 		 => 'VARCHAR',
				'constraint' => '127'
			),
			'password' => array(
				'type' 		 => 'VARCHAR',
				'constraint' => '127'
			),
		));
		$this->dbforge->add_key('user_id', TRUE);
		$this->dbforge->create_table('mole_users');
		//--------------------------------------------
		
	}

	public function down()
	{
		$this->dbforge->drop_table('mole_users');
	}
}

/* End of file 001_add_mole_users.php */
/* Location: ./application/migrations/001_add_mole_users.php */
