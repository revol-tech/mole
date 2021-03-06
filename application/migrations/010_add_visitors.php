<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_visitors extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						'`id` int(10) unsigned NOT NULL AUTO_INCREMENT',
						'`name` varchar(127) NOT NULL',
						'`email` varchar(127) NOT NULL',
						'`address` varchar(255) NOT NULL',
						'`ip_address` varchar(11) NOT NULL',
						'`date_created` timestamp NULL DEFAULT NULL',
						'`date_published` timestamp NULL DEFAULT NULL',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('visitors');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('visitors');
	}
}

/* End of file 010_add_visitors.php */
/* Location: ./application/migrations/010_add_visitors.php */