<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Faqs_model extends CI_Model{

	//the table to be used in the db
	private $table = 'faqs';
	private $types = 'faqs_type';
	
	public function __construct(){
		parent::__construct();
	}

	/**
	 * get faqs [of selected parameter]
	 */
	public function get($faqs=null,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}
//print_r(count($faqs));
//print_r($faqs);		
		if(count($faqs)>0 && is_array($faqs)){
			foreach($faqs as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);

		foreach($res->result() as $value){
			$value->created_by = $this->ion_auth->get_user($value->created_by)->username;
			$value->answer = html_entity_decode($value->answer,ENT_QUOTES, 'UTF-8');
		}
//print_r($res->result());
		return $res->result();
	}


	/**
	 * store nu faqs
	 * returns the id
	 */
	public function save($type=1){
		$data = array(
					'question'		=> $this->input->post('question'),
					'answer'		=> htmlentities($this->input->post('answer')),
					'faqs_type_id'	=> $this->input->post('faqs_type_id'),
					'created_by'	=> $this->session->userdata('user_id'),
					'date_created'	=> $this->session->userdata('date_created'),
					'date_published'=> $this->input->post('date_published'),
					'date_removed'	=> $this->input->post('date_removed')
				);

		//update existing faqs
		if(($this->input->post('id'))){
			$data['id'] = $this->input->post('id');

			return $this->update($data);


		//insert new faqs
		}else{

			if(! $this->db->insert($this->table,$data)){
				return $this->db->_error_message();
			}

			return $this->db->insert_id();
		}
	}

	/**
	 * update existing faqs
	 */
	private function update($data){

		$update = array(
					   'question' 		=> $data['question'],
					   'answer' 		=> $data['answer'],
					   'faqs_type_id'	=> $data['faqs_type_id'],
					   'date_published' => $data['date_published'],
					   'date_removed' 	=> $data['date_removed']
					);

		$this->db->where('id', $data['id']);
		$this->db->update($this->table, $update);

		return $data['id'];
	}


	/**
	 * count records
	 */
	public function record_count($params=array()){
		//$this->db->where('news_type',$type);
		$x = $this->db->count_all_results($this->table);

		return $x;
	}

	/**
	 * delete faqs
	 *
	 * @param array of faqs ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del_faqs($ids){
//print_r( $ids);		
		if(is_array($ids)){
			$this->db->where_in('id',$ids);
		}else{
			$this->db->where('id',$ids);
		}
		$this->db->delete($this->table);

		return true;
	}











	/**
	 * set the active faqs
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function set_active($ids=false,$active=false){

		$this->db->set(	'active',$active=='true'?1:0 )
				->where('id',$ids)
				->update($this->table);
	}



//====================================
	/**
	 * count records
	 */
	public function record_count_type($params=array()){
		//$this->db->where('news_type',$type);
		$x = $this->db->count_all_results($this->types);

		return $x;
	}
	public function set_active_type($ids=false,$active=false){
		$ids ? $this->db->where('id',$ids) : '';

		$this->db->set(	'active',$active )
				->update($this->types);
	}
	public function get_type($faqs_type=null,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}

		if($faqs_type){
			foreach($faqs_type as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->types);

		foreach($res->result() as $value){
//print_r($value);echo $value->created_by;			
//print_r($this->ion_auth->get_user($value->created_by));
			$value->created_by = $this->ion_auth->get_user($value->created_by)->username;
			$value->description = html_entity_decode($value->description,ENT_QUOTES, 'UTF-8');
		}
//print_r($res->result());
		return $res->result();
	}

	/**
	 * store nu faqs type
	 * returns the id
	 */
	public function save_type($type=1){		
		$data = array(
					'title'			=> $this->input->post('title'),
					'description'	=> htmlentities($this->input->post('description')),
					'created_by'	=> $this->session->userdata('user_id'),
					'date_created'	=> $this->session->userdata('date_created'),
					'date_published'=> $this->input->post('date_published'),
					'date_removed'	=> $this->input->post('date_removed')
				);
//print_r($data);
		//update existing faqs type
		if(($this->input->post('id'))){
			$data['id'] = $this->input->post('id');

			return $this->update_type($data);


		//insert new faqs type
		}else{

			if(! $this->db->insert($this->types,$data)){
				return $this->db->_error_message();
			}

			return $this->db->insert_id();
		}
	}

	/**
	 * update existing faqs type
	 */
	private function update_type($data){

		$update = array(
					   'title' 			=> $data['title'],
					   'description'	=> $data['description'],
					   'date_published' => $data['date_published'],
					   'date_removed' 	=> $data['date_removed']
					);

		$this->db->where('id', $data['id']);

		$this->db->update($this->types, $update);

		return $data['id'];
	}

	/**
	 * delete faqs type
	 *
	 * @param array of faqs type ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del_type($ids){
		$data = $this->get(array('faqs_type_id'=>$ids));

		$to_del_faqs = array();
		if(count($data)>0){
			foreach($data as $key=>$val){
				array_push($to_del_faqs,$val->id);
			}
			$this->del_faqs($to_del_faqs);
		}
		
		$this->db->where('id',$ids)
				->delete($this->types);
//echo $this->db->last_query();
		return true;
	}
//====================================


	/**
	 * render faq for display
	 */
	public function render($params=null){
//print_r($params);
		$link_type=null;	// render for selected page. default = homepage
		$str = '';

		if(isset($params['link_type'])){
			$link_type = $params['link_type'];
			unset($params['link_type']);
		}
		
		$data = $this->get_type();
//print_r($data);
		if(count($data)==0){
			return $str;
		}

		$this->load->helper('text');
		$data = $this->get_type($params);
//echo '<pre>';
//print_r($data);		
//echo '</pre>';
//echo 'odid';
//echo $link_type;		
		if($link_type=='about'){
			$str .= '<div class="item1 fl">';
			$str .= '<h2>FAQ\'s</h2>';
			$str .= '<ul>';
			for($i=0;$i<count($data);$i++){
				$str .=	'<li>'.
						'	<a href="#" class="title1"><h3>'.$data[$i]->title.'</h3></a> '.
						'	<span class="total_questions">'.
								'( Total '.count($this->get(array('faqs_type_id'=>$data[$i]->id))).' Questions )'.
						'	</span>'.
						'	<em class="abt_questions">'.$data[$i]->description.'</em>'.
						'</li>';
//echo '<pre>';
//print_r($data[$i]);
//print_r(($this->get(array('faqs_type_id'=>$data[$i]->id))));
//echo '</pre>';						

			}
			$str .= '</ul></div>';
//echo $str;			
			return $str;
		}
	}
	
}

/* End of file faqs_model.php */
/* Location: ./application/models/faqs_model.php */
