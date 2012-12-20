<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends CI_Controller {

	public $data = array();

	public function __construct(){
		parent::__construct();

		chk_admin();

		$this->load->model('files_model','slider_model');

		/**
		 * set headers to prevent back after logout
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}


	public function index(){

		$data['items'] = $this->list_slider();

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_slider.php',$data);
		$this->load->view('templates/footer');
	}


	/**
	 * list all images
	 */
	private function list_slider(){

		//initial configurations for pagination
		$data = $this->slider_model->get(array('file_type'=>'slider'));

		//if no data, set then to display null
		if(count($data)==0){
			$item->id			='--';
			$item->filename		='--';
			$item->title		='--';
			$item->title_link	='--';
			$item->description	='--';
			$item->timestamp	='--';
			$item->date_created	='--';
			$item->press_type	='--';
			$item->created_by	= '--';
			$item->date_published='--';
			$item->download		='--';
			$item->del			='--';

			return array('data'=>array($item));
		}


		//get reqd. page's data
		$data = $this->slider_model->get(array('file_type'=>'slider'));

		//enhance data as reqd.
		foreach($data as $key=>$val){

			//href for the page
			$str =	'<a href="'.site_url('admin/slider/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;

			//del for the data
			$str = 	'<form method="post" action="'.site_url('admin/slider/del/').'">'.
						'<input type="hidden" name="slider_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;

			//download the file
			$str =	'<a href="'.site_url('admin/slider/download/'.$val->id).'">
						download
					</a>';
			$data[$key]->download = $str;


			//convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;
		}

		return array('data'=>$data,'links'=>$this->pagination->create_links());
	}


	/**
	 * slider form
	 */
    public function upload(){

		if($this->input->post('upload')){
			//upload the file
			$result = $this->slider_model->upload('slider');
			$result['status'] = 'image uploaded';

			//get uploaded file's info.
			$this->data = array_merge($this->data,array('result'=>$result));

			redirect('admin/slider');
		}


		//generate username, current date if creating nu slider [not editing]
		$this->data['date_created'] = get_timestamp();
		$this->session->set_userdata('date_created',$this->data['date_created']);
		$this->data['created_by'] = $this->ion_auth->get_user()->username;

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/upload_slider.php',$this->data);
		$this->load->view('templates/footer');
	}


	/**
	 * del selected slider
	 */
	public function del(){
		$this->slider_model->del(array('id'=>$this->input->post('slider_id')));

		redirect('admin/slider');
	}


	/**
	 * view uploaded file
	 */
	public function view(){
		$get_file = array('file_type'=>'slider');

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$get_file['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->slider_model->get($get_file);

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_slider.php',$data[0]);
		$this->load->view('templates/footer');
	}


	/**
	 * download selected file
	 */
	public function download(){
		$id=false;
		$get_file = array('file_type'=>'slider');

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='download'){
				$get_file['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->slider_model->get($get_file);

		if(count($data)!=1){
			show_404();
		}

		$this->load->helper('download');

		$file_data = file_get_contents(DOCUMENTS.$data[0]->timestamp); // Read the file's contents
		$file_name = $data[0]->filename;

		force_download($file_name, $file_data);
	}
}
