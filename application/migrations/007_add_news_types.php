<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_news_types extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						'`id` int(10) unsigned NOT NULL AUTO_INCREMENT',
						'`name` varchar(127) NOT NULL',
						'`comments` varchar(255) NOT NULL',
					);
		$this->dbforge->add_field($fields);

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