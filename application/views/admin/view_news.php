<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>
	<a href='<?php echo site_url('admin/news/edit/'.$id)?>'>
		edit
	</a>
	<br/>


	title :
	<span class='title'><?php echo $title;?></span>
	<br/>

	link :
	<span class='link'>
		<a href="<?php echo base_url().$link?>"><?php echo base_url().$link?></a>
	</span>
	<br/>

	created by :
	<span class='created_by'><?php echo $created_by;?></span>
	<br/>


	Publish :
	<?php echo $active?>
	<br/>

	content :<br/>
	<hr/>
	<?php echo $content?>
	<br/>
	<hr/>
</div>
