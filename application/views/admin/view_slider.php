<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>

	title :
	<span class='title'><?php echo $title?></span>
	<br/>

	title (नेपाली) :
	<span class='title_np'><?php echo $title_np?></span>
	<br/>

	description :
	<span class='description'><?php echo $description?></span>
	<br/>

	description (नेपाली) :
	<span class='description_np'><?php echo $description_np?></span>
	<br/>

	created by :
	<span class='created_by'><?php echo $created_by;?></span>
	<br/>

	date created :
	<span class='date_created'><?php echo $date_created?></span>
	<br/>

	<a href='<?php echo site_url('admin/slider/download/'.$id)?>'>
		download
	</a>
	<br/>


	<!--<form method='post' action='<?php echo site_url('admin/slider/del')?>'>-->
	<?php echo form_open(site_url('admin/slider/del'))?>
		<input type='hidden' name='slider_id' value='<?php echo $id?>' />
		<input type='submit' name='del' value='Delete'/>
	</form>

	<br/>
	<hr/>
</div>
