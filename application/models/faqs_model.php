<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Faqs_model extends CI_Model{

	//the table to be used in the db
	private $table = 'faqs';

	public function __construct(){
		parent::__construct();
	}

	/**
	 * get faqs [of selected parameter]
	 */
	public function get($faqs,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}
		if($faqs){
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
		$this->db->where('id',$ids)
				->delete($this->table);

		return true;
	}











	/**
	 * change the active faqs
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
	 * render news for display
	 */
	public function render($params){
		$link_type=null;	// render for selected page. default = homepage
		if(isset($params['link_type'])){
			$link_type = $params['link_type'];
			unset($params['link_type']);
		}

		$this->load->helper('text');
		$data = $this->get($params);
		
		switch($params['news_type']){

			//render news/Flash News
			case '1':
				if($link_type != null){
					$str = $this->_render_news($data,$link_type);
				}else{
					$str = $this->_render_flash_news($data);
				}
				
				break;

			//render Notices
			case '2':
				$str = $this->_render_notices($data,$link_type);
				break;

			//render Events
			case '3':
				$str = $this->_render_events($data);
				break;

			//render Press Release
			case '4':
				$str = $this->_render_press($data);
				break;

			//render Health
			case '5':
				$str = $this->_render_health($data);
				break;

			//render About
			case '6':
				$str = $this->_render_page($data,$link_type);
				break;

			//render employments
			case '7':
				$str = $this->_render_employments($data);
				break;

			//render acts
			case '8':
				$str = $this->_render_acts($data,$link_type);
				break;
		}
		return $str;
	}
}

/* End of file faqs_model.php */
/* Location: ./application/models/faqs_model.php */
