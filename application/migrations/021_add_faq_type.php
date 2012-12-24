<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_album extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						'`id` int(11) NOT NULL AUTO_INCREMENT',
						'`title` varchar(127) NOT NULL',
						'`description` varchar(255) NOT NULL',
						'`created_by` int(11) NOT NULL',
						'`date_created` timestamp NULL DEFAULT NULL',
						'`date_published` timestamp NULL DEFAULT NULL',
						'`date_removed` timestamp NULL DEFAULT NULL',
						'`active` tinyint default 1',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('faq_type');

	//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('faq_type');
	}
}

/* End of file 021_add_faq_type.php */
/* Location: ./application/migrations/021_add_faq_type.php */
