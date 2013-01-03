<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_links extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}

	public function up()
	{
		$fields = array(
						'`id` int(11) NOT NULL AUTO_INCREMENT',
						'`link` VARCHAR( 127 ) NOT NULL' ,
						'`table` varchar( 127 ) NOT NULL ',
						'`row_id` varchar( 11 ) NOT NULL',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('table');
		$this->dbforge->add_key('row_id');
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('links');

		$this->db->query('ALTER TABLE `links` ADD UNIQUE `link` ( `link` ) ');

	//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('links');
	}
}

/* End of file 022_add_links.php */
/* Location: ./application/migrations/022_add_links.php */
