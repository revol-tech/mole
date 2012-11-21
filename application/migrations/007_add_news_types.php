<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_news_types extends CI_Migration {

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
				'name' => array(
					'type' 		 => 'varchar',
					'constraint' => '127'
				),
				'comments'=>array(
					'type'		=> 'varchar',
					'constraint'=> '255',
				),
			)
		);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('news_types');
		//--------------------------------------------
	}

	public function down()
	{
		$this->dbforge->drop_table('news_types');
	}
}

/* End of file 006_add_news_types.php */
/* Location: ./application/migrations/007_add_news_types.php */