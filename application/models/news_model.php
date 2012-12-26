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
//echo $this->db->last_query();
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

	private function _render_acts($data,$link_type){
		$str = '';

		if(count($data)==0){
			return $str;
		}

		if($link_type=='about'){
			$str .= '<div class="item1 fl">';
			for($i=0;$i<1;$i++){
				$str .=	'<h3><span>'.$data[$i]->title.'</h3>'.
						'<div class="articleinfo fl">'.
						'	<span class="date-posted fl">'.$data[$i]->date_published.'</span>'.
						//'	<span class="date-modified fl"> Last Updated on 31 July 2011 </span>'.
						'	<span class="author fl">'.$data[$i]->created_by.'</span>'.
						'	<a href="#" class="print fr"></a>'.
						'</div>'.
						'<div class="item1_content fl">'.
							word_limiter($data[$i]->content,50) .
							'<a class="more" href="#">more</a>'.
						'</div>';
			}
			$str .= '</div>';
			return $str;
		}
	}
	
	private function _render_employments($data){
		if(!(count($data)>0)){
			return '';
		}
		
		$str = '<div class="grid_7 useful_links pad_omega border_lt_white bottom_fancy">'.
					'<h3><span>Employment </span>relations</h3><ul>';
			foreach($data as $key=>$val){
				$str.='<li>';
				$str.='<a href="#" title='.$val->title.'>'.word_limiter($val->title,4).'</a>';
				$str.='</li>';
			}
		$str.= '</ul></div>';
		
		return $str;
	}
	private function _render_health($data){
		if(!(count($data)>0)){
			return '';
		}
		
		$str = '<div class="tab_grid2"><ul>';
		foreach($data as $key=>$val){
			$str.='<li>';
			$str.='<span class="list_style_red_dot fl"></span>';
			$str.='<a href="#">'.word_limiter($val->title,4).'</a>';
			$str.='</li>';
		}
		$str.= '</ul><a href="#" class="btn_red fr alpha">View more</a></div>';
		return $str;
	}
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

	/**
	 * render news links
	 */
	private function _render_news($data,$type=null){
		$str = '';
		$str .=	'<div class="highlight fl">'.
				'	<div class="title1">'.
				'		<h2><span>Latest</span> News </h2>'.
				'		<div class="piece"></div>'.
				'	</div>'.
				'	<div class="highlight_content fl"><ul>';

		if(count($data)==0){
			$str .= '</ul></div></div>';
			return $str;
		}
		if($type=='about'){
			foreach($data as $key=>$val){
				$str .= '<li><a href="#">'.$val->title.'</a></li>';
			
			}

			$str .= '</ul></div></div>';
			return $str;
		}
	}
	
	private function _render_flash_news($data){
		$count = count($data);
		if($count==0){
			return '';
		}
		
		$str ='';

		if(!isset($config['jcarousel'])){
			$str .=	'<script type="text/javascript" src="'.JSPATH.'jquery.jcarousel.min.js"></script>';
			$this->config->set_item('jcarousel',true);
		}
		
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
		$str.='<div class="newsticker">';
		$str.='<div class="news_ticker_content" style="">';
		$str .= //'<link rel="stylesheet" type="text/css" href="'.CSSPATH.'carousel/tango/skin.css"/>'.
				'<script>
				function flash_initCallback(carousel){
					
					/* Disable autoscrolling if the user clicks the prev or next button.*/
					carousel.buttonNext.bind("click", function() {
						carousel.startAuto(0);
					});
					carousel.buttonPrev.bind("click", function() {
						carousel.startAuto(0);
					});
					/* Pause autoscrolling if the user moves with the cursor over the clip.*/
					carousel.clip.hover(function() {
						carousel.stopAuto();
					}, function() {
						carousel.startAuto();
					});
				}; 

				jQuery(document).ready(function() {
					jQuery("#flash-slider").jcarousel({
						visible	: 1,
						scroll 	: 1,
						auto	: 5,
						wrap	: "circular",
						initCallback: flash_initCallback,
					})
				})</script>';


		$str .=	'<div class="ticker_title fl">'.
				'	<h3>News</h3>'.
				'</div>';

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
		$str.= '</ul></div></div>';
		return $str;
	}

	private function _render_notices($data,$link_type){
		$count = count($data);
		if($count==0){
			return '';
		}

		$str ='';

		if($link_type=='about'){
			$str .=	'<div class="item3 fl">'.
						'<h2><span>Latest</span> Notices</h2>'.
						'<div id="accordion">';
					
			foreach($data as $key=>$value){
//echo '<pre>';print_r($value);echo '</pre>';				
				$str .=	'<div class="acc-item last">'.
						'	<a href="#" class="acc_trigger">'.
						'		<span>'.$value->title.'</span>'.
						'	</a>'.
						'	<div class="acc_container">'.
								word_limiter($value->content,20) .
						'		<a href="#" class="btn_red">Read more</a>'.
						'	</div>'.
						'</div>';
			}
			$str .= '</div></div>';
			return $str;
		}

		if(!isset($config['jcarousel'])){
			$str .=	'<script type="text/javascript" src="'.JSPATH.'jquery.jcarousel.min.js"></script>';
			$this->config->set_item('jcarousel',true);
		}

		$str .= '<link rel="stylesheet" type="text/css" href="'.CSSPATH.'carousel/tango/skin.css"/>'.
				'<script>'.
				'function notice_initCallback(carousel){'.
				'	/* Disable autoscrolling if the user clicks the prev or next button.*/'.
				'	carousel.buttonNext.bind("click", function() {'.
				'		carousel.startAuto(0);'.
				'	});'.
				'	carousel.buttonPrev.bind("click", function() {'.
				'		carousel.startAuto(0);'.
				'	});'.
				'	/* Pause autoscrolling if the user moves with the cursor over the clip.*/'.
				'	carousel.clip.hover(function() {'.
				'		carousel.stopAuto();'.
				'	}, function() {'.
				'		carousel.startAuto();'.
				'	});'.
				'}; '.
				'jQuery(document).ready(function() {'.
				'	jQuery("#notice-slider").jcarousel({'.
				'		vertical: true,'.
				'		visible	: 2,'.
				'		scroll 	: 1,'.
				'		auto	: 10,'.
				'		wrap	: "circular",'.
				'		buttonNextHTML:"null",'.
				'		buttonPrevHTML:"null",'.
				'		initCallback: notice_initCallback,'.
				'	});'.
				'});'.
				'</script>';

		$str .=	'<div class="item1 fl">'.
				'<h2 id="carousel_header">'.
				'	<span>Latest</span> Notices'.
				'</h2>';

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
		$str.= '</ul></div>';
		return $str;
	}

	private function _render_page($data,$type=null){
		$str = '';
		if(count($data)==0){
			return $str;
		}
		if($type=='about'){
			$str =	'<div class="about_us fl">
						<h1>
							<span>Welcome to</span> '.$data[0]->title.'
						</h1>
						<div class="text_box fr">'.$data[0]->content.'</div>
					</div>';
			return $str;
		}

		$str = '<div class="about">';
		$str.= '<h1>'.$data[0]->title.'</h1>';
		$str.= '<p>'.word_limiter($data[0]->content,50).'</p>';
		$str.= '<a href="aboutus" class="btn_red fr">read more</a>'; // <--- link not set properly
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
