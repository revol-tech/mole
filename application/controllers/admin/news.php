<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	public $data 	= 	array();

	public function __construct()
	{
		parent::__construct();

		chk_admin();

		$this->load->helper('ckeditor');
		$this->load->model('news_model');

		/**
		 * set headers to prevent back after logout
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}


	/**
	 * create nu news form
	 */
    public function create(){

		$this->_ckeditor_conf();

		$this->data['generated_editor'] = display_ckeditor($this->data['ckeditor']);

		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/create_news.php', $this->data);
		$this->load->view('templates/footer');
	}

	/**
	 * save/update news form
	 */
    public function save(){

		$data['res'] = $this->news_model->save();
//print_r($data);
		$this->create();
//		$this->load->view('admin/news_saved',$data);
	}


	public function get(){
		$this->news_model->get();
	}


	/**
	 * ckEditor's configurations.
	 */
	private function _ckeditor_conf(){
		//Ckeditor's configuration
		$this->data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	CKEDITOR,
		);
	}
}