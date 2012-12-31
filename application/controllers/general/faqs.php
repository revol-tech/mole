<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faqs extends MY_MOLE_Controller {
	public function __construct(){
		parent::__construct();
	}

	/**
	 * generate the inner page
	 */
	public function index(){
		$this->load->library('render_library');
		$this->render_library->generate_inner();

		// get the reqd. parameters
		$data = $this->links_model->get(array(
											'link'=>$this->uri->segment(1)
											)
										);

		$this->load->model('faqs_model');
		$params = array(
//						'id'		=> $data[0]->row_id,
//						'news_type'	=> 3,
					);

		//get thre reqd. contents
		$page = $this->faqs_model->get_type($params);
		foreach($page as $key=>$val){
			$questions = $this->faqs_model->get(array('faqs_type_id'=>$val->id));
			$val->questions = $questions;
		}
echo '<pre>';
print_r($page);		
echo '</pre>';
//die;
		//render it
		$this->render_library->generate_innermain($page,'faqs');


		$this->template->render();
	}
}
