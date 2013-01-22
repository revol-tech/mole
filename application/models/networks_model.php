<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Networks_model extends CI_Model{

	//the table to be used in the db
	private $table = 'networks';

	public function __construct(){
		parent::__construct();
	}

	/**
	 * dispay-hide the networks on homepage
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function change_homepage($ids=false,$active=false,$type){

		$this->db->set(	'homepage',$active=='Activate'?1:0 )
				->where('id',$ids)
				->where('networks_type',$type)
				->update($this->table);
//echo $this->db->last_query();echo '<br/>';
		$this->db->set(	'homepage',0 )
				->where('id !=',$ids)
				->where('networks_type',$type)
				->update($this->table);
//echo $this->db->last_query();echo '<br/>';
	}


	/**
	 * change the active network
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
	 * update existing networks
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
	 * store nu networks
	 * returns the id
	 */
	public function save($type=1){
		$data = array(
				'title'			=> $this->input->post('title'),
				'title_np'		=> $this->input->post('title_np'),
				'link'			=> $this->input->post('link'),
				'description'	=> $this->input->post('description'),
				'description_np'=> $this->input->post('description_np'),
				'created_by'	=> $this->ion_auth->get_user()->id,
				'date_created'	=> get_timestamp(),
				'date_published'=> $this->input->post('date_published'),
				'date_removed'	=> $this->input->post('date_removed'),
				'active'		=> $this->input->post('active'),
				'homepage'		=> $this->input->post('homepage'),
				);

		//update existing networks
		if(strlen($this->input->post('id'))>0){
			$data['id'] = $this->input->post('id');

			return $this->update($data);

		//insert new networks
		}else{

			if(! $this->db->insert($this->table,$data)){
				return $this->db->_error_message();
			}

			return $this->db->insert_id();
		}
	}


	/**
	 * get networks [of selected parameter]
	 */
	public function get($networks,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}
		if($networks){
			foreach($networks as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);

		foreach($res->result() as $value){
			$value->created_by = $this->ion_auth->get_user($value->created_by)->username;
			//$value->content = html_entity_decode($value->content,ENT_QUOTES, 'UTF-8');
		}
		return $res->result();
	}

	/**
	 * render networks for display
	 */
	public function render($params=null,$limit=null){
		$data = $this->get($params,$limit);

		if(!(count($data)>0))
			return '';

		$str =	'<div class="grid_7 social border_rt_gray border_lt_white en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
				'	<h3><span>Network</span> with us</h3>'.
//				'	<p>Connect with us via the social networks... </p><ul>';
				'	<p>Connect with us via FaceBook and Twitter.</p><ul>'; 
/*
		foreach($data as $key=>$val){
			$str .= '<li><a href="'.$val->link.'" title="'.$val->description.
						'">'.$val->title.'</a></li>';
		}
*/
		$str .='<li class="facebook"><a href="http://facebook.com">Like us on Facebook</a></li>
				<li class="twitter"><a href="http://twitter.com">Follow us on Twitter</a></li>';
		  
		$str .= '</ul></div>';

		$str .=	'<div class="grid_7 social border_rt_gray border_lt_white np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
				'	<h3><span>हामीसँग</span> कुरा गर्नुहोस्</h3>'.
//				'	<p>सोसल नेटवर्कबाट हामीसंग भेट्नुहोस् ... </p><ul>';
				'	<p>फेसबुक तथा ट्विटरमा हामीलाई भेट्नुहोस् ... </p><ul>';
/*
		foreach($data as $key=>$val){
			$str .= '<li><a href="'.$val->link.'" title="'.$val->description_np.
						'">'.$val->title_np.'</a></li>';
		}
*/
		$str .='<li class="facebook"><a href="http://facebook.com">फेसबुकमा हामीलाई हेर्नुहोस्</a></li>
				<li class="twitter"><a href="http://twitter.com">ट्विटरमा हामीसंगै जानुहोस्</a></li>';
		  

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
	 * delete networks
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

/* End of file networks_model.php */
/* Location: ./application/models/networks_model.php */
