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


	public function index(){


		$data['items'] = $this->list_news();
//echo '<pre>';
//print_r($data);
//echo '</pre>';

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_news.php',$data);
		$this->load->view('templates/footer');
	}


	/**
	 * list all news
	 */
	public function list_news(){

		$data = $this->news_model->get(array('news_type'=>1));

		//if there are no polls at present ...
		if(!count($data)){
			$item->id			='--';
			$item->title		='--';
			$item->news_type	='--';
			$item->created_by	= '--';
			$item->date_published='--';

			$data['items'] = $item;
			return $data;
		}
//print_r($data);

		foreach($data as $key=>$val){
			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;


			//add activate/deactivate button
			$str = '<form method="post" action='.site_url('admin/news/active').'>'.
						'<input type="hidden" name="news_id" value="'.$data[$key]->id.'"/>';
			if($data[$key]->active == 1){
				$str .=	'<input type="hidden" name="activate" value="false"/>';
				$str .=	'<input type="submit" name="active"   value="Deactivate"/>';
			}else{
				$str .=	'<input type="hidden" name="activate" value="true"/>';
				$str .=	'<input type="submit" name="active"   value="Activate"/>';
			}
			$str .= '</form>';

			$data[$key]->active = $str;
		}

		return $data;
	}


	/**
	 * activate/deactivate news
	 */
	public function active(){
		$id = $this->input->post('news_id');
		$active = $this->input->post('activate');
		$this->news_model->change_active($id,$active);

		redirect('admin/news');
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
			$this->data['created_by'] = $this->ion_auth->get_user()->username;
		}else{

			//get the username of the person who created the news
			$this->data['created_by'] = $this->ion_auth->get_user($this->data['created_by'])->username;
		}

//print_r($this->data[0]);
//array_push($this->data,$this->data[0]);
//array_push($this->data,(array)$this->data[0]);
//array_merge($this->data[0],$this->data);
//echo '<pre>';
//print_r($this->data);
//echo '</pre>';
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
	 * view selected news
	 */
	public function view(){
		$id=false;
		$get_news = array('news_type'=>1);

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$get_news['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->news_model->get($get_news);


//print_r($data[0]);

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_news.php',$data[0]);
		$this->load->view('templates/footer');
}


	/**
	 * edit selected news
	 */
	public function edit(){
		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='edit'){
				$id = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->news_model->get(array('id'=>$id));
		$this->data = (array)$data[0];
		$this->create();
	}


	/**
	 * get the [seleccted] news
	 */
	public function get($news_array=null){

		$data = $this->news_model->get($news_array);
//print_r(($data[0]));

		foreach($data[0] as $key=>$value){
			$this->data[$key] = $value;
		}
	}


	/**
	 * del selected news
	 */
	public function del(){
//echo 'in delete polll';
		$this->news_model->del_poll($this->input->post('news_id'));

		redirect('admin/news');
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