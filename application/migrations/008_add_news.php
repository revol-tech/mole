<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_news extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						'`id` int(10) unsigned NOT NULL AUTO_INCREMENT',
						'`title` varchar(255) NOT NULL',
						'`content` longtext NOT NULL',
						'`title_np` varchar(255) NOT NULL',
						'`content_np` longtext NOT NULL',
						'`news_type` int(127) NOT NULL',
						'`created_by` int(11) NOT NULL',
						'`date_created` timestamp NULL DEFAULT NULL',
						'`date_published` timestamp NULL DEFAULT NULL',
						'`date_removed` timestamp NULL DEFAULT NULL',
						'`active` tinyint(4) NOT NULL DEFAULT 1',
						'`homepage` tinyint(4) NOT NULL DEFAULT 0',
						'`filename` varchar(127) null default null',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('news_type');
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
