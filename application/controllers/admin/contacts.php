<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller {

	protected $data = array();
	protected $type = 1;

	public function __construct(){
		parent::__construct();

		chk_admin();

		$this->load->helper('ckeditor');
		$this->load->model('contacts_model');

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
		$this->view();
	}


	/**
	 * list all contacts
	 */
	public function list_contacts(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/contacts/index');
		$config['total_rows'] = $this->contacts_model->record_count($this->type);
		$config['per_page'] = PAGEITEMS;

		//if there are no contacts at present ...
		if($config['total_rows']==0){
			$item->id			= '--';
			$item->title		= '--';
			$item->title_link	= '--';
			$item->contacts_type	= '--';
			$item->created_by	= '--';
			$item->date_created	= '--';
			$item->date_published='--';
			$item->active		= '--';
			$item->edit			= '--';
			$item->del			= '--';

			$data['items'] = $item;
			return array('data'=>array($item));
		}
//print_r($data);
		return $this->view();
/*		
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
		$data = $this->contacts_model->get(array('contacts_type'=>$this->type),$config['per_page'],$page);

		foreach($data as $key=>$val){

			$str =	'<a href="'.site_url('admin/contacts/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;


			$str =	'<a href="'.site_url('admin/contacts/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;


			$str = 	'<form method="post" action="'.site_url('admin/contacts/del/').'">'.
						'<input type="hidden" name="contacts_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;


			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;


			//add activate/deactivate button
			$str = '<form method="post" action='.site_url('admin/contacts/active').'>'.
						'<input type="hidden" name="contacts_id" value="'.$data[$key]->id.'"/>';
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

		return array('data'=>$data,'links'=>$this->pagination->create_links());
*/
	}




	/**
	 * activate/deactivate contacts
	 */
	public function active(){
		$id = $this->input->post('contacts_id');
		$active = $this->input->post('activate');
		$this->contacts_model->change_active($id,$active);

		redirect('admin/contacts');
	}


	/**
	 * contacts form
	 */
    public function create(){
		//generate WYSIWYG editor
		$this->_ckeditor_conf();
		$this->data['generated_editor'] = display_ckeditor($this->data['ckeditor']);
//print_r($this->data);

		//generate username, current date if creating nu contacts [not editing]
		if(!isset($this->data['date_created'])){
			$this->data['date_created'] = get_timestamp();
			$this->session->set_userdata('date_created',$this->data['date_created']);
		}
		if(!isset($this->data['created_by'])){
			$this->data['created_by'] = $this->ion_auth->get_user()->username;
		}
		$this->data['link'] = explode('/',$this->data['link']);
		$this->data['link'] = $this->data['link'][1];

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/create_contacts.php', $this->data);
		$this->load->view('templates/admin_footer');
	}



	/**
	 * save/update contacts form
	 */
    public function save(){
		//save the contacts & return the id of that contacts
		$this->data['date_created'] = $this->session->userdata('date_created');
		$this->contacts_model->save($this->type);

		//display that contacts
		redirect('admin/contacts');
	}


	/**
	 * view selected contacts
	 */
	public function view(){

		$id=false;
		$get_contacts = array('contacts_type'=>1);

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$get_contacts['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->contacts_model->get($get_contacts);

		if(count($data)!=1){
			$data[0]=null;
		}

//print_r($data[0]);

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_contacts.php',$data[0]);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * edit selected contacts
	 */
	public function edit(){

		$data = $this->contacts_model->get();

		if(count($data)!=1){
			$data[0]=null;
		}
		$this->data = (array)$data[0];
		$this->create();
	}


	/**
	 * get the [seleccted] contacts
	 */
	public function get($contacts_array=null){

		$data = $this->contacts_model->get($contacts_array);
//print_r(($data[0]));

		foreach($data[0] as $key=>$value){
			$this->data[$key] = $value;
		}
	}


	/**
	 * del selected contacts
	 */
	public function del(){
//echo 'in delete polll';
		$this->contacts_model->del_poll($this->input->post('contacts_id'));

		redirect('admin/contacts');
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
