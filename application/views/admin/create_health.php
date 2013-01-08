<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!--<form method='post' action='<?php echo site_url('admin/health/save')?>' style='width:700px;'>-->
<?php echo form_open(site_url('admin/health/save'),array('style'=>'width:700px;'))?>
	Content : 
	<textarea name="content" id="content" >
		<?php echo @$content?>
	</textarea>
	<br/>

	Content (नेपाली) : 
	<textarea name="content_np" id="content_np" >
		<?php echo @$content_np?>
	</textarea>
	<br/>

	<label>
		Title : 
		<input type='text' name='title' value='<?php echo @$title?>' />
	</label>
	<br/>

	<label>
		Title (नेपाली) :
		<input type='text' name='title_np' value='<?php echo @$title_np?>' />
	</label>
	<br/>

	<label>
		link :
		<?php echo site_url('health').'/'?>
		<input type='text' name='link' value='<?php echo @$link?>' />
	</label>
	<br/>
	<input type='hidden' name='linktype' value='acts' />

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
	<input type='hidden' name='id' value='<?php echo @$id?>' />
	<input type='submit' name='submit' value='save' />
</form>

<?php //echo $generated_editor ?>

<div id='preview'></div>
