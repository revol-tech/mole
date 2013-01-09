<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submenu_model extends CI_Model{

	/**
	 * tablename in db which holds the submenu/links info
	 */
	private $table = 'submenu';


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

		$id = $data['id'];
		unset($data['id']);

		$this->db->where('id', (int)$id);
		$this->db->update($this->table, $data);
//echo $this->db->last_query();die;
		return $id;
	}


	/**
	 * chk for unique link & submenu title
	 */
	private function _validate(){
		$arr = array();
		if($this->input->post('link') || $this->input->post('title')){

			array_merge($arr, $this->get(array('link'=>$this->input->post('link'))));
			array_merge($arr, $this->get(array('title'=>$this->input->post('title'))));
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
		if(($this->input->post('id'))){
		//update existing link

			$data['id'] = $this->input->post('id');
			return $this->update($data);


		}else{
		//insert new link

			if(! $this->db->insert($this->table,$data)){
				return $this->db->_error_message();
			}

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

		return true;
	}


	/**
	 * change the active | inactive submenu
	 *
	 */
/**	public function active(){

		$ids=$this->input->post('submenu_id');
		$active=$this->input->post('active');


		$this->db->set(	'active',$active=='true'?1:0 )
				->where('id',$ids)
				->update($this->table);
	}
*/
}

/* End of file submenu_model.php */
/* Location: ./application/models/submenu_model.php */
