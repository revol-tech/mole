<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class to be called when displaying "about us" page , 
 * or any static page for a general web surfer.
 */
class Pages extends MY_MOLE_Controller {

	public function __construct(){
		parent::__construct();
	}


	public function index(){
		$this->load->library('render_library');
		$this->render_library->render_inner();

		$data = $this->links_model->get(array(
											'link'=>$this->uri->segment(1).
													'/'.
													$this->uri->segment(2)
											)
										);
		$this->load->model('news_model');
		$params = array(
						'id'		=> $data[0]->row_id,
						'news_type'	=> 6,
						'link_type' => 'news'
					);
		$page = $this->news_model->render($params);

		$this->template->write('page',$page);



		$this->template->render();
	}
}
