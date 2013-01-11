<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_organizations extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}

	public function up()
	{
		$fields = array(
						'`id` int(11) NOT NULL AUTO_INCREMENT',
						'`title` varchar(127) NOT NULL',
						'`sub_title` text NULL default null',
						'`title_np` varchar(127) NOT NULL',
						'`sub_title_np` text NULL default null',
						'`date_created` timestamp NULL DEFAULT NULL',
						'`created_by` int(11) NOT NULL',
						'`date_published` timestamp NULL DEFAULT NULL',
						'`date_removed` timestamp NULL DEFAULT NULL',
						'`active` tinyint(4) default 1',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('organizations');

		$this->db->query('ALTER TABLE `mole`.`organizations` ADD INDEX `active` ( `active` ) ');
		
	//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('organizations');
	}
}

/* End of file 023_add_organizations.php */
/* Location: ./application/migrations/023_add_organizations.php */
