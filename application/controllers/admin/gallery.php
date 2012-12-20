<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public $data = array();


	public function __construct(){
		parent::__construct();

		chk_admin();

		$this->load->model('gallery_model');

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

		$data['items'] = $this->list_gallery();

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_album.php',$data);
		$this->load->view('templates/footer');
	}


	/**
	 * list all albums in the gallery
	 */
	private function list_gallery(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/gallery/index');
		$config['total_rows'] = $this->gallery_model->record_count();
		$config['per_page'] = PAGEITEMS;


		//if there are no polls at present ...
		if($config['total_rows']==0){
			$item->id			='--';
			$item->title		='--';
			$item->title_link	='--';
			$item->date_created	='--';
			$item->created_by	= '--';
			$item->date_published='--';
			$item->no_images	='--';
			$item->edit			='--';
			$item->del			='--';

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
		$data = $this->gallery_model->get(null,$config['per_page'],$page);


		foreach($data as $key=>$val){
//echo '<pre>';
//print_r($val);
//echo '</pre>';

			$str =	'<a href="'.site_url('admin/gallery/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;


			$str =	'<a href="'.site_url('admin/gallery/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;


			$str = 	'<form method="post" action="'.site_url('admin/gallery/del/').'">'.
						'<input type="hidden" name="gallery_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;



			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;

//print_r($data[$key]);

/** //activate-deactivate not currently set for gallery
			//add activate/deactivate button			
			$str = '<form method="post" action='.site_url('admin/gallery/active').'>'.
						'<input type="hidden" name="gallery_id" value="'.$data[$key]->id.'"/>';
			if($data[$key]->active == 1){
				$str .=	'<input type="hidden" name="activate" value="false"/>';
				$str .=	'<input type="submit" name="active"   value="Deactivate"/>';
			}else{
				$str .=	'<input type="hidden" name="activate" value="true"/>';
				$str .=	'<input type="submit" name="active"   value="Activate"/>';
			}
			$str .= '</form>';

			$data[$key]->active = $str;
*/ 

			//count no. of photos in the album
			$data[$key]->no_photos = $this->gallery_model->count_photos($data[$key]->id);

		}
//echo '<pre>';
//print_r($data);
//echo'</pre>';
		return array('data'=>$data,'links'=>$this->pagination->create_links());
	}


	/**
	 * create nu album's form
	 */
	public function create(){

		//generate username, current date if creating nu events [not editing]
		if(!isset($this->data['date_created'])){
			$this->data['date_created'] = get_timestamp();
			$this->session->set_userdata('date_created',$this->data['date_created']);
		}
		if(!isset($this->data['created_by'])){
			$this->data['created_by'] = $this->ion_auth->get_user()->username;
		}else{

			//get the username of the person who created the events
		}
//print_r($this->data);
		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/create_album.php', $this->data);
		$this->load->view('templates/footer');
	}


	/**
	 * del selected gallery & its imgs
	 */
	public function del(){

		$this->gallery_model->del($this->input->post('gallery_id'));

		redirect($this->session->flashdata('redirectToCurrent'));
	}


	/**
	 * save/update gallery form
	 */
    public function save(){
		//save the gallery & return the id of that gallery
		$this->data = $this->input->post();
		unset($this->data['save']);
		$this->data['date_created'] = $this->session->userdata('date_created');
		$this->data['created_by'] = $this->ion_auth->get_user()->id;
//print_r($this->data);die;
		$this->data['id'] = $this->gallery_model->save_album($this->data);
//echo $this->data['id'];die;
		//retrive that album
		$this->get($this->data);

		//display that gallery
		redirect('admin/gallery');
	}


	/**
	 * get the selected album
	 */
	private function get($album){
		//get reqd. page's data
		$data = $this->gallery_model->get($album,null,null);


		foreach($data as $key=>$val){
			$str =	'<a href="'.site_url('admin/gallery/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;


			$str =	'<a href="'.site_url('admin/gallery/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;


			$str = 	'<form method="post" action="'.site_url('admin/gallery/del/').'">'.
						'<input type="hidden" name="gallery_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;



			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;

/*
			//add activate/deactivate button
			$str = '<form method="post" action='.site_url('admin/gallery/active').'>'.
						'<input type="hidden" name="gallery_id" value="'.$data[$key]->id.'"/>';
			if($data[$key]->active == 1){
				$str .=	'<input type="hidden" name="activate" value="false"/>';
				$str .=	'<input type="submit" name="active"   value="Deactivate"/>';
			}else{
				$str .=	'<input type="hidden" name="activate" value="true"/>';
				$str .=	'<input type="submit" name="active"   value="Activate"/>';
			}
			$str .= '</form>';
*/
			$data[$key]->active = $str;
		}
	}


	/**
	 * view selected album
	 */
	public function view(){
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$get_gallery['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->gallery_model->get($get_gallery);
//print_r($data[0]);
		if(count($data)!=1){
			show_404();
		}

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_gallery.php',$data[0]);
		$this->load->view('templates/footer');
	}


	/**
	 * images upload form + images upload & store
	 */
    public function upload_imgs(){

		if($this->input->post('upload')){
			//upload the image
			$result = $this->gallery_model->upload();
			$result['status'] = 'image uploaded';

			//get uploaded image's info.
			$this->data = array_merge($this->data,array('result'=>$result));

			redirect('admin/gallery/list_imgs');
		}


		//generate username, current date if creating nu images [not editing]
		$this->data['date_created'] = get_timestamp();
		$this->session->set_userdata('date_created',$this->data['date_created']);
		$this->data['created_by'] = $this->ion_auth->get_user()->username;


		//generate album's dropdown
		$str = $this->list_gallery();
//echo '<pre>';
//print_r($str['data']);
//echo '</pre>';	

		$albums = '<select name="album_id">';
		foreach($str['data'] as $key=>$value){
			$albums .= '<option value="'.$value->id.'">'.$value->title.'</option>';
		}
		$albums .='</select>';
		$this->data['albums'] = $albums;
//echo '<pre>';
//echo $this->data['albums'];
//echo '</pre>';	
		
		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/upload_images.php',$this->data);
		$this->load->view('templates/footer');
	}


	/**
	 * delete image
	 */
	public function del_imgs(){
//echo 'aa';
		$this->gallery_model->del_imgs(array('id'=>$this->input->post('id')));
//echo $this->session->flashdata('redirectToCurrent');
		//redirect($this->session->flashdata('redirectToCurrent'));
		redirect(site_url('admin/gallery/list_imgs'));
	}


	/**
	 * get imgs of an album
	 */
	public function get_imgs($imgs=array()){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/files/index');
		$config['total_rows'] = $this->gallery_model->count_photos(@$imgs['album_id']);
		$config['per_page'] = PAGEITEMS;


		//if no data, set then to display null
		if($config['total_rows']==0){
			$item->id			='--';
			$item->filename		='--';
			$item->title		='--';
			$item->title_link	='--';
			$item->description	='--';
			$item->album		='--';
			$item->timestamp	='--';
			$item->date_created	='--';
			$item->press_type	='--';
			$item->created_by	= '--';
			$item->date_published='--';
			$item->download		='--';
			$item->del			='--';

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
		$data = $this->gallery_model->get_imgs($imgs,$config['per_page'],$page);

		foreach($data as $key=>$val){
			//$str =	'<a href="'.site_url('admin/gallery/view/'.$val->id).'">'.
			//			$val->title.
			//		'</a>';
			//$data[$key]->title_link = $str;
			$data[$key]->title_link = $val->title;


			//$str =	'<a href="'.site_url('admin/gallery/edit/'.$val->id).'">edit</a>';
			//$data[$key]->edit = $str;


			$str = 	'<form method="post" action="'.site_url('admin/gallery/del_imgs/').'">'.
						'<input type="hidden" name="id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;



			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;

			//get the abum info
			$x = $this->gallery_model->get(array('id'=>$val->album_id));
			$data[$key]->album = @$x[0]->title;

/*
			//add activate/deactivate button
			$str = '<form method="post" action='.site_url('admin/gallery/active').'>'.
						'<input type="hidden" name="gallery_id" value="'.$data[$key]->id.'"/>';
			if($data[$key]->active == 1){
				$str .=	'<input type="hidden" name="activate" value="false"/>';
				$str .=	'<input type="submit" name="active"   value="Deactivate"/>';
			}else{
				$str .=	'<input type="hidden" name="activate" value="true"/>';
				$str .=	'<input type="submit" name="active"   value="Activate"/>';
			}
			$str .= '</form>';

			$data[$key]->active = $str;
*/ 
		}
		return array('data'=>$data,'links'=>$this->pagination->create_links());
	}

	public function list_imgs(){
		$data = $this->get_imgs();
//echo '<pre>';
//print_r($data);
//echo '</pre>';

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_images.php',$data);
		$this->load->view('templates/footer');
	}



	public function update_imgs(){}
}
