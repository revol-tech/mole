<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>

	title :
	<span class='title'><?php echo $title?></span>
	<br/>

	description :
	<span class='description'><?php echo $description?></span>
	<br/>

	created by :
	<span class='created_by'><?php echo $created_by;?></span>
	<br/>

	date created :
	<span class='date_created'><?php echo $date_created?></span>
	<br/>

	<a href='<?php echo site_url('admin/files/download/'.$id)?>'>
		download
	</a>
	<br/>


	<!--<form method='post' action='<?php echo site_url('admin/files/del')?>'>-->
	<?php echo form_open(site_url('admin/files/del'))?>
		<input type='hidden' name='files_id' value='<?php echo $id?>' />
		<input type='submit' name='del' value='Delete'/>
	</form>

	<br/>
	<hr/>
</div>
