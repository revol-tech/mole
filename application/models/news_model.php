<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model{

	//the table to be used in the db
	private $table = 'news';

	public function __construct(){
		parent::__construct();
	}

	/**
	 * dispay-hide the news on homepage
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function change_homepage($ids=false,$active=false,$type){

		$this->db->set(	'homepage',$active=='Activate'?1:0 )
				->where('id',$ids)
				->where('news_type',$type)
				->update($this->table);
//echo $this->db->last_query();echo '<br/>';
		$this->db->set(	'homepage',0 )
				->where('id !=',$ids)
				->where('news_type',$type)
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
	 * update existing news
	 */
	private function update($data){

		$update = array(
					   'title' 		=> $data[0],
					   'content' 	=> $data[1],
					   'date_published' => $data[3],
					   'date_removed' => $data[4]
					);

		$this->db->where('id', $data['id']);
		$this->db->update($this->table, $update);

		return $data['id'];
	}


	/**
	 * store nu news
	 * returns the id
	 */
	public function save($type=1){
		$data = array(
					$this->input->post('title'),
					htmlentities($this->input->post('content')),
					$this->session->userdata('user_id'),
					$this->session->userdata('date_created'),
					$this->input->post('date_published'),
					$this->input->post('date_removed')
				);

		//update existing news
		if(($this->input->post('id'))){
			$data['id'] = $this->input->post('id');

			return $this->update($data);


		//insert new news
		}else{
			$sql =	'insert into '.$this->table.' ('.
						'title,			content,		news_type,'.
						'created_by,	date_created,	date_published,'.
						'date_removed'.
					')values ( ?, ?, '.$type.',?,?,?,?);';

			if(! $this->db->query($sql,$data)){
				return $this->db->_error_message();
			}

			return $this->db->insert_id();
		}
	}


	/**
	 * get news [of selected parameter]
	 */
	public function get($news,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}
		if($news){
			foreach($news as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);

		foreach($res->result() as $value){
			$value->created_by = $this->ion_auth->get_user($value->created_by)->username;
			$value->content = html_entity_decode($value->content,ENT_QUOTES, 'UTF-8');
		}
//print_r($res->result());
		return $res->result();
	}

	/**
	 * render news for display
	 */
	public function render($params){
//print_r( $params);
		$this->load->helper('text');
		$data = $this->get($params);

		switch($params['news_type']){

			//render Flash News
			case '1':
				$str = $this->_render_flash_news($data);
				break;

			//render Notices
			case '2':
				$str = $this->_render_notices($data);
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
				$str = $this->_render_page($data);
				break;
		}
		return $str;
	}

	private function _render_health($data){
		$str = '<div class="tab_grid2"><ul>';
		if(count($data)>0){
			foreach($data as $key=>$val){
				$str.='<li>';
				$str.='<span class="list_style_red_dot fl"></span>';
				$str.='<a href="#">'.word_limiter($val->title,4).'</a>';
				$str.='</li>';
			}
		}
		$str.= '</ul><a href="#" class="btn_red fr alpha">View more</a></div>';
		return $str;
	}
/*	
<div class="tab_grid2">
	<ul>
		<li>
			<span class="list_style_red_dot fl"></span>
			<a href="#">WSH Regulatory Framework </a> 
		</li>
		<li>
			<span class="list_style_red_dot fl"></span>
			<a href="#">Safety & Health Management System </a> 
		</li>
		<li>
			<span class="list_style_red_dot fl"></span>
			<a href="#">Monitoring and Surveillance </a> 
		</li>
		<li>
			<span class="list_style_red_dot fl"></span>
			<a href="#">Work Injury Compensation </a> 
		</li>
		<li>
			<span class="list_style_red_dot fl"></span>
			<a href="#">Certification & Registration </a> 
		</li>
		<li>
			<span class="list_style_red_dot fl"></span>
			<a href="#">Incident Reporting </a> 
		</li>
	</ul>
	<a href="#" class="btn_red fr alpha">View more</a>
</div>
*/	
	private function _render_press($data){
		if(count($data)==0){
			return '';
		}

		$str ='<div class="tab_grid1 fr">';
		$str.='		<h5>'.$data[0]->title.'</h5>';
		$str.='		<p>'.word_limiter(strip_tags($data[0]->content),25);
		$str.='			<span>'.date('M j Y',strtotime($data[0]->date_created)).'</span>';
		$str.='		</p>';
		$str.='		<a href="#" class="btn_red fl alpha">Read more</a>';
		$str.='</div>';

		return $str;
	}

	private function _render_events($data){
		if(count($data)==0){
			return '';
		}

		$str = '<div class="item1_content fl">';
		$str.= '	<p>'.word_limiter(strip_tags($data[0]->content),25);
		$str.= '		<a href="#" class="more">read more</a></p>'; // <--- link not set properly
		$str.= '<a href="#" class="view_all">View All Events +</a>';
		$str.= '</div>';

		return $str;
	}

	private function _render_flash_news($data){
		$count = count($data);
		if($count==0){
			return '';
		}
		
		$str ='';
		$str.=	'<style>'.
				'	.news_ticker_content{'.
				'		background-color:#fff;'.
				'		color			:#888;'.
				'		font			:13px/20px "Open Sans",Arial,Helvetica,sans-serif;'.
				'		height			:inherit;'.
				'		overflow		:hidden;'.
				'		padding			:10px 0 0 10px;'.
				'		top				:0;'.
				'	}'.
				'</style>';
		$str.='<div class="news_ticker_content" style="">';
		$str .= //'<link rel="stylesheet" type="text/css" href="'.CSSPATH.'carousel/tango/skin.css"/>'.
				'<script type="text/javascript" src="'.JSPATH.'jquery.jcarousel.min.js"></script>'.
				'<script>
				jQuery(document).ready(function() {
					jQuery("#flash-slider").jcarousel({
						visible	: 1,
						scroll 	: 1,
						auto	: 5,
						wrap	: "circular",
				//		itemFallbackDimension: 800
				//		buttonNextHTML:"null",
				//		buttonPrevHTML:"null",
					})
				//	.jcarouselAutoscroll()
				//	.hover(function() {
				//		$(this).jcarouselAutoscroll("stop");
				//	}, function() {
				//		$(this).jcarouselAutoscroll("start");
				//	});
				});
				</script>';

		$str .= '<ul id="flash-slider">';//'<ul id="flash-slider" class="jcarousel-skin-tango">';
		if(count($data)){
			foreach($data as $key=>$val){
				$str .= '<li>';
				$str .= '	<span>';
				$str .= 		word_limiter(strip_tags($val->content),15);
				$str .= '		<a href="#" class="more">more</a>';
				$str .= '	</span>';
				$str .= '</li>';
			}
		}
		$str.= '</ul></div>';
		return $str;
	}

	private function _render_notices($data){
		$count = count($data);
		if($count==0){
			return '';
		}

		$str ='';
		$str .= '<link rel="stylesheet" type="text/css" href="'.CSSPATH.'carousel/tango/skin.css"/>'.
				'<script type="text/javascript" src="'.JSPATH.'jquery.jcarousel.min.js"></script>'.
				'<script>'.
				'jQuery(document).ready(function() {'.
				'	jQuery("#notice-slider").jcarousel({'.
				'		vertical: true,'.
				'		visible	: 2,'.
				'		scroll 	: 1,'.
				'		auto	: 10000,'.
				'		wrap	: "circular",'.
				'		buttonNextHTML:"null",'.
				'		buttonPrevHTML:"null",'.
				'	});'.
				'});'.
				'</script>';


		$str .= '<ul id="notice-slider" class="jcarousel-skin-tango">';
		if(count($data)){
			foreach($data as $key=>$val){
				$str .= '<li>';
				$str .= '	<h4>'.$val->title.'</h4><a href="#" class="title_date">'.$val->date_created.'</a>';
				$str .= '	<span>';
				$str .= 		word_limiter(strip_tags($val->content),25);
				$str .= '		<a href="#" class="more">more</a>';
				$str .= '	</span>';
				$str .= '</li>';
			}
		}
		$str.= '</ul>';
		return $str;
	}

	private function _render_page($data){
		if(count($data)==0){
			return '';
		}

		$str = '<div class="about">';
		$str.= '<h1>'.$data[0]->title.'</h1>';
		$str.= '<p>'.word_limiter($data[0]->content,50).'</p>';
		$str.= '<a href="#" class="btn_red fr">read more</a>'; // <--- link not set properly
		$str.= '</div>';

		return $str;
	}

	/**
	 * count records
	 */
	public function record_count($type){
		$this->db->where('news_type',$type);
		$x = $this->db->count_all_results($this->table);

		return $x;
	}



	/**
	 * delete news
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

/* End of file news_model.php */
/* Location: ./application/models/news_model.php */
