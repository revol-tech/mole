<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_files extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						'`id` int(11) NOT NULL AUTO_INCREMENT',
						'`filename` varchar(127) NOT NULL',
						'`title` varchar(127) NOT NULL',
						'`description` varchar(255) NOT NULL',
						'`title` varchar(127) NOT NULL',
						'`description` varchar(255) NOT NULL',
						'`timestamp` varchar(127) NOT NULL',
						'`created_by` int(11) NOT NULL',
						'`date_created` timestamp NULL DEFAULT NULL',
						'`date_published` timestamp NULL DEFAULT NULL',
						'`file_type` varchar(11) null',
						'`album_id` int(11) default null',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('timestamp');
		$this->dbforge->create_table('files');

	//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('files');
	}
}

/* End of file 014_add_files.php */
/* Location: ./application/migrations/014_add_files.php */
