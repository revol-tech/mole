<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faqs extends CI_Controller {

	protected $data = array();

	public function __construct(){

		parent::__construct();

		chk_admin();

		$this->load->helper('ckeditor');
		$this->load->model('faqs_model');

		/**
		 * set headers to prevent back after logout
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');

		//flashdata to redirect to the same page
		$this->session->set_flashdata('redirectToCurrent', current_url());
	}


	public function index(){

		$data['items'] = $this->list_faqs();
echo '<pre>';
print_r($data['items']);
echo '</pre>';

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_faqs.php',$data);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * list faqs
	 */
	public function list_faqs(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/faqs/index');
		$config['total_rows'] = $this->faqs_model->record_count();
		$config['per_page'] = PAGEITEMS;

		//if there are no faqs at present ...
		if($config['total_rows']==0){
			$item->id				= '--';
			$item->question			= '--';
			$item->question_link	= '--';
			$item->date_created		= '--';
			//$item->notices_type	= '--';
			$item->created_by		= '--';
			$item->date_published	= '--';
			$item->edit				= '--';
			$item->del				= '--';

			$data['items'] = $item;
			return array('data'=>array($item));
		}

		//get reqd page number
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='index'){
				$config['uri_segment'] = $key+1;
				break;
			}
		}
		$this->pagination->initialize($config);
		isset($config['uri_segment'])?'':$config['uri_segment']=$this->uri->total_segments();
		$page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
		//echo $page;

		//get reqd. page's data
		$data = $this->faqs_model->get(array(),$config['per_page'],$page);


		foreach($data as $key=>$val){
			$str =	'<a href="'.site_url('admin/faqs/view/'.$val->id).'">'.
						$val->question.
					'</a>';
			$data[$key]->question_link = $str;


			$str =	'<a href="'.site_url('admin/faqs/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;


			$str = 	form_open(site_url('admin/faqs/del/')).
						'<input type="hidden" name="faqs_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;


			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;


//			//add activate/deactivate button
//			$str = form_open(site_url('admin/faqs/active/')).
//						'<input type="hidden" name="notices_id" value="'.$data[$key]->id.'"/>';
//			if($data[$key]->active == 1){
//				$str .=	'<input type="hidden" name="activate" value="false"/>';
//				$str .=	'<input type="submit" name="active"   value="Deactivate"/>';
//			}else{
//				$str .=	'<input type="hidden" name="activate" value="true"/>';
//				$str .=	'<input type="submit" name="active"   value="Activate"/>';
//			}
//			$str .= '</form>';

			$data[$key]->active = $str;
		}
print_r($data);
		return array('data'=>$data,'links'=>$this->pagination->create_links());
	}



	/**
	 * faqs form
	 */
    public function create(){
		//generate WYSIWYG editor
		$this->_ckeditor_conf();
		$this->data['generated_editor'] = display_ckeditor($this->data['ckeditor']);

		//generate username, current date if creating nu notices [not editing]
		if(!isset($this->data['date_created'])){
			$this->data['date_created'] = get_timestamp();
			$this->session->set_userdata('date_created',$this->data['date_created']);
		}
		if(!isset($this->data['created_by'])){
			$this->data['created_by'] = $this->ion_auth->get_user()->username;
		}else{

			//get the username of the person who created the notices
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
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/create_faqs.php', $this->data);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * save/update faqs form
	 */
    public function save(){
		//save the faqs & return the id of that faqs
		$this->data['date_created'] = $this->session->userdata('date_created');
		$this->data['id'] = $this->faqs_model->save();

		//retrive that faqs
		$this->get(array('id'=> $this->data['id']));

		//display that faqs
		$this->create();
	}


	/**
	 * get the [seleccted] faqs
	 */
	public function get($faqs_array=null){

		$data = $this->faqs_model->get($faqs_array);
//print_r(($data[0]));

		foreach($data[0] as $key=>$value){
			$this->data[$key] = $value;
		}
	}


	/**
	 * edit selected faqs
	 */
	public function edit(){
		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='edit'){
				$id = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->faqs_model->get(array('id'=>$id));

		if(count((array)$data)!=1){
			show_404();
		}

		$this->data = (array)$data[0];
		$this->create();
	}


	/**
	 * view selected faqs
	 */
	public function view(){
		$id=false;
		//$get_notices = array('news_type'=>$this->type);
		$get_faqs = array();

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$get_faqs['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->faqs_model->get($get_faqs);

		if(count($data)!=1){
			show_404();
		}

//print_r($data[0]);

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_faqs.php',$data[0]);
		$this->load->view('templates/admin_footer');
	}


	
//	/**
//	 * activate/deactivate faqs
//	 */
//	public function active(){
//		$id = $this->input->post('faqs_id');
//		$active = $this->input->post('activate');
//		$this->notices_model->change_active($id,$active);
//
//		redirect('admin/faqs');
//	}


	/**
	 * del selected faqs
	 */
	public function del(){
		$this->faqs_model->del_faqs($this->input->post('faqs_id'));

		redirect('admin/faqs');
	}



	/**
	 * ckEditor's configurations.
	 */
	private function _ckeditor_conf(){
		//Ckeditor's configuration
		$this->data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'answer',
			'path'	=>	CKEDITOR,
		);
	}
}
