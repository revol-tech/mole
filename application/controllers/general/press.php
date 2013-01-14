<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Press extends MY_MOLE_Controller {
	public function __construct(){
		parent::__construct();
	}


	/**
	 * download selected press
	 */
	public function download(){

		$params = array(
						'id' =>	$this->uri->segment(3)
					);

		//get thre reqd. contents
		$this->load->model('news_model');
		$page = $this->news_model->get($params);
	
		//create pdf & download
		$this->create_pdf($page[0]);
	}


    //create & output pdf document 
    public function create_pdf($data){
		$this->load->library('html2pdf');
	
		$filename='press_id_'.$data->id.'.pdf'; 
		$section = $this->html2pdf->filename($filename);
		$this->html2pdf->paper('a4', 'portrait');
		
		
//		if($this->session->userdata('lang')=='en'){

			$this->html2pdf->html('<h1>'.$data->title.'</h1>'.$data->content);

//		}elseif($this->session->userdata('lang')=='np'){
//			$this->html2pdf->html('<h1>'.$data->title_np.'</h1>'.$data->content_np);
//		}

		$this->html2pdf->create('download');
	}


	/**
	 * generate the inner page
	 */
	public function index(){
		
		//goto download
		if($this->uri->segment(1)=='press' && $this->uri->segment(2)=='download'){
			$this->download();
			return;
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

		$this->load->model('news_model');
		$params = array(
//						'id'		=> $data[0]->row_id,
						'news_type'	=> 4,
					);
		($this->uri->segment(2))?$params['id']=$this->uri->segment(2):'';

		//get thre reqd. contents
		$page = $this->news_model->get($params);
		
		if ($this->uri->segment(2)){
			$params['id']=$this->uri->segment(2);
			$params['link_type'] = 'page';
		}

		//render it
		$this->render_library->generate_innermain($page,($this->uri->segment(2))?'pressfull':'presslist');


		$this->template->render();
	}
}
