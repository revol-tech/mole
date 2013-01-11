<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organizations_model extends CI_Model{
	protected $table = 'organizations';

	public function __construct(){
		parent::__construct();
	}


	/**
	 * get organizations [of selected parameter]
	 */
	public function get($organizations=null,$limit=null,$start=null,$distinct=false){

		if($distinct){
			$this->db->distinct();
			$this->db->select('title');
			$this->db->select('title_np');			
		}
		if($limit){
			$this->db->limit($limit,$start);
		}
		if(count($organizations)>0){
			foreach($organizations as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);
/*
echo $this->db->last_query();
echo '<pre>';
print_r($res->result());
echo '</pre>';
die; 
*/
		return $res->result();
	}


	/**
	 * count records
	 */
	public function record_count(){
		return $this->db->count_all($this->table);
	}


	/**
	 * save nu organizations
	 * returns the id
	 */
	public function save($data=null){
		//update existing usefullinks
		if(strlen($this->input->post('id'))>0){
			$data['id'] = $this->input->post('id');

			return $this->update($data);

		//insert new usefullinks
		}else{

			if(! $this->db->insert($this->table,$data)){
				return $this->db->_error_message();
			}
		}

		return $this->db->insert_id();
	}


	/**
	 * update existing usefullinks
	 */
	private function update($data){

		$id = $data['id'];
		unset($data['id']);
		
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);

		return $id;
	}


	/**
	 * delete selected organizations
	 *
	 * @param array of enws ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del($params){
		$ids = $this->get($params);


		$this->db->where('id',$ids['id'])
				->delete($this->table);

		return true;
	}


	/**
	 * change the active organizations
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function change_active($ids=false,$active=false){

		$this->db->set(	'active',$active=='true'?1:0 )
				->where('id',$ids)
				->update($this->table);
//echo $this->db->last_query();				
	}
	
	/**
	 * render organizations
	 */
	public function render($data=array()){
//	public function get($organizations=null,$limit=null,$start=null,$distinct=false){

		$data = $this->get($data,null,null,true);
//echo $this->db->last_query();
//echo '<pre>';
//print_r($data);
//echo '</pre>';		
//die;
		$str = 		
		'<div class="about_us fl">
			<h1 class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>
				<span>Organization</span>- Ministry of Labour and Employment
			</h1>
			<h1 class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>
				<span>संगठन</span>- श्रम तथा रोजगार मन्त्रालय
			</h1>
			<div class="lower_block fl">
				<section>';
				
		foreach($data as $key=>$val){

			$data2 = $this->get(array('active'=>1,'title'=>$val->title));
//echo '<pre>';
//print_r($data2);
//echo $this->db->last_query();
//echo '</pre>';		

			$str .= '<h2 class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
						$val->title.
					'</h2>'.
					'<h2 class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
						$val->title_np.
					'</h2>';
			$str .=	'<br/><ul>';
			
			foreach($data2 as $kk => $vv){
				$str .=	'<li class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
							$vv->sub_title.
						'</li>'.
						'<li class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
							$vv->sub_title_np.
						'</li>';
			}
			$str .= '</ul>';

		}
				
				
		$str .=	'</section>
				</div>
				</div>';

		return $str;
	}
}

/* End of file organizations_model.php */
/* Location: ./application/models/organizaitons_model.php */
