<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php echo validation_errors()?>

<!--<form method='post' action='<?php echo site_url('admin/usefullinks/save')?>' style='width:700px;'>-->
<?php echo form_open(site_url('admin/usefullinks/save'),array('style'=>'width:700px;'))?>
	<label>
		title
		<input type='text' name='title' value='<?php echo @$title?>' />
	</label>
	<br/>

	<label>
		title (नेपाली)
		<input type='text' name='title_np' value='<?php echo @$title_np?>' />
	</label>
	<br/>

	<label>
		link
		<input type='text' name='link' value='<?php echo @$link?>' />
	</label>
	<br/>

	<label>
		description
		<input type='text' name='description' value='<?php echo @$description?>' />
	</label>
	<br/>

	<label>
		description (नेपाली)
		<input type='text' name='description_np' value='<?php echo @$description_np?>' />
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

	<input type='submit' name='submit' value='submit' />
	<input type='hidden' name='id' value='<?php echo @$id?>'>
</form>
