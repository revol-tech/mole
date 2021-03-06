<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_usefullinks extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
			  '`id` int(11) NOT NULL auto_increment',
              '`title` varchar(127) CHARACTER SET utf8 NOT NULL',
              '`title_np` varchar(127) CHARACTER SET utf8 NOT NULL',
              '`link` varchar(127) CHARACTER SET utf8 NOT NULL',
              '`description` varchar(255) NOT NULL',
              '`description_np` varchar(255) NOT NULL',
              '`created_by` int(11) NOT NULL',
              '`date_created` timestamp NULL DEFAULT NULL',
              '`date_published` timestamp NULL DEFAULT NULL',
              '`date_removed` timestamp NULL DEFAULT NULL',
              '`active` tinyint(4) NOT NULL',
              '`homepage` tinyint(4) NOT NULL'
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('usefullinks');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('usefullinks');
	}
}

/* End of file 015_add_usefullinks.php */
/* Location: ./application/migrations/015_add_usefullinks.php */
