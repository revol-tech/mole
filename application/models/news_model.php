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

		$this->db->set(	'homepage',0 )
				->where('id !=',$ids)
				->where('news_type',$type)
				->update($this->table);
	}


	/**
	 * change the active
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
					   'title_np' 	=> $data[2],
					   'content_np'	=> $data[3],
					   
					   'date_published' => $data[6],
					   'date_removed' => $data[7]
					);

		//update files to upload
		if($_FILES){
			$tmp = $_FILES['file']['name'];
			$ext =  end(explode('.',$tmp));
			$mtime = microtime(true).'.'.$ext;
			$update['filename'] = $mtime;


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

			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if(!$this->upload->do_upload('file')){
				echo $this->upload->display_errors();
				return;
			}
		}


		$this->db->where('id', $data['id']);
		$this->db->update($this->table, $update);


//		$nu_data_links = array(
//			'table' => $this->table,
//			'row_id'=> $data['id']
//		);
//
//		$old_data_links = $this->links_model->get($nu_data_links);
//
//		$nu_data_links['id']   = $old_data_links[0]->id ;
//		$nu_data_links['link'] = $this->input->post('linktype').'/'.$this->input->post('link');
//
//		$this->links_model->save($nu_data_links);
//
		return $data['id'];
	}


	/**
	 * store nu news
	 * returns the id
	 */
	public function save($type=1){
		$mtime=null;
		$data = array(
					$this->input->post('title'),
					htmlentities($this->input->post('content')),
					$this->input->post('title_np'),
						($this->input->post('content_np')),
						//htmlentities($this->input->post('content_np')),
					$this->session->userdata('user_id'),
					$this->session->userdata('date_created'),
					$this->input->post('date_published'),
					$this->input->post('date_removed'),
				);

		//add files to upload
		if($_FILES){
			$tmp = $_FILES['file']['name'];
			$ext =  end(explode('.',$tmp));
			$mtime = microtime(true).'.'.$ext;
			array_push($data,$mtime);
		}

				
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('title_np', 'Nepali Title', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('content_np', 'Nepali Content', 'trim|required|min_length[5]|xss_clean');
		if($this->form_validation->run()==false){
			return false;
		}

//echo '<pre>';
//print_r($_POST);
//print_r($this->input->post());
//print_r($data);
//echo '</pre>';				
//die;
		//update existing news
		if(($this->input->post('id'))){
			$data['id'] = $this->input->post('id');
//echo $this->db->last_query();

			return $this->update($data);


		//insert new news
		}else{
			//================================
//echo $mtime.'<br/>';die;
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

			
			$sql =	'insert into '.$this->table.' ('.
						'title,			content, title_np, content_np, news_type,'.
						'created_by,	date_created,	date_published,'.
						'date_removed,	filename'.
					')values ( ?, ?, ?, ?,'.$type.',?,?,?,?,?);';
//echo $sql;
			if(! $this->db->query($sql,$data)){
				return $this->db->_error_message();
			}
//echo $this->db->last_query();
			$id = $this->db->insert_id();
			
			$data_links = array(
				'link'	=> $this->input->post('linktype').'/'.$this->input->post('link'),
				'table' => $this->table,
				'row_id'=> $id
			);
			
			$this->links_model->save($data_links);

			return $id;
		}
	}


	/**
	 * get news [of selected parameter]
	 */
	public function get($news,$limit=null,$start=null){
//echo '<pre>';
//print_r($news);
//echo '</pre>';

		if($limit){
			$this->db->limit($limit,$start);
		}
		if($news){
			foreach($news as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->order_by('date_created','desc')->get($this->table);
//echo '<pre>';
//print_r($res->result());
//echo '</pre>';
		foreach($res->result() as $value){
			$tmp_link = $this->links_model->get(array('table'=>'news','row_id'=>$value->id));

			$value->link = isset($tmp_link[0]->link)?$tmp_link[0]->link:'';
			$value->created_by = $this->ion_auth->get_user($value->created_by)->username;
			$value->content = html_entity_decode($value->content,ENT_QUOTES, 'UTF-8');
			$value->content_np = html_entity_decode($value->content_np,ENT_QUOTES, 'UTF-8');
			
		}

		return $res->result();
	}

	/**
	 * render news for display
	 */
	public function render($params,$limit=null){
		$link_type=null;	// render for selected page. default = homepage
		$str=null;
		if(isset($params['link_type'])){
			$link_type = $params['link_type'];
			unset($params['link_type']);
		}
		$this->load->helper('text');
		$data = $this->get($params,$limit);

		switch($params['news_type']){

			//render news/Flash News
			case '1':
				if($link_type == 'about'){
					//render partial news
					$str = $this->_render_news($data,$link_type);
				}else if($link_type == 'news'){
					//render full news
					$str = $this->_render_full_news($data);
				}else if($link_type=='news_list'){
					//render news list
				}else{
					//render flash news
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
	private function _render_full_news($data){
		$str = '';
		$str =	'<div class="fl">
					<h1 class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>
						'.$data[0]->title.'
					</h1>
					<h1 class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>
						'.$data[0]->title_np.'
					</h1>
					<div class="text_box fr en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
						$data[0]->content.
					'</div>
					<div class="text_box fr np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
						$data[0]->content_np.
					'</div>
				</div>';
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
					'<h3 class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
						'<span>Employment </span>relations'.
					'</h3>'.
					'<h3 class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
						'<span>रोजगारी </span>सम्झोता'.
					'</h3>'.
					'<ul>';
			$count = 0;
			foreach($data as $key=>$val){
				if((++$count)>6) break;	//to limit shortcuts
				
				$str.='<li>';
				$str.='<a class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"'). 
							' href="'.site_url('employments/'.$val->id).'" title="'.$val->title.'">'.word_limiter($val->title,4).'</a>';
				$str.='<a class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"'). 
							' href="'.site_url('employments/'.$val->id).'" title="'.$val->title_np.'">'.word_limiter($val->title_np,4).'</a>';
				$str.='</li>';
			}
		$str.= '</ul></div>';
		
		return $str;
	}
	private function _render_health($data){
		if(!(count($data)>0)){
			return '';
		}
		$count=0;		
		$str = '<div class="tab_grid2"><ul>';
		foreach($data as $key=>$val){
			if((++$count)>6) break;	//to limit shortcuts
			
			$str.='<li>';
			$str.='<span class="list_style_red_dot fl"></span>';
			$str .= '<a href="#" class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').' >';
			$str .= 	word_limiter($val->title,4).'</a>';
			$str .= '<a href="#" class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').' >';
			$str .= 	word_limiter($val->title_np,4).'</a>';
			$str.='</li>';
		}
		$str.= '</ul>';
		
		$str.=	'<a href="#" class="btn_red fr alpha en" '.
					(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>';
		$str.=	'View more</a>';
		$str.=	'<a href="#" class="btn_red fr alpha np" '.
					(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>';
		$str.=	'अझै पठ्नुहोस्</a>';
		$str.='</div>';
		return $str;
	}
	private function _render_press($data){
		if(count($data)==0){
			return '';
		}


		$str =	'<div class="block_img1 fl en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>
					<img src="'.base_url().DOCUMENTS.$data[0]->filename.'" width="105" height="99"
						alt="'.$data[0]->title.'" title="'.$data[0]->title.'"/>
				</div>
				<div class="block_img1 fl np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>
					<img src="'.base_url().DOCUMENTS.$data[0]->filename.'" width="105" height="99"
						alt="'.$data[0]->title_np.'" title="'.$data[0]->title_np.'"/>
				</div>';
		$str.='<div class="tab_grid1 fr en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>';
		$str.='		<h5>'.$data[0]->title.'</h5>';
		$str.='		<p>'.word_limiter(strip_tags($data[0]->content),30);
		$str.='			<span>'.date('M j Y',strtotime($data[0]->date_created)).'</span>';
		$str.='		</p>';
		$str.='		<a href="'.site_url('press').'" class="btn_red fl alpha">Read more</a>';
		$str.='</div>';

		$str.='<div class="tab_grid1 fr np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>';
		$str.='		<h5>'.$data[0]->title_np.'</h5>';
		$str.='		<p>'.word_limiter(strip_tags($data[0]->content_np),30);
		$str.='			<span>'.date('M j Y',strtotime($data[0]->date_created)).'</span>';
		$str.='		</p>';
		$str.='		<a href="'.site_url('press').'" class="btn_red fl alpha">बाँकीको पढ्नुहोस्</a>';
		$str.='</div>';
		return $str;
	}
/*
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
*/	private function _render_news($data,$type=null){
		$str = '';

		if(count($data)==0){
			$str .= '</ul></div></div>';
			return $str;
		}

		if($type=='about'){
			$str .=	'<div class="highlight fl">'.
					'	<div class="title1">'.
					'		<h2 class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
					'			<span>Latest</span> News '.
					'		</h2>'.
					'		<h2 class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
					'			<span>प्रमुख</span> समाचार '.
					'		</h2>'.
					'		<div class="piece"></div>'.
					'	</div>'.
					'	<div class="highlight_content fl"><ul>';
			foreach($data as $key=>$val){
				$str .= '<li>'.
						'	<a class="en" href="#" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
								$val->title.
							'</a>'.
						'	<a class="en" href="#" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
								$val->title_np.
							'</a>'.
						'</li>';
			
			}

			$str .= '</ul></div></div>';
			return $str;
		}else if($type=='news'){
//print_r($data);
//die;			
			$str =	'<div class="about_us fl">';
			foreach($data as $key=>$val){
				$str .= '<div class="text_box fr">
							<a href="'.site_url('news/'.$val->id).'">'.$val->title.'</a>
						</div>';
			}
			$str .= '</div>';
			return $str;
		}
	}	
	private function _render_flash_news($data){
		$count = count($data);
		if($count==0){
			return '';
		}
		
		$str ='';
//		if(!isset($config['jcarousel'])){
			$str .=	'<script type="text/javascript" src="'.JSPATH.'jquery.jcarousel.min.js"></script>';
//			$this->config->set_item('jcarousel',true);
//		}
		
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
		$str .= '<link rel="stylesheet" type="text/css" href="'.CSSPATH.'carousel/tango/skin.css"/>'.
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

		$str .='<style>.jcarousel-skin-tango #flash-slider {position:relative;top:-10px;left:10px;}</style>';
				
		$str .=	'<div class="ticker_title fl">'.
				'	<h3 class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>News</h3>'.
				'	<h3 class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>समाचार</h3>'.
				'</div>';
		$str .= '<ul id="flash-slider" style="" class="ticker_block fl jcarousel-skin-tango">';//'<ul id="flash-slider" class="jcarousel-skin-tango">';
		if(count($data)){
			foreach($data as $key=>$val){
				$str .= '<li>';
				$str .= '	<span class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').' >';
				$str .= 		word_limiter(strip_tags($val->content),15);
				$str .= '		<a href="'.base_url().'news/'.$val->id.'" class="more">more</a>';
				$str .= '	</span>';
				$str .= '	<span class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').' >';
				$str .= 		word_limiter(strip_tags($val->content_np),15);
				$str .= '		<a href="'.base_url().'news/'.$val->id.'" class="more">अझै</a>';
				$str .= '	</span>';
				$str .= '</li>';
			}
		}
		$str.= '</ul></div></div>';
//echo $str;die;		
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
						'<h2 class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>
							<span>Latest</span> Notices</h2>'.
						'<h2 class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>
							<span>प्रमुख</span> समाचार</h2>'.
						'<div id="accordion">';
					
			foreach($data as $key=>$value){
//echo '<pre>';print_r($value);echo '</pre>';				
				$str .=	'<div class="acc-item" >'.
						'	<a href="#" class="acc_trigger en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
						'		<span>'.$value->title.'</span>'.
						'	</a>'.
						'	<a href="#" class="acc_trigger np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
						'		<span>'.$value->title_np.'</span>'.
						'	</a>'.
						'	<div class="acc_container en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
								word_limiter($value->content,20) .
						'		<a href="#" class="btn_red">Read more</a>'.
						'	</div>'.
						'	<div class="acc_container np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
								word_limiter($value->content_np,20) .
						'		<a href="#" class="btn_red">अझै पढ्नुहोस्</a>'.
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
				'	jQuery("#notice-slider2").jcarousel({'.
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

		$str .=	'<div class="item1 fl" >'.
				'<h2 id="carousel_header" class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
				'	<span>Latest</span> Notices'.
				'</h2>'.
				'<h2 id="carousel_header" class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
				'	<span>प्रमुख</span> नोटिस्'.
				'</h2>';

		$str .= '<ul id="notice-slider" class="jcarousel-skin-tango" >';
		if(count($data)){
			foreach($data as $key=>$val){
				$str .= '<li>';
				$str .= '	<h4 class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.$val->title.'</h4>';
				$str .= '	<h4 class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.$val->title_np.'</h4>';
				$str .= '	<a href="#" class="title_date en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.$val->date_created.'</a>';
				$str .= '	<a href="#" class="title_date np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.$val->date_created.'</a>';
				$str .= '	<span class="en" '.(($this->session->userdata('lang')=='en')?'':'style="display:none;"').'>';
				$str .= 		word_limiter(strip_tags($val->content),25);
				$str .= '		<a href="'.base_url().'notices/'.$val->id.'" class="more">more</a>';
				$str .= '	</span>';
				$str .= '	<span class="np" '.(($this->session->userdata('lang')=='np')?'':'style="display:none;"').'>';
				$str .= 		word_limiter(strip_tags($val->content_np),25);
				$str .= '		<a href="'.base_url().'notices/'.$val->id.'" class="more">अझै</a>';
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
		return $str;
	}

	/**
	 * count records
	 */
	public function record_count($type){
		$this->db->where('news_type',$type);
		return $this->db->count_all_results($this->table);
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
