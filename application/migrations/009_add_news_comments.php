<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_news_comments extends CI_Migration {

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
				'news_id'=>array(
					'type'		=> 'int',
					'constraint'=> '127',
				),
				'content' => array(
					'type' => 'varchar',
					'constraint'=> '255'
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
			)
		);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('news_comments');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('news_comments');
	}
}

/* End of file 009_add_news_comments.php */
/* Location: ./application/migrations/009_add_news_comments.php */