<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_timestamp')) {

	//get nu db's timestamp
	function get_timestamp(){
		$CI =& get_instance();
		$timestamp = $CI->db->query('select timestamp(now()) as timestamp');
		$tmp = $timestamp->result();
		return $tmp[0]->timestamp;
	}
}

/* End of file utilites_helper.php */
/* Location: ./application/helper/utilites_helper.php */