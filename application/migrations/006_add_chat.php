<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_chat extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						'`id` int(10) unsigned NOT NULL AUTO_INCREMENT',
						'`timestamp` timestamp NULL DEFAULT NULL',
						'`message` text NOT NULL',
						'`user_id` int(11) NOT NULL',
						'`group_id` int(11) NOT NULL',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('chat');
		//--------------------------------------------
	}

	public function down()
	{
		$this->dbforge->drop_table('chat');
	}
}

/* End of file 006_add_chat.php */
/* Location: ./application/migrations/006_add_chat.php */