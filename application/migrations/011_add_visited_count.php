<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_visited_count extends CI_Migration {

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
			)
		);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('visited_count');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('visited_count');
	}
}

/* End of file 011_add_visited_count.php */
/* Location: ./application/migrations/011_add_visited_count.php */