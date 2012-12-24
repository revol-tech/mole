<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>
	<a href='<?php echo site_url('admin/faqs/edit_type/'.$id)?>'>
		edit
	</a>
	<br/>


	created by :
	<span class='created_by'><?php echo $created_by;?></span>
	<br/>


<!--	Publish :
	<?php //echo $active?>
	<br/>
-->
	question :
	<span class='title'><?php echo $title;?></span>
	<br/>

	description :<br/>
	<hr/>
	<?php echo $description?>
	<br/>
	<hr/>
</div>
