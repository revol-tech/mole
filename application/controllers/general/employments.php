<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class to be called when displaying "about us" page , 
 * or any static page for a general web surfer.
 */
class Employments extends MY_MOLE_Controller {

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
											'link'=>$this->uri->segment(1).
													'/'.
													$this->uri->segment(2)
											)
										);
		$this->load->model('news_model');
		$params = array(
						//'id'		=> $data[0]->row_id,
						'news_type'	=> 7,
					);
		($this->uri->segment(2))?$params['id']=$this->uri->segment(2):'';
		
		//get thre reqd. contents
		$page = $this->news_model->get($params);
		if ($this->uri->segment(2)){
			$params['id']=$this->uri->segment(2);
			$params['link_type'] = 'page';
		}
		
		//render it
		$this->render_library->generate_innermain($page,($this->uri->segment(2))?'empsfull':'empslist');


		$this->template->render();
	}
}
