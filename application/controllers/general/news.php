<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class to be called when displaying "news" page , 
 * for a general web surfer.
 */
class News extends MY_MOLE_Controller {

	public function __construct(){
		parent::__construct();
	}


	public function index(){
		$this->load->library('render_library');
		$this->render_library->render_inner();

		$data = $this->links_model->get(array(
											'link'=>$this->uri->segment(1).
													'/'.
													$this->uri->segment(2)
											)
										);
										
		$this->load->model('news_model');
		$params = array(
						'news_type'	=> 1,
						'link_type' => 'news'
					);
		isset($data[0]->row_id)?$params['id']=$id:'';
		
		$page = $this->news_model->render($params);
		$this->template->write('page',$page);

		$this->template->render();
	}




//======================================================================
//======================================================================

	protected $data = array();
	protected $type = 1;


	/**
	 * list all news
	 */
	public function list_news(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/news/index');
		$config['total_rows'] = $this->news_model->record_count($this->type);
		$config['per_page'] = PAGEITEMS;

		//if there are no news at present ...
		if($config['total_rows']==0){
			$item->id			= '--';
			$item->title		= '--';
			$item->title_link	= '--';
			$item->news_type	= '--';
			$item->created_by	= '--';
			$item->date_created	= '--';
			$item->date_published='--';
			$item->active		= '--';
			$item->edit			= '--';
			$item->del			= '--';

			$data['items'] = $item;
			return array('data'=>array($item));
		}
//print_r($data);

		//get reqd page number
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='index'){
				$config['uri_segment'] = $key+1;
				break;
			}
		}
		$this->pagination->initialize($config);
		isset($config['uri_segment'])?'':$config['uri_segment']=$this->uri->total_segments();
		$page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
		//echo $page;

		//get reqd. page's data
		$data = $this->news_model->get(array('news_type'=>$this->type),$config['per_page'],$page);

		foreach($data as $key=>$val){

			$str =	'<a href="'.site_url('admin/news/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;


			$str =	'<a href="'.site_url('admin/news/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;


			$str = 	form_open(site_url('admin/news/del/')).//'<form method="post" action="'.site_url('admin/news/del/').'">'.
						'<input type="hidden" name="news_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;


			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;


			//add activate/deactivate button
			$str = form_open(site_url('admin/news/active/')).
						'<input type="hidden" name="news_id" value="'.$data[$key]->id.'"/>';
			if($data[$key]->active == 1){
				$str .=	'<input type="hidden" name="activate" value="false"/>';
				$str .=	'<input type="submit" name="active"   value="Deactivate"/>';
			}else{
				$str .=	'<input type="hidden" name="activate" value="true"/>';
				$str .=	'<input type="submit" name="active"   value="Activate"/>';
			}
			$str .= '</form>';

			$data[$key]->active = $str;
		}

		return array('data'=>$data,'links'=>$this->pagination->create_links());
	}



	/**
	 * view selected news
	 */
	public function view(){
		$id=false;
		$get_news = array('news_type'=>$this->type);

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$get_news['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->news_model->get($get_news);

		if(count($data)!=1){
			show_404();
		}

//print_r($data[0]);

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_news.php',$data[0]);
		$this->load->view('templates/admin_footer');
	}



	/**
	 * get the [seleccted] news
	 */
	public function get($news_array=null){

		$data = $this->news_model->get($news_array);
//print_r(($data[0]));

		foreach($data[0] as $key=>$value){
			$this->data[$key] = $value;
		}
	}
}

