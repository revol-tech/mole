<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!--<form method='post' action='<?php echo site_url('admin/pages/save')?>' style='width:700px;'>-->
<?php echo form_open(site_url('admin/pages/save'),array('style'=>'width:700px;'))?>

	<textarea name="content" id="content" >
		<?php echo @$content?>
	</textarea>
	<label>
		Title
		<input type='text' name='title' value='<?php echo @$title?>' />
	</label>
	<br/>
	
	<label>
		link :
		<?php echo site_url('pages').'/'?>
		<input type='text' name='link' value='<?php echo @$link?>' />
	</label>
	<br/>
	<input type='hidden' name='linktype' value='pages' />
	
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

	<label>
		Homepage :
		<input type='checkbox' name='homepage' value='1' <?php echo @$active==1?'checked=checkedd':''?>/>
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
