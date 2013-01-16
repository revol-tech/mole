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

	question (नेपाली) :
	<span class='title_np'><?php echo $title_np;?></span>
	<br/>

	description :<br/>
	<hr/>
	<?php echo $description_np?>
	<br/>
	<hr/>

	description नेपाली) :<br/>
	<hr/>
	<?php echo $description_np?>
	<br/>
	<hr/>
</div>
