<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_news_comments extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						'`id` int(10) unsigned NOT NULL AUTO_INCREMENT',
						'`news_id` int(127) NOT NULL',
						'`content` varchar(255) NOT NULL',
						'`created_by` int(11) NOT NULL',
						'`date_created` timestamp NULL DEFAULT NULL',
						'`date_published` timestamp NULL DEFAULT NULL',
					);
		$this->dbforge->add_field($fields);

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