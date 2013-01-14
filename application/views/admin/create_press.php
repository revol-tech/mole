<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php echo form_open(site_url('admin/press/save'),array('style'=>'width:700px;'))?>
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
	<input type='hidden' name='id' value='<?php echo @$id?>'/>
	<input type='submit' name='submit' value='save'/>
</form>

<?php echo $generated_editor ?>
<?php echo $generated_editor2 ?>

<div id='preview'></div>
