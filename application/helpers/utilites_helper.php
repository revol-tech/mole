<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//get nu db's timestamp
if ( ! function_exists('get_timestamp')) {

	function get_timestamp(){
		$CI =& get_instance();
		$timestamp = $CI->db->query('select timestamp(now()) as timestamp');
		$tmp = $timestamp->result();
		return $tmp[0]->timestamp;
	}
}


//store count unique visiors
if ( ! function_exists('set_count_visitors')) {

	function set_count_visitors(){
		$CI =& get_instance();
		
		$sql = 'INSERT IGNORE INTO `mole`.`visited_count` (`ip_address`) VALUES '.
				'("'.$CI->input->ip_address().'");';

		$CI->db->query($sql);
	}
}


//display count unique visiors
if ( ! function_exists('get_count_visitors')) {

	function get_count_visitors(){
		$CI =& get_instance();
		
		return $CI->db->count_all_results('visited_count');
	}
}
/* End of file utilites_helper.php */
/* Location: ./application/helper/utilites_helper.php */
