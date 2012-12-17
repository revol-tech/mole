<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<form method='post' action='<?php echo site_url('admin/vip/upload')?>'  enctype="multipart/form-data" style='width:700px;' >
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
		description :
		<input type='text' name='description' />
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
