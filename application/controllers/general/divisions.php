<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Class to be called when displaying "divisions" page ,
*/
class Divisions extends MY_MOLE_Controller {

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
		//$data = $this->links_model->get(array(
		//										'link'=>$this->uri->segment(1).
		//										'/'.
		//										$this->uri->segment(2)
		//									)
		//								);
		$this->load->model('news_model');
		//$params = array(
		//					'id'	=> $data[0]->row_id,
		//					'news_type'	=> 9,
		//					// 'lang' => $this->session->userdata('lang'),
		//				);

		$params = array(
							'id'		=> $this->uri->segment(2),
							'news_type'	=> 9,
							'active'	=> 1,
							// 'lang' => $this->session->userdata('lang'),
						);
		//get thre reqd. contents
		$this->load->model('vip_model');
		$page = $this->news_model->get($params);
		$tmp = $this->vip_model->get(array('id'=>$page[0]->filename));

		$page[0]->division_img	= $tmp[0]->timestamp;
		$page[0]->person 		= $tmp[0]->title;
		$page[0]->person_post 	= $tmp[0]->description;
		$page[0]->person_np 	= $tmp[0]->title_np;
		$page[0]->person_post_np= $tmp[0]->description_np;


		//render it
		$this->render_library->generate_innermain($page[0],'divisions');

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
