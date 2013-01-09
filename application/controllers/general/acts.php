<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acts extends MY_MOLE_Controller {
	public function __construct(){
		parent::__construct();
	}

	/**
	 * generate the inner page
	 */
	public function index(){
		$this->load->library('render_library');
		$this->render_library->generate_inner();

		$this->load->model('files_model');

		//get thre reqd. contents
		$page = $this->files_model->get(array('file_type is null'=>null));
//echo '<pre>';
//print_r($page);
//echo '</pre>';		
//die;
//		if ($this->uri->segment(2)){
//			$params['id']=$this->uri->segment(2);
//			$params['link_type'] = 'page';
//		}

		//render it
		$this->render_library->generate_innermain($page,($this->uri->segment(2))?'actsfull':'actslist');

		$this->template->render();
	}
}
