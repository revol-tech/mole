<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Active template
|--------------------------------------------------------------------------
|
| The $template['active_template'] setting lets you choose which template
| group to make active.  By default there is only one group (the
| "default" group).
|
*/
$template['active_template'] = 'default';

/*
|--------------------------------------------------------------------------
| Explaination of template group variables
|--------------------------------------------------------------------------
|
| ['template'] The filename of your master template file in the Views folder.
|   Typically this file will contain a full XHTML skeleton that outputs your
|   full template or region per region. Include the file extension if other
|   than ".php"
| ['regions'] Places within the template where your content may land.
|   You may also include default markup, wrappers and attributes here
|   (though not recommended). Region keys must be translatable into variables
|   (no spaces or dashes, etc)
| ['parser'] The parser class/library to use for the parse_view() method
|   NOTE: See http://codeigniter.com/forums/viewthread/60050/P0/ for a good
|   Smarty Parser that works perfectly with Template
| ['parse_template'] FALSE (default) to treat master template as a View. TRUE
|   to user parser (see above) on the master template
|
| Region information can be extended by setting the following variables:
| ['content'] Must be an array! Use to set default region content
| ['name'] A string to identify the region beyond what it is defined by its key.
| ['wrapper'] An HTML element to wrap the region contents in. (We
|   recommend doing this in your template file.)
| ['attributes'] Multidimensional array defining HTML attributes of the
|   wrapper. (We recommend doing this in your template file.)
|
| Example:
| $template['default']['regions'] = array(
|    'header' => array(
|       'content' => array('<h1>Welcome</h1>','<p>Hello World</p>'),
|       'name' => 'Page Header',
|       'wrapper' => '<div>',
|       'attributes' => array('id' => 'header', 'class' => 'clearfix')
|    )
| );
|
*/


/*
|--------------------------------------------------------------------------
| Default Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/
$template['default']['template'] = 'template.php';

$template['default']['regions'] = array(
//		'header' => array(
//				   'content' 	=> array('<div id="header"></div>','<div id="header_bottom"></div>'),
//				   'name' 		=> 'Page Header',
//				   'wrapper' 	=> '<div>',
//				   'attributes' => array('id' => 'wrapper')
//				),
		'title'	 	=> array('content'=>array('Ministry of Labour and Employment')),
		'menu'	 	=> array('content'=>array(
											'<div class="home fl">
												<a href="'.base_url().'"></a>
											</div>',
										)
						),
		'slider' 	=> array(),
		'flash_news'=> array(),
		'page'	 	=> array(),
		'vip'		=> array(),
		'events' 	=> array(),
		'notices'	=> array(),
		'press'	 	=> array(),
		'health' 	=> array(),
		'gallery'	=> array(),
		'poll'	 	=> array(),
		'contacts'	=> array(),
		'usefullinks'=>array(),
		'network'	=> array(),
		'counter'	=> array(),
		'employments'=>array(),
//	   'content'=>'',
	);


$template['default']['parser'] = 'parser';
$template['default']['parser_method'] = 'parse';
$template['default']['parse_template'] = FALSE;


/*
|--------------------------------------------------------------------------
| Inner Page Template Configuration
|--------------------------------------------------------------------------
*/
$template['template_inner']['template'] = 'template_inner.php';

$template['template_inner']['regions'] = array(
//		'header' => array(
//				   'content' 	=> array('<div id="header"></div>','<div id="header_bottom"></div>'),
//				   'name' 		=> 'Page Header',
//				   'wrapper' 	=> '<div>',
//				   'attributes' => array('id' => 'wrapper')
//				),
		'title'	 	=> array('content'=>array('Ministry of Labour and Employment')),
		'menu'	 	=> array('content'=>array(
											'<div class="home fl">
												<a href="'.base_url().'"></a>
											</div>',
										)
						),
		
		'page'	 	=> array(),
		'news'		=> array(),
		'acts'		=> array(),
		'poll'	 	=> array(),
		'feedback'	=> array(),
		'faqs'		=> array(),
		'notices'	=> array(),
		
		
//		'vip'		=> array(),
//		'events' 	=> array(),
//		'press'	 	=> array(),
//		'health' 	=> array(),
//		'gallery'	=> array(),
		'contacts'	=> array(),
		'usefullinks'=>array(),
		'network'	=> array(),
		'counter'	=> array(),
		'employments'=>array(),
//	   'content'=>'',
	);


$template['template_inner']['parser'] = 'parser';
$template['template_inner']['parser_method'] = 'parse';
$template['template_inner']['parse_template'] = FALSE;

//=============================================================

/*
|--------------------------------------------------------------------------
| Admin Template Configuration
|--------------------------------------------------------------------------
*/
$template['admin']['template'] = 'admin.php';

$template['admin']['regions'] = array(
//		'header' => array(
//				   'content' 	=> array('<div id="header"></div>','<div id="header_bottom"></div>'),
//				   'name' 		=> 'Page Header',
//				   'wrapper' 	=> '<div>',
//				   'attributes' => array('id' => 'wrapper')
//				),
		'title'	 	=> array('content'=>array('Ministry of Labour and Employment')),
		'menu'	 	=> array('content'=>array(
											'<div class="home fl">
												<a href="'.base_url().'"></a>
											</div>',
										)
						),
		'slider' 	=> array(),
		'flash_news'=> array(),
		'page'	 	=> array(),
		'vip'		=> array(),
		'events' 	=> array(),
		'notices'	=> array(),
		'press'	 	=> array(),
		'health' 	=> array(),
		'gallery'	=> array(),
		'poll'	 	=> array(),
		'contacts'	=> array(),
		'usefullinks'=>array(),
		'network'	=> array(),
		'counter'	=> array(),
		'employments'=>array(),
//	   'content'=>'',
	);


$template['admin']['parser'] = 'parser';
$template['admin']['parser_method'] = 'parse';
$template['admin']['parse_template'] = FALSE;


/* End of file template.php */
/* Location: ./application/config/template.php */
