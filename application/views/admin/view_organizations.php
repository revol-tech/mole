<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>
	<a href='<?php echo site_url('admin/organizations/edit/'.$id)?>'>
		edit
	</a>
	<br/>

	title :
	<span class='title'><?php echo $title;?></span>
	<br/>

	sub title :
	<hr/>
	<div class='sub_title'><?php echo $sub_title?></div>
	<hr/>
	<br/>

	created by :
	<span class='created_by'><?php echo $created_by;?></span>
	<br/>


	Publish :
	<?php echo $active?>
	<br/>

	<br/>
	<hr/>
</div>
