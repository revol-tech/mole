<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * chk if a admin is logged in
 * if not, redirect to ......
 **/

if ( ! function_exists('chk_admin_logged')) {
    function chk_admin_logged(){
print_r($this->session->userdata());
		$CI =& get_instance();
		$CI->load->library('nativesession');

		if(! isset( $CI->nativesession->get('user_id')) ||
				( $CI->nativesession->get('user_id')!=1) ){

			//admin is NOT logged in.
			//redirect to somewhere else -- err page, login page, ....
			redirect('....');
		}
	}
}