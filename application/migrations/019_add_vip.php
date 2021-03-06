<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_vip extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
					  '`id` int(11) NOT NULL auto_increment',
					  '`filename` varchar(127) CHARACTER SET utf8 NOT NULL',
					  '`title` varchar(127) CHARACTER SET utf8 NOT NULL',
					  '`description` varchar(255) CHARACTER SET utf8 NOT NULL',
					  '`title_np` varchar(127) CHARACTER SET utf8 NOT NULL',
					  '`description_np` varchar(255) CHARACTER SET utf8 NOT NULL',
					  '`timestamp` varchar(127) CHARACTER SET utf8 NOT NULL',
					  '`created_by` int(100) NOT NULL',
					  '`date_created` timestamp NULL DEFAULT NULL',
					  '`date_published` timestamp NULL DEFAULT NULL',
					  '`file_type` varchar(127) CHARACTER SET utf8 NOT NULL',
					  '`active` tinyint default 1 '
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('active');	$this->dbforge->add_key('timestamp');
		$this->dbforge->create_table('vip');

	//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('vip');
	}
}

/* End of file 014_add_vip.php */
/* Location: ./application/migrations/014_add_vip.php */
