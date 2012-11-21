<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_poll_history extends CI_Migration {

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
				'question_id' => array(
					'type' 		 => 'int',
				),
				'user_id' => array(
					'type' 		 => 'int',
				),
				'date_submitted' => array(
					'type' 		 => 'timestamp',
				)
			)
		);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('poll_history');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('poll_history');
	}
}

/* End of file 004_add_poll_history.php */
/* Location: ./application/migrations/004_add_poll_history.php */