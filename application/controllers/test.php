<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_CI_Controller {

	public function __construct(){
		parent::__construct();

		//counter
		set_count_visitors();

	}

	public function index($params = array()){
		echo 'asdfasdf';
	}	
}
