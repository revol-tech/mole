<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Health extends CI_Controller {

	public $data = array();

	public function __construct()
	{
		parent::__construct();

		chk_admin();

		$this->load->helper('ckeditor');
		$this->load->model('news_model','health_model');

		/**
		 * set headers to prevent back after logout
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}


	public function index(){

		$data['items'] = $this->list_health();
//echo '<pre>';
//print_r($data);
//echo '</pre>';

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_health.php',$data);
		$this->load->view('templates/footer');
	}


	/**
	 * list all health
	 */
	public function list_health(){

		$data = $this->health_model->get(array('news_type'=>5));
//print_r($data);
		//if there are no polls at present ...
		if(!count($data)){
			$item->id			='--';
			$item->title		='--';
			$item->title_link		='--';
			$item->date_created	='--';
			$item->health_type	='--';
			$item->created_by	= '--';
			$item->date_published='--';
			$item->edit			='--';
			$item->del			='--';

			$data['items'] = $item;
			return $data;
		}
//print_r($data);

		foreach($data as $key=>$val){
			$str =	'<a href="'.site_url('admin/health/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;


			$str =	'<a href="'.site_url('admin/health/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;


			$str = 	'<form method="post" action="'.site_url('admin/health/del/').'">'.
						'<input type="hidden" name="health_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;



			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;


			//add activate/deactivate button
			$str = '<form method="post" action='.site_url('admin/health/active').'>'.
						'<input type="hidden" name="health_id" value="'.$data[$key]->id.'"/>';
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
	 * activate/deactivate health
	 */
	public function active(){
		$id = $this->input->post('notice_id');
		$active = $this->input->post('activate');
		$this->health_model->change_active($id,$active);

		redirect('admin/health');
	}


	/**
	 * health form
	 */
    public function create(){
		//generate WYSIWYG editor
		$this->_ckeditor_conf();
		$this->data['generated_editor'] = display_ckeditor($this->data['ckeditor']);

		$this->load->helper('utilites_helper');

		//generate username, current date if creating nu health [not editing]
		if(!isset($this->data['date_created'])){
			$this->data['date_created'] = get_timestamp();
			$this->session->set_userdata('date_created',$this->data['date_created']);
		}
		if(!isset($this->data['created_by'])){
			$this->data['created_by'] = $this->ion_auth->get_user()->username;
		}else{

			//get the username of the person who created the health
//			$this->data['created_by'] = $this->ion_auth->get_user($this->data['created_by'])->username;
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
		$this->load->view('admin/create_health.php', $this->data);
		$this->load->view('templates/footer');
	}



	/**
	 * save/update health form
	 */
    public function save(){
		//save the health & return the id of that health
		$this->data['date_created'] = $this->session->userdata('date_created');
		$this->data['id'] = $this->health_model->save(5);

		//retrive that health
		$this->get(array('id'=> $this->data['id']));

		//display that health
		$this->create();
	}



	/**
	 * view selected health
	 */
	public function view(){
		$id=false;
		$get_health = array('news_type'=>5);

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$get_health['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->health_model->get($get_health);


//print_r($data[0]);

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_health.php',$data[0]);
		$this->load->view('templates/footer');
}


	/**
	 * edit selected health
	 */
	public function edit(){
		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='edit'){
				$id = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->health_model->get(array('id'=>$id));
		$this->data = (array)$data[0];
		$this->create();
	}


	/**
	 * get the [seleccted] health
	 */
	public function get($health_array=null){

		$data = $this->health_model->get($health_array);
//print_r(($data[0]));

		foreach($data[0] as $key=>$value){
			$this->data[$key] = $value;
		}
	}


	/**
	 * del selected health
	 */
	public function del(){
//echo 'in delete polll';
		$this->health_model->del_poll($this->input->post('health_id'));

		redirect('admin/health');
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