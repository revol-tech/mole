<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class to be called when displaying "about us" page , 
 * or any static page for a general web surfer.
 */
class Pages extends MY_MOLE_Controller {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * generate the inner page
	 */
	public function index(){
		$this->load->library('render_library');
		
		//show introduction ONLY .....
		if($this->uri->segment(1)=='pages' && $this->uri->segment(2)=='introduction'){
			$this->introduction();
			return;
		}

		$this->render_library->generate_inner();

		// get the reqd. parameters
		$data = $this->links_model->get(array(
											'link'=>$this->uri->segment(1).
													'/'.
													$this->uri->segment(2)
											)
										);
//print_r($data);
		//get data & render if ok
//		if(count($data)){

			$this->load->model('news_model');
			$params = array(
							'id'		=> $this->uri->segment(2),
							'news_type'	=> 6,
	//						'lang'		=> $this->session->userdata('lang'),
						);
			
			//get thre reqd. contents
			$page = $this->news_model->get($params);
//echo $this->db->last_query();	
//print_r($params);		
			//render it
			$this->render_library->generate_innermain($page[0],'about');

//		}


		$this->template->render();
	}
	
	/**
	 * fn to generate organizations...
	 */
	public function introduction(){
		$this->render_library->generate_inner(array('organization'=>true));
		$this->template->render();
	}
}
