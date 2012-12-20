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

CREATE TABLE IF NOT EXISTS `mole_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `ip_address` char(16) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
		 */
/*		$this->dbforge->add_field(array(
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
*/
		$fields = array(
//			'id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT',
//			'username VARCHAR(10) DEFAULT NULL',
//			'password VARCHAR(50) DEFAULT NULL'
			'`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT',
			'`group_id` mediumint(8) unsigned NOT NULL',
			'`ip_address` char(16) NOT NULL',
			'`username` varchar(15) NOT NULL',
			'`password` varchar(40) NOT NULL',
			'`salt` varchar(40) DEFAULT NULL',
			'`email` varchar(254) NOT NULL',
			'`activation_code` varchar(40) DEFAULT NULL',
			'`forgotten_password_code` varchar(40) DEFAULT NULL',
			'`remember_code` varchar(40) DEFAULT NULL',
			'`created_on` int(11) unsigned NOT NULL',
			'`last_login` int(11) unsigned DEFAULT NULL',
			'`active` tinyint(1) unsigned DEFAULT NULL',
		);

		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('mole_users');
		//--------------------------------------------

		/* add adminisrator as root user */
		$sql = 'INSERT INTO `mole_users` ('.
					'`id`, `group_id`, `ip_address`, `username`, `password`,'.
					'`salt`, `email`, `activation_code`, `forgotten_password_code`,'.
					'`remember_code`, `created_on`, `last_login`, `active`'.
				') VALUES ('.
					'1, 1, \'127.0.0.1\', \'administrator\','.
					'\'59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4\', \'9462e8eee0\','.
					'\'admin@admin.com\', \'\', NULL, NULL, 1268889823,'.
					'1353601159, 1);';
		$this->db->query($sql);


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
CREATE TABLE IF NOT EXISTS `users_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(127) NOT NULL,
  `email` varchar(127) NOT NULL,
  `cv` varchar(127) DEFAULT NULL,
  `image` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
		 */
/*		$this->dbforge->add_field(array(
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
		*/
		$fields = array(
						'`id` int(10) unsigned NOT NULL AUTO_INCREMENT',
						'`fname` varchar(127) NOT NULL',
						'`lname` varchar(127) NOT NULL',
						'`email` varchar(127) NOT NULL',
						'`cv` varchar(127) DEFAULT NULL',
						'`image` varchar(127) DEFAULT NULL',
						'`phone` bigint(20) DEFAULT NULL',
						'`mobile` bigint(20) DEFAULT NULL',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users_meta');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('mole_users');

		$this->dbforge->drop_table('users_meta');
	}
}

/* End of file 001_add_mole_users.php */
/* Location: ./application/migrations/001_add_mole_users.php */
