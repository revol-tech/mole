<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_mole_users extends CI_Migration {

	public function __construct(){
		parent::__construct();

		$this->load->dbforge();
	}


	public function up()
	{
		//--------------------------------------------
		/* create a user's basic table */
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
			'acl_id'  => array(
				'type'		=> 'INT',
				'unsigned'	=> TRUE,
				'constraint'=> '127'
			)
		));
		$this->dbforge->add_key('user_id', TRUE);
		$this->dbforge->create_table('mole_users');
		//--------------------------------------------


		//--------------------------------------------
		/* create a user's profile table */
		/**
		 * Generates the sql :
		 *	CREATE TABLE IF NOT EXISTS `users_profile` (
		 *	  `id` int(11) NOT NULL AUTO_INCREMENT,
		 *	  `group_id` int(11) NOT NULL,
		 *	  `fname` varchar(127) NOT NULL,
		 *	  `lname` varchar(127) NOT NULL,
		 *	  `date_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		 *	  `user_type` int(11) NOT NULL,
		 *	  PRIMARY KEY (`id`)
		 *	) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
		 */
		$this->dbforge->add_field(array(
			'id' => array(
				'type' 			=> 'INT',
				'unsigned' 		=> TRUE,
				'auto_increment'=> TRUE
			),
			'group_id'  => array(
				'type'		=> 'INT',
				'unsigned'	=> TRUE,
				'constraint'=> '127'
			),
			'fname' => array(
				'type' 		 => 'VARCHAR',
				'constraint' => '127'
			),
			'lname' => array(
				'type' 		 => 'VARCHAR',
				'constraint' => '127'
			),
			'user_type'	=>	array(
				'type'	=>	'int',
				'constraint'=> '11'
			),
		));
		$this->dbforge->add_field("date_joined TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users_profile');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('mole_users');

		$this->dbforge->drop_table('users_profile');
	}
}

/* End of file 001_add_mole_users.php */
/* Location: ./application/migrations/001_add_mole_users.php */