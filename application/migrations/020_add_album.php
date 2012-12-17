<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_album extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						  '`id` int(11) NOT NULL AUTO_INCREMENT',
						  '`title` varchar(127) NOT NULL',
						  '`description` varchar(255) NOT NULL',
						  '`created_by` int(11) NOT NULL',
						  '`date_created` timestamp NULL DEFAULT NULL',
						  '`date_published` timestamp NULL DEFAULT NULL',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('album');

	//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('album');
	}
}

/* End of file 020_add_album.php */
/* Location: ./application/migrations/020_add_album.php */