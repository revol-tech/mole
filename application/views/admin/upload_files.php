<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!--<form method='post' action='<?php echo site_url('admin/files/upload')?>'  enctype="multipart/form-data" style='width:700px;' >-->
<?php echo form_open_multipart(site_url('admin/files/upload'),array('style'=>'width:700px;'))?>
	<label>
		file :
		<input type='file' name='file' />
	</label>
	<br/>


	<label>
		file title:
		<input type='text' name='title' />
	</label>
	<br/>

	<label>
		file title (नेपाली) :
		<input type='text' name='title_np' />
	</label>
	<br/>

	<label>
		description :
		<input type='text' name='description' />
	</label>
	<br/>

	<label>
		description (नेपाली):
		<input type='text' name='description_np' />
	</label>
	<br/>

	<label>
		created on
		<input type='text' name='date_created' disabled='disabled' value='<?php echo $date_created?>'/>
	</label>
	<br/>

	<label>
		created by
		<input type='text' name='created_by' disabled='disabled' value='<?php echo $created_by?>' />
	</label>
	<br/>

	<input type='hidden' name='id' value='<?php echo @$id?>'>
	<input type='submit' name='upload' value='Upload'/>
</form>
