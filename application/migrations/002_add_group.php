<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_group extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		//--------------------------------------------
		/* crates a group table */
		/**
		 * Generates the sql :
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `description` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT ;

INSERT INTO `group` (`id`, `name`, `description`) VALUES
(1, 'root', 'The super admin of the project');

		 */

		$fields = array(
						'`id` int(10) unsigned NOT NULL AUTO_INCREMENT',
						'`name` varchar(127) NOT NULL',
						'`description` varchar(127) NOT NULL',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('group');
		//--------------------------------------------

		/* add root group for administrator */
		$sql = 	'INSERT INTO `group` (`id`, `name`, `description`) VALUES '.
				'(1, \'root\', \'The super admin of the project\');';
		$this->db->query($sql);

	}

	public function down()
	{
		$this->dbforge->drop_table('group');
	}
}

/* End of file 002_add_group.php */
/* Location: ./application/migrations/002_add_group.php */