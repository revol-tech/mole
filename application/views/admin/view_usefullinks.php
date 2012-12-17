<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>
	<a href='<?php echo site_url('admin/usefullinks/edit/'.$id)?>'>
		edit
	</a>
	<br/>

	title :
	<span class='title'><?php echo $title;?></span>
	<br/>
	
	link :
	<span class='link'><?php echo $link;?></span>
	<br/>
	
	description :
	<span class='description'><?php echo $description;?></span>
	<br/>
	
	created by :
	<span class='created_by'><?php echo $created_by;?></span>
	<br/>


	Publish :
	<?php echo $active?>
	<br/>

	homepage :
	<span class='homepage'><?php echo $homepage?></span>
	<br/>

	<hr/>
</div>
