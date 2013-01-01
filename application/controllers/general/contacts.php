<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends MY_MOLE_Controller {
	public function __construct(){
		parent::__construct();
	}

	
	/**
	 * submit feedback.
	 * emails the  filled form to the admin's email
	 */
	public function submit_feedback(){

		$data = $this->input->post();
		
		$this->load->library('feedback_library');
		$this->feedback_library->send($data);

		redirect('contacts');
	}


	/**
	 * generate the inner page
	 */
	public function index(){
		if($this->uri->segment(2)=='submit_feedback'){
			$this->submit_feedback();
		}

		$this->load->library('render_library');
		$this->render_library->generate_inner();

		// get the reqd. parameters
		$data = $this->links_model->get(array(
											'link'=>$this->uri->segment(1).
													'/'.
													$this->uri->segment(2)
											)
										);

		$this->load->model('contacts_model');
		$params = array(
//						'id'		=> $data[0]->row_id,
						'news_type'	=> 8,
					);
		($this->uri->segment(2))?$params['id']=$this->uri->segment(2):'';

		//get thre reqd. contents
		$page = $this->contacts_model->get($params);

		if ($this->uri->segment(2)){
			$params['id']=$this->uri->segment(2);
			$params['link_type'] = 'page';
		}

		//render it
		$this->render_library->generate_innermain($page,'contacts');


		$this->template->render();
	}
}
