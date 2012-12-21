<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model{

	/**
	 * tablename in db which holds the menu/links info
	 */
	private $table = 'menu';


	public function __construct(){
		parent::__construct();

		$this->load->library('form_validation');
	}


	/**
	 * update existing link
	 *
	 * @param array updated item
	 * @return int
	 */
	public function update($data){

//print_r($data);
		$id = $data['id'];
		unset($data['id']);

		$this->db->where('id', $id);
//print_r($data);
		$this->db->update($this->table, $data);

		return $id;
	}


	/**
	 * chk for unique link & menu title
	 */
	private function _validate(){
		$arr = array();
		if($this->input->post('link') || $this->input->post('title')){
//print_r(array('link'=>$this->input->post('link',true)));
//echo 'asdf';
//print_r($this->get(array('link'=>$this->input->post('link',true))));

			array_merge($arr, $this->get(array('link'=>$this->input->post('link'))));
			array_merge($arr, $this->get(array('title'=>$this->input->post('title'))));
//print_r(count($arr));
			if(count($arr) > 0){
				return false;
			}
		}

		return true;
	}


	/**
	 * store nu link
	 *
	 * @return int id
	 */
	public function save($data){
//print_r($data);die;
		if(($this->input->post('id'))){
		//update existing link

			$data['id'] = $this->input->post('id');
//print_r($data);
//print_r('asdf');
			return $this->update($data);


		}else{
		//insert new link

			if(! $this->db->insert($this->table,$data)){
				return $this->db->_error_message();
			}

//echo $this->db->last_query();
			return $this->db->insert_id();
		}
	}



	/**
	 * get link [of selected parameter]
	 */
	public function get($data=null,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}
		if(count($data)){
			foreach($data as $key=>$value){
				$this->db->where($key,$value);
			}
		}

		$res = $this->db->get($this->table);

		return $res->result();
	}


	/**
	 * render the links [droopdown menus]
	 *
	 * @return string <li><a href="...." title="...">....</a></li>
	 */
	public function render_menu(){
		$data = $this->get(array('active'=>1));

		if(count($data)==0){
			return '';
		}
		$str = '<ul class="menu sf-menu">';
		$str.=$this->_render_recursive($data,0);
		$str.='</ul>';

		return $str;
	}

	/**
	 * for recursive rendering
	 */
	private function _render_recursive($data,$parent_id){
		if(!(count($data)>0))
			return '';
		$str = $parent_id!=0?'<ul>':'';

		foreach($data as $k=>$v){
			if($v->parent_id==$parent_id){

				$str.='<li>';
				$str.='<a href="'.$v->link.'" title="'.$v->comments.'">';
				$str.=$v->title;
				$str.='</a>';

				unset($data[$k]);

				$str .= $this->_render_recursive($data,$v->id);
				$str.='</li>';
			}
		}

		$str .= $parent_id!=0?'</ul>':'';
		return $str;
	}


	/**
	 * count records
	 */
	public function record_count(){
		return $this->db->count_all($this->table);
	}


	/**
	 * delete link
	 *
	 * @param array of ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del($ids){
		$this->db->where('id',$ids)
				->or_where('parent_id',$ids)
				->delete($this->table);

//echo $this->db->last_query();
		return true;
	}


	/**
	 * change the active | inactive menu
	 *
	 */
/**	public function active(){

		$ids=$this->input->post('menu_id');
		$active=$this->input->post('active');


		$this->db->set(	'active',$active=='true'?1:0 )
				->where('id',$ids)
				->update($this->table);
	}
*/
}

/* End of file menu_model.php */
/* Location: ./application/models/menu_model.php */
