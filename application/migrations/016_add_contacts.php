<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_contacts extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						 '`id` int(11) NOT NULL',
              '`title` varchar(127) CHARACTER SET utf8 NOT NULL',
              '`content` varchar(255) CHARACTER SET utf8 NOT NULL',
              '`usefullinks_type` int(127) NOT NULL',
              '`created_by` int(11) NOT NULL',
              '`date_created` timestamp NULL DEFAULT NULL',
              '`date_published` timestamp NULL DEFAULT NULL',
              '`date_removed` timestamp NULL DEFAULT NULL',
              '`active` tinyint(4) NOT NULL',
              '`homepage` tinyint(4) NOT NULL'
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('contacts');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('contacts');
	}
}

/* End of file 007_add_contacts.php */
/* Location: ./application/migrations/008_add_contacts.php */
