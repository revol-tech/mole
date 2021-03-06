<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events_model extends CI_Model{

	//the table to be used in the db
	private $table = 'events';

	public function __construct(){
		parent::__construct();
	}

	/**
	 * dispay-hide the events on homepage
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function change_homepage($ids=false,$active=false,$type){

		$this->db->set(	'homepage',$active=='Activate'?1:0 )
				->where('id',$ids)
				->where('employments_type',$type)
				->update($this->table);
//echo $this->db->last_query();echo '<br/>';
		$this->db->set(	'homepage',0 )
				->where('id !=',$ids)
				->where('employments_type',$type)
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
	 * update existing employments
	 */
	private function update($data){

		$update = array(
					   'title' 		=> $data[0],
					   'content' 	=> $data[1],
					   'title_np' 	=> $data[2],
					   'content_np'	=> $data[3],
					   'date_published' => $data[6],
					   'date_removed'=>$data[7]
					);

		$this->db->where('id', $data['id']);
		$this->db->update($this->table, $update);

		return $data['id'];
	}


	/**
	 * store nu events
	 * returns the id
	 */
	public function save(){
//echo '<pre>';
//print_r($_POST);
//print_r($_FILES);
//print_r($this->input->post());
//echo '</pre>';
//die;

		$tmp = $_FILES['file']['name'];
		$ext =  end(explode('.',$tmp));
		$mtime = microtime(true).'.'.$ext;

		$data = array(
					'title'			=>	$this->input->post('title'),
					'contents'		=>	htmlentities($this->input->post('content')),
					'title_np'		=>	$this->input->post('title_np'),
					'contents_np'	=>	($this->input->post('content_np')),
					'created_by'	=>	$this->session->userdata('user_id'),
					'date_created'	=>	$this->session->userdata('date_created'),
					'date_published'=>	$this->input->post('date_published'),
					'date_removed'	=>	$this->input->post('date_removed'),
					'active'		=>	$this->input->post('active'),
					'homepage'		=>	$this->input->post('homepage'),
					'filename'		=>	$_FILES['file']['name'],
					'timestamp'		=>	$mtime,
				);

		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('title_np', 'Nepali Title', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('content_np', 'Nepali Content', 'trim|required|min_length[5]|xss_clean');
		if($this->form_validation->run()==false){
			return false;
		}

		//update existing employments
		if(($this->input->post('id'))){
			$data['id'] = $this->input->post('id');

			return $this->update($data);


		//insert new employments
		}else{
			//================================
			//echo $mtime.'<br/>';
			$config = array(
						  'allowed_types' => 'jpg|jpeg|png',
						  'upload_path' => DOCUMENTS,
						  'maintain_ratio' => true,
						  'max-size' => 20000,
						  'width' => 2000,
						  'height' => 1500,
						  'overwrite' => true,
						  'file_name' => $mtime
						);
			//echo '<pre>';
			//print_r($config);
			//echo '</pre>';


			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if(!$this->upload->do_upload('file')){
				echo $this->upload->display_errors();
				return;
			}
			//===========================		


			if(! $this->db->insert($this->table,$data)){
				return $this->db->_error_message();
			}

			return $this->db->insert_id();
		}
	}


	/**
	 * get events [of selected parameter]
	 */
	public function get($events,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}
		if($events){
			foreach($events as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);

		foreach($res->result() as $value){
			$value->created_by = $this->ion_auth->get_user($value->created_by)->username;
			$value->contents = html_entity_decode($value->contents,ENT_QUOTES, 'UTF-8');
			$value->filename = $value->timestamp;

			//add  image
			$value->timestamp_img = '<img src="'.base_url().DOCUMENTS.$value->timestamp.'" width="211" height="126" />';
		}
		return $res->result();
	}

/*	public function render($params){
		$this->load->helper('text');
		$data = $this->get($params);
echo '<pre>';
echo $this->db->last_query();
print_r($data);
echo '</pre>';
//die;
		if(!(count($data)>0))
			return '';

		$str = '<div class="about">';
		$str.= '<h1>'.$data[0]->title.'</h1>';
		$str.= '<p>'.word_limiter($data[0]->content,50).'</p>';
		$str.= '<a href="#" class="btn_red fr">read more</a>'; // <--- link not set properly
		$str.= '</div>';

		return $str;
	}
*/
	/**
	 * render events for homepage
	 */
	public function render_events($data){
		if(count($data)==0){
			return '';
		}
//echo '<pre>';
//print_r($data);
//echo '</pre>';		
		$str =	'<div class="item1 fl">';
		$str .=	'	<div class="right_col fl en" '.
								(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>';
		$str .=	'		<h2><span>Latest</span> Events</h2>';
		$str .= '		<div class="item1_content fl" >';
		$str .= '			<p>'.word_limiter(strip_tags($data[0]->title),20);
		$str .= '				<a href="'.site_url('events/view/'.$data[0]->id).'" class="more">read more</a>';
		$str .= '			</p><br/>';
		$str .= '			<a href="'.site_url('events/list_events').'" class="view_all">View All Events +</a>';
		$str .= '		</div>';
		$str .=	'	</div>';
		$str .=	'	<div class="right_col fl np" '.
								(($this->session->userdata('lang')=='np')?'':'style="display:none;"').' >';
		$str .=	'		<h2><span>प्रमुख</span> घटना</h2>';
		$str .= '		<div class="item1_content fl">';
		$str .= '			<p>'.word_limiter(strip_tags($data[0]->title_np),20);
		$str .= '				<a href="'.site_url('events/view/'.$data[0]->id).'" class="more">बाकी ...</a>';
		$str .= '			</p><br/>';
		$str .= '			<a href="'.site_url('events/list_events').'" class="view_all">अरु घटनाहरु +</a>';
		$str .= '		</div>';
		$str .=	'	</div>';
		$str .=	'	<div class="fr">';
		$str .=	'		<div class="block_img2">';
		$str .=	'			<img src="'.DOCUMENTS.$data[0]->timestamp.'" alt="" title=""  width="211" height="126"/>';
		$str .=	'		</div>';
		$str .=	'	</div>';
		$str .=	'</div>';
		return $str;
	}

	/**
	 * render events for eventspage
	 */
	public function render_events_page($data){
		if(count($data)==0){
			return '';
		}
//echo '<pre>';
//print_r($data);
//echo '</pre>';		

		$str = '';
		foreach($data as $key=>$val){
			$str .=	'<div class="grid_3 alpha fl">
						<div class="about_us fl en" '.
								(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>
							<p>
								<strong style="color:#1C50AD;" class="spot">
									'.$val->title.'
								</strong>
							</p>
							<div class="lower_block fl">
								<div class="block_img4 fl">
									<img title="'.word_limiter(strip_tags($val->title),5).'" 
										alt="'.$val->title.'" src="'.
											base_url().DOCUMENTS.$val->filename.
										'" width="150" height="140" />
								</div>
							
								<div class="text_box fr">
									<p>';
										if(isset($val->content)){
											$str .= $val->content;
										}else{
											$str .= $val->contents;
										}
							$str.=	'</p>
								</div>
							</div> 
						</div>
						<div class="about_us fl np" '.
								(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>
							<p>
								<strong style="color:#1C50AD;" class="spot">
									'.$val->title_np.'
								</strong>
							</p>
							<div class="lower_block fl">
								<div class="block_img4 fl">
									<img title="'.word_limiter(strip_tags($val->title_np),5).'" 
										alt="'.$val->title_np.'" src="'.
											base_url().DOCUMENTS.$val->filename.
										'" width="150" height="140" />
								</div>
							
								<div class="text_box fr">
									<p>';
										if(isset($val->content)){
											$str .= $val->content_np;
										}else{
											$str .= $val->contents_np;
										}
							$str.=	'</p>
								</div>
							</div> 
						</div>
					</div>';
		}
		return $str;
	}

	/**
	 * count records
	 */
	public function record_count(){
		$num = $this->db->count_all_results($this->table);

		return $num;
	}


	/**
	 * delete events
	 *
	 * @param array of enws ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del($ids){

		$this->db->where('id',$ids);
		$items = $this->db->get($this->table);

		foreach($items->result() as $file){
			unlink(DOCUMENTS.$file->timestamp);
		}

		$this->db->where('id',$ids)
				->delete($this->table);

		return true;

	}
}

/* End of file events_model.php */
/* Location: ./application/models/events_model.php */
