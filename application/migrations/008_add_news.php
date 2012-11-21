<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_news extends CI_Migration {

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
				'title' => array(
					'type' => 'varchar',
					'constraint'=> '255'
				),
				'content' => array(
					'type' 		 => 'longtext',
				),
				'news_type' => array(
					'type' 		 => 'int',
					'constraint'=>'127'
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
		$this->dbforge->create_table('news');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('news');
	}
}

/* End of file 007_add_news.php */
/* Location: ./application/migrations/008_add_news.php */