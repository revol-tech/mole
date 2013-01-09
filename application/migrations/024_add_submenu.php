<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_submenu extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						'`id` int(13) unsigned NOT NULL AUTO_INCREMENT',
						'`title_np` varchar(127) NOT NULL',
						'`comments_np` varchar(255)',
						'`title` varchar(127) NOT NULL',
						'`link` varchar(127) NOT NULL DEFAULT "#"',
						'`active` tinyint(1) not null default 1',
						'`comments` varchar(255)',
					);
					
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('menu');

		$this->db->query('ALTER TABLE `menu` ADD UNIQUE (`link`)');
		$this->db->query('ALTER TABLE `menu` ADD UNIQUE (`title`)');

	//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('menu');
	}
}

/* End of file 024_add_submenu.php */
/* Location: ./application/migrations/024_add_submenu.php */
