<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_chat extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$this->dbforge->add_field(array(
				'id' => array(
					'type' 			=> 'INT',
					'unsigned' 		=> TRUE,
					'auto_increment'=> TRUE
				),
				'timestamp'=>array(
					'type'		=> 'timestamp',
					'null'		=> true
				),
				'message' => array(
					'type' 		 => 'text',
				),
				'user_id'=>array(
					'type'		=> 'int',
					'constraint'=> '11',
				),
				'acl_group_id'=>array(
					'type'		=>'int',
					'constraint'=>'11'
				),
			)
		);

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