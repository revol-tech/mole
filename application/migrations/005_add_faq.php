<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_faq extends CI_Migration {

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
				'answer' => array(
					'type' 		 => 'mediumtext',
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
			)
		);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('faq');
		//--------------------------------------------
	}

	public function down()
	{
		$this->dbforge->drop_table('faq');
	}
}

/* End of file 005_add_faq.php */
/* Location: ./application/migrations/005_add_faq.php */