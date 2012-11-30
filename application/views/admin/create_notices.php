<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<form method='post' action='<?php echo site_url('admin/notices/save')?>' style='width:700px;'>
	<textarea name="content" id="content" >
		<?php echo @$content?>
	</textarea>
	<label>
		Keywords
		<input type='text' name='title' value='<?php echo @$title?>' />
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
<!--	<label>
		publish on
		<input type='text' name='date_published' class='datepicker' />
	</label>
	<br/>
	<label>
		removed on
		<input type='text' name='date_published' class='datepicker' />
	</label>
--->
	<input type='hidden' name='id' value='<?php echo @$id?>'>
</form>

<?php echo $generated_editor ?>

<div id='preview'></div>