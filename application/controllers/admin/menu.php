<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

	public $data = array();

	public function __construct(){
		parent::__construct();

		chk_admin();

		$this->load->model('menu_model');

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
		$data['items'] = $this->list_menu();

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_menu.php',$data);
		$this->load->view('templates/admin_footer');
	}

	/**
	 * fn to count the number of roots links
	 */
	private function _count_root($tmp){
		$count = 0;
		foreach($tmp as $key=>$val){
			if($val->parent_id==0 && $val->active==1){
				$count++;
			}
		}
		return $count;
	}

	/**
	 * create dropdown menu
	 */
	private function _create_dropdown($data){
		$tmp = $this->menu_model->get();
		$parent_id = '<select name="parent_id">';
		
		//limit num. of roots to less than 
		//or equal to 5 when creating nu menu
		if($this->_count_root($tmp)<5){	
			$parent_id .= '<option value="0">Root</option>';
		}
		elseif(($data!=null)&&($data['parent_id']==0)){
			$parent_id .= '<option value="0">Root</option>';			
		}
		foreach($tmp as $val){
			$parent_id .= '<option value="'.$val->id.'" ';
			if(isset($data->parent_id) && $data->parent_id==$val->id){
				$parent_id .= 'selected="selected"';
			}
			$parent_id .= '>'.$val->title.'</option>';
		}
		$parent_id .= '</select>';	
		return $parent_id;
	}

	/**
	 * disp form for new/edit menu
	 */
	public function create($data=null){
		//creating the parent drop down
		$data = (array)$data;
		$data['parent_id']=$this->_create_dropdown($data);			
		$data = (object)$data;

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');

		if($data){
			$this->load->view('admin/create_menu.php',$data);
//print_r($data);
		}else{
			$this->load->view('admin/create_menu.php');
		}

		$this->load->view('templates/admin_footer');
	}


	/**
	 * save nu menu
	 */
	public function save(){

		$data = array(
						'title' 	=> $this->input->post('title'),
						'title_np'	=> $this->input->post('title_np'),
						'comments'	=> $this->input->post('comments'),
						'comments_np'=>$this->input->post('comments_np'),
						'link'		=> $this->input->post('link'),
						'parent_id'	=> $this->input->post('parent_id'),
						'active'	=> $this->input->post('active'),
					);

		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('title_np', 'Nepali Title', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('comments', 'Comments', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('comments_np', 'Nepali Comments', 'trim|required|min_length[5]|xss_clean');
		if($this->form_validation->run()==false){
			//$this->data = $data;
			return $this->create($data);
		}

		//store new link
		if($this->input->post('id')==null){

			$this->menu_model->save($data);


		//update existing menu
		}else{
			$data['id']= $this->input->post('id');
//print_r($data);
			$this->menu_model->update($data);
		}


		redirect('admin/menu');
	}


	/**
	 * list all menus
	 */
	public function list_menu(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/menu/index');
		$config['total_rows'] = $this->menu_model->record_count();
		$config['per_page'] = PAGEITEMS;


		//if there are no polls at present ...
		if($config['total_rows']==0){
			$item->id		='--';
			$item->title	='--';
			$item->title_link='--';
			$item->link		='--';
			$item->parent_id='--';
			$item->active	='--';
			$item->comments	='--';
			$item->edit		='--';
			$item->del		='--';

			$data['items'] = $item;
			return array('data'=>array($item));
		}
//print_r($data);

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
		$data = $this->menu_model->get(null,$config['per_page'],$page);

		$prev=null;$next=null;
		foreach($data as $key=>$val){
			$str =	'<a href="'.site_url('admin/menu/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;


			$str =	'<a href="'.site_url('admin/menu/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;


			$str = 	form_open(site_url('admin/menu/del/')).//'<form method="post" action="'.site_url('admin/menu/del/').'">'.
						'<input type="hidden" name="menu_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;


			//add activate/deactivate button
			$str = form_open(site_url('admin/menu/active/')).
						'<input type="hidden" name="menu_id" value="'.$data[$key]->id.'"/>';
			if($data[$key]->active == 1){
				$str .=	'<input type="hidden" name="activate" value="false"/>';
				$str .=	'<input type="submit" name="active"   value="Deactivate"/>';
			}else{
				$str .=	'<input type="hidden" name="activate" value="true"/>';
				$str .=	'<input type="submit" name="active"   value="Activate"/>';
			}
			$str .= '</form>';

			$data[$key]->active = $str;
			
			//move positon of the link in the menu
			if(	(isset($data[$key-1]))	&& 
				($data[$key-1]->parent_id)==($data[$key]->parent_id)
			){
				$data[$key]->prev = $data[$key-1]->id;
				$data[$key]->move_up = '<a href="'.site_url('admin/menu/change/'.$data[$key]->id.'/'.$data[$key]->prev).'">&and;</a>';
			}else{$data[$key]->move_up = '&and;';}

			if(	(isset($data[$key+1]))	&& 
				($data[$key+1]->parent_id)==($data[$key]->parent_id)
			){
				$data[$key]->next = $data[$key+1]->id;
				$data[$key]->move_down 	= '<a href="'.site_url('admin/menu/change/'.$data[$key]->id.'/'.$data[$key]->next).'">&or;</a>';
			}else{$data[$key]->move_down = '&or;';}
			
		}
		return array('data'=>$data,'links'=>$this->pagination->create_links());
	}


	public function change(){
		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='change'){
				$id1 = $this->uri->segment($key+1);
				$id2 = $this->uri->segment($key+2);
				break;
			}
		}
		$data = $this->menu_model->change($id1,$id2);
//$this->index();
		redirect('admin/menu');
	}

	/**
	 * get 1 menu for editing
	 */
	public function edit(){

		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='edit'){
				$id = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->menu_model->get(array('id'=>$id));

		if(count($data)!=1){
			show_404();
		}
//print_r($data);
		$this->create($data[0]);

	}


	/**
	 * view a menu for viewing
	 */
	public function view(){
		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$id = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->menu_model->get(array('id'=>$id));

		if(count($data)!=1){
			show_404();
		}
//echo $id;
//print_r($data[0]);
		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_menu.php',$data[0]);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * activate/deactivate a menu
	 *
	 * only one menu can be active.
	 */
	public function active(){
		$active = $this->input->post('active')=='Activate'?1:0;
		$ids = $this->input->post('menu_id');
//echo $active;
//echo $this->input->post('active');

		$this->menu_model->update(array(
										'id'=>$ids,
										'active'=>$active
										)
								);

		redirect('admin/menu');
	}



	/**
	 * del selected menu
	 */
	public function del(){
//echo 'in delete polll';
		$this->menu_model->del($this->input->post('menu_id'));
		redirect('admin/menu');
	}

}
