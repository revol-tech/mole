<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Files extends MY_MOLE_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('files_model');
	}

	public function index(){
		$items = $this->list_files();

//echo @$items['links'];

$str = 	'<table border=1>
		<thead>
			<tr>
				<th>id</th>
				<th>filename</th>
				<th>title</th>
				<th>description</th>
				<th>date created</th>
				<th>created by</th>
				<!--<th>date published</th>-->
				<th>download</th>
			</tr>
		</thead>
		<tbody>';
			foreach($items['data'] as $item){
$str .=			'<tr>
					<td>'.$item->id.'</td>
					<td>'.$item->filename.'</td>
					<td>'.$item->title.'</td>
					<td>'.$item->description.'</td>
					<td>'.$item->date_created.'</td>
					<td>'.$item->created_by.'</td>
					<!--<td><?php //echo $item->date_published?></td>-->
					<td>'.$item->download.'</td>
				</tr>';
			}
$str.=	'</tbody>
		</table>';
echo $str;		
	}
	
		/**
	 * list all files
	 */
	private function list_files(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/files/index');
		$config['total_rows'] = $this->files_model->record_count(array('file_type is null'=>null));
//echo $this->db->last_query();		
		$config['per_page'] = PAGEITEMS;


		//if no data, set then to display null
		if($config['total_rows']==0){
			$item->id			='--';
			$item->filename		='--';
			$item->title		='--';
			$item->title_link	='--';
			$item->description	='--';
			$item->timestamp	='--';
			$item->date_created	='--';
			$item->press_type	='--';
			$item->created_by	= '--';
			$item->date_published='--';
			$item->download		='--';
			$item->del			='--';

			return array('data'=>array($item));
		}

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
		$data = $this->files_model->get(array('file_type is null'=>null),$config['per_page'],$page);

		//enhance data as reqd.
		foreach($data as $key=>$val){

			//href for the page
			$str =	'<a href="'.site_url('admin/files/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;

			//del for the data
			$str = 	form_open(site_url('admin/files/del/')).//'<form method="post" action="'.site_url('admin/files/del/').'">'.
						'<input type="hidden" name="files_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;

			//download the file
			$str =	'<a href="'.site_url('admin/files/download/'.$val->id).'">
						download
					</a>';
			$data[$key]->download = $str;


			//convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;
		}

		return array('data'=>$data,'links'=>$this->pagination->create_links());
	}

}
