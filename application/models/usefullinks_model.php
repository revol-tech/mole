<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usefullinks_model extends CI_Model{

	//the table to be used in the db
	private $table = 'usefullinks';

	public function __construct(){
		parent::__construct();
	}

	/**
	 * dispay-hide the usefullinks on homepage
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function change_homepage($ids=false,$active=false,$type){

		$this->db->set(	'homepage',$active=='Activate'?1:0 )
				->where('id',$ids)
				->where('usefullinks_type',$type)
				->update($this->table);
//echo $this->db->last_query();echo '<br/>';
		$this->db->set(	'homepage',0 )
				->where('id !=',$ids)
				->where('usefullinks_type',$type)
				->update($this->table);
//echo $this->db->last_query();echo '<br/>';
	}


	/**
	 * change the active poll
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function change_active($ids=false,$active=false){

		$this->db->set(	'active',$active=='true'?1:0 )
				->where('id',$ids)
				->update($this->table);
	}


	/**
	 * update existing usefullinks
	 */
	private function update($data){
/*
Array
(
    [title] => adsfasdfasdfasdf
    [link] => ikj;oij
    [description] => ;ih;oiho
    [created_by] => 
    [date_created] => 
    [date_published] => 
    [date_removed] => 
    [active] => 
    [homepage] => 
    [id] => 0
)

		$update = array(
					   'title' 		=> $data[0],
					   'content' 	=> $data[1],
					   'date_published' => $data[3],
					   'date_removed' => $data[4]
					);
*/
		$id = $data['id'];
		unset($data['id']);
		
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);

		return $id;
	}


	/**
	 * store nu usefullinks
	 * returns the id
	 */
	public function save($type=1){
		$data = array(
				'title'			=> $this->input->post('title'),
				'link'			=> $this->input->post('link'),
				'description'	=> $this->input->post('description'),
				'created_by'	=> $this->ion_auth->get_user(),
				'date_created'	=> get_timestamp(),
				'date_published'=> $this->input->post('date_published'),
				'date_removed'	=> $this->input->post('date_removed'),
				'active'		=> $this->input->post('active'),
				'homepage'		=> $this->input->post('homepage'),
				);
/*
echo '<pre>';
print_r($data);
print_r($_POST);
echo '</pre>';
*/
		//update existing usefullinks
		if(strlen($this->input->post('id'))>0){
			$data['id'] = $this->input->post('id');

			return $this->update($data);

		//insert new usefullinks
		}else{

			if(! $this->db->insert($this->table,$data)){
				return $this->db->_error_message();
			}

			return $this->db->insert_id();
		}
	}


	/**
	 * get usefullinks [of selected parameter]
	 */
	public function get($usefullinks,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}
		if($usefullinks){
			foreach($usefullinks as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);

		foreach($res->result() as $value){
/*			
$x = $value->created_by;
$y = $this->ion_auth->get_user($x);
$y->username;
echo '<pre>';
print_r($value);
print_r($x);
print_r($y);
print_r($y->username);
echo '</pre>';
*/
//print_r($this->ion_auth->get_user($value->created_by)->username);
			$value->created_by = $this->ion_auth->get_user($value->created_by)->username;
			//$value->content = html_entity_decode($value->content,ENT_QUOTES, 'UTF-8');
		}
		return $res->result();
	}

	/**
	 * render usefullinks for display
	 */
	public function render($params=null){
		$data = $this->get($params);

		$str =	'<div class="grid_7 useful_links border_rt_gray border_lt_white">'.
				'	<h3><span>Useful</span> links</h3>'.
				'	<ul>';

		foreach($data as $key=>$val){
			$str .= '<li><a href="'.$val->link.'" title="'.$val->description.
						'">'.$val->title.'</a></li>';
		}

		$str .= '</ul></div>';

		return $str;
	}

	/**
	 * count records
	 */
	public function record_count($type){

		$x = $this->db->count_all_results($this->table);

		return $x;
	}



	/**
	 * delete usefullinks
	 *
	 * @param array of enws ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del_poll($ids){
		$this->db->where('id',$ids)
				->delete($this->table);

		return true;

	}
}

/* End of file usefullinks_model.php */
/* Location: ./application/models/usefullinks_model.php */
