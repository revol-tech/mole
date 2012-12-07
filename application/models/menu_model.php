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

			array_merge($arr, $this->get(array('link'=>$this->input->post('link',true))));
			array_merge($arr, $this->get(array('title'=>$this->input->post('title',true))));
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

			$data['id'] = $this->input->post('id',true);
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
	public function get($data=null){
//print_r($data);
		$res = $this->db->get($this->table,$data);
//echo $this->db->last_query();
		if(count($data)){
			foreach($data as $key=>$value){
				$this->db->where($key,$value);
			}
		}

		$res = $this->db->get($this->table);

		return $res->result();
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
}

/* End of file menu_model.php */
/* Location: ./application/models/menu_model.php */