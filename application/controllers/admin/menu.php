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
	}


	public function index(){
		$data['items'] = $this->list_menu();

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_menu.php',$data);
		$this->load->view('templates/footer');
	}


	/**
	 * disp form for new/edit menu
	 */
	public function create($data=false){
		//creating the parent drop down
		$tmp = $this->menu_model->get();
//print_r($tmp);
		$parent_id = '<select name="parent_id">';
		$parent_id .= '<option value="0">Root</option>';
		foreach($tmp as $val){
			$parent_id .= '<option value="'.$val->id.'" ';
			if(isset($data->parent_id) && $data->parent_id==$val->id){
				$parent_id .= 'selected="selected"';
			}
			$parent_id .= '>'.$val->title.'</option>';
		}
		$parent_id .= '</select>';
		$data->parent_id = $parent_id;


		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');

		if($data){
			$this->load->view('admin/create_menu.php',$data);
//print_r($data);
		}else{
			$this->load->view('admin/create_menu.php');
		}

		$this->load->view('templates/footer');
	}


	/**
	 * save nu menu
	 */
	public function save(){

		$data = array(
						'title' 	=> $this->input->post('title',true),
						'link'		=> $this->input->post('link',true),
						'parent_id'	=> $this->input->post('parent_id',true),
						'active'	=> $this->input->post('active',true),
						'comments'	=> $this->input->post('comments',true)
					);


		//store new link
		if($this->input->post('id')==null){

			$this->menu_model->save($data);


		//update existing menu
		}else{
			$data['id']= $this->input->post('id',true);
//print_r($data);
			$this->menu_model->update($data);
		}


		redirect('admin/menu');
	}


	/**
	 * list all menus
	 */
	public function list_menu(){

		$data = $this->menu_model->get();

		//if there are no polls at present ...
		if(!count($data)){
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
			return $data;
		}
//print_r($data);

		foreach($data as $key=>$val){
			$str =	'<a href="'.site_url('admin/menu/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;


			$str =	'<a href="'.site_url('admin/menu/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;


			$str = 	'<form method="post" action="'.site_url('admin/menu/del/').'">'.
						'<input type="hidden" name="menu_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;


			//add activate/deactivate button
			$str = '<form method="post" action='.site_url('admin/menu/active').'>'.
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
		}

		return $data;
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

//echo $id;
//print_r($data[0]);
		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_menu.php',$data[0]);
		$this->load->view('templates/footer');
	}


	/**
	 * activate/deactivate a menu
	 *
	 * only one menu can be active.
	 */
	public function active(){
		$active = $this->input->post('active',true)=='Activate'?1:0;
		$ids = $this->input->post('menu_id',true);
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
		$this->menu_model->del($this->input->post('menu_id',true));
		redirect('admin/menu');
	}

}