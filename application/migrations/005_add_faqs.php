<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_faqs extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						'`id` int(10) unsigned NOT NULL AUTO_INCREMENT',
						'`faqs_type_id` int(11) NOT NULL',
						'`question` text NOT NULL',
						'`answer` mediumtext NOT NULL',
						'`created_by` int(11) NOT NULL',
						'`date_created` timestamp NULL DEFAULT NULL',
						'`date_published` timestamp NULL DEFAULT NULL',
						'`date_removed` timestamp NULL DEFAULT NULL',
						'`active` tinyint not null default 1',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('active');
		$this->dbforge->add_key('faqs_type_id');
		$this->dbforge->create_table('faqs');
		//--------------------------------------------
	}


	public function down()
	{
		$this->dbforge->drop_table('faqs');
	}
}

/* End of file 005_add_faq.php */
/* Location: ./application/migrations/005_add_faq.php */
