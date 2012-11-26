<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	public $data = array();

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
	 * news form
	 */
    public function create(){
		//generate WYSIWYG editor
		$this->_ckeditor_conf();
		$this->data['generated_editor'] = display_ckeditor($this->data['ckeditor']);

		$this->load->helper('utilites_helper');

		//generate username, current date if creating nu news [not editing]
		if(!isset($this->data['date_created'])){
			$this->data['date_created'] = get_timestamp();
			$this->session->set_userdata('date_created',$this->data['date_created']);
		}
		if(!isset($this->data['created_by'])){
			//$id = $this->config->item('identity', 'ion_auth');
			//$this->data['created_by'] = $this->session->userdata($id);
			$this->data['created_by'] = $this->ion_auth->get_user()->username;
		}else{

			//get the username of the person who created the news
			$this->data['created_by'] = $this->ion_auth->get_user($this->data['created_by'])->username;
		}

echo '--------------';
echo 'created by '.$this->data['created_by'];
echo  '<br/>username '.$this->ion_auth->get_user()->username;
echo '--------------';

echo '<pre>';
print_r($this->data);
echo '</pre>';


		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/create_news.php', $this->data);
		$this->load->view('templates/footer');
	}



	/**
	 * save/update news form
	 */
    public function save(){
		//save the news & return the id of that news
		$this->data['date_created'] = $this->session->userdata('date_created');
		$this->data['id'] = $this->news_model->save();

		//retrive that news
		$this->get(array('id'=> $this->data['id']));

		//display that news
		$this->create();
	}


	/**
	 * get the [seleccted] news
	 */
	public function get($news_array=null){

		$data = $this->news_model->get($news_array);
print_r(($data[0]));

		foreach($data[0] as $key=>$value){
			$this->data[$key] = $value;
		}
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