<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_events extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}

	public function up()
	{
		$fields = array(
						'`id` int(11) NOT NULL AUTO_INCREMENT',
						'`title` varchar(255) NOT NULL',
						'`contents` text(255) NULL default null',
						'`date_created` timestamp NULL DEFAULT NULL',
						'`created_by` int(11) NOT NULL',
						'`date_published` timestamp NULL DEFAULT NULL',
						'`date_removed` timestamp NULL DEFAULT NULL',
						'`active` tinyint(4) default 1',
						'`homepage` tinyint(4) default 0',
						'`filename` varchar(11) null default null ',
						'`timestamp` varchar(11) null default null',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('events');

		$this->db->query('ALTER TABLE `events` ADD INDEX `active` ( `active` ) ');
		
	//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('events');
	}
}

/* End of file 024_add_events.php */
/* Location: ./application/migrations/024_add_events.php */
