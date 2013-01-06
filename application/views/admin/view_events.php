<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<!--<br/>
	<a href='<?php echo site_url('admin/events/edit/'.$id)?>'>
		edit
	</a>-->
	<br/>


	title :
	<span class='title'><?php echo $title?></span>
	<br/>

	title (नेपाली) :
	<span class='title_np'><?php echo $title_np?></span>
	<br/>

	link :
	<span class='link'>
		<a href="<?php //echo base_url().$link?>"><?php //echo base_url().$link?></a>
	</span>
	<br/>

	created by :
	<span class='created_by'><?php echo $created_by;?></span>
	<br/>


	Publish :
	<?php echo $active?>
	<br/>

	image : 
	<?php echo $timestamp_img?>
	<br/>

	contents :<br/>
	<hr/>
	<?php echo $contents?>
	<br/>
	<hr/>

	contents (नेपाली) :<br/>
	<hr/>
	<?php echo $contents_np?>
	<br/>
	<hr/>
</div>
