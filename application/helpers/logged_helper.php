<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * chk if admin is already logged in
 * redirects to homepage if not
 **/

if ( ! function_exists('logged')) {
    function chk_admin(){

		$CI =& get_instance();

		if(!$CI->ion_auth->is_admin()){
			redirect(base_url(),'location');
		}
	}
}