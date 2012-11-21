<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_poll extends CI_Migration {

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
				'question' => array(
					'type' 		 => 'text',
				),
				'opinion1' => array(
					'type' 		 => 'text',
				),
				'opinion2' => array(
					'type' 		 => 'text',
				),
				'opinion3' => array(
					'type' 		 => 'text',
				),
				'opinion4' => array(
					'type' 		 => 'text',
				),
				'created_by'=>array(
					'type'		=> 'int',
					'constraint'=> '11',
				),
				'date_created'=>array(
					'type'		=> 'timestamp',
					'null'		=> true
				),
				'date_published'=>array(
					'type'		=> 'timestamp',
					'null'		=> true
				),
				'date_removed'=>array(
					'type'		=> 'timestamp',
					'null'		=> true
				),
				'count_opinion1' => array(
					'type' 		 => 'int',
					'constraint'=>'127'
				),
				'count_opinion2' => array(
					'type' 		 => 'int',
					'constraint'=>'127'
				),
				'count_opinion3' => array(
					'type' 		 => 'int',
					'constraint'=>'127'
				),
				'count_opinion4' => array(
					'type' 		 => 'int',
					'constraint'=>'127'
				)
			)
		);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('poll');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('poll');
	}
}

/* End of file 003_add_poll.php */
/* Location: ./application/migrations/003_add_poll.php */