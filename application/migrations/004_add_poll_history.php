<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_poll_history extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						'`id` int(10) unsigned NOT NULL AUTO_INCREMENT',
						'`question_id` int(11) NOT NULL',
						'`user_id` int(11) NOT NULL',
						'`date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
					);
		$this->dbforge->add_field($fields);

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