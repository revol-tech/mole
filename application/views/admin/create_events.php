<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php echo validation_errors()?>

<?php echo form_open_multipart(site_url('admin/events/save'),array('style'=>'width:700px;'))?>
	<label>
		Title
		<textarea name='title'>
			<?php echo @$title?>
		</textarea>
	</label>
	<br/>

	<label>
		Title (नेपाली) :
		<textarea name='title_np'>
			<?php echo @$title_np?>
		</textarea>
	</label>
	<br/>

	<label>
		contents : 
		<textarea name="content" id="content" >
			<?php echo @$content?>
		</textarea>
	</label>
	<br/>

	<label>
		contents (नेपाली) : 
		<textarea name="content_np" id="content_np" >
			<?php echo @$content_np?>
		</textarea>
	</label>
	<br/>

	<label>
		image : 
		<input type='file' name='file' />
	</label>
	<br/>

	<label>
		link :
		<?php echo site_url('events').'/'?>
		<input type='text' name='link' value='<?php echo @$link?>' />
	</label>
	<br/>
	<input type='hidden' name='linktype' value='events' />

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

	<input type='submit' name='submit' value='save' />
</form>

<?php echo $generated_editor ?>
<?php echo $generated_editor2 ?>

<div id='preview'></div>
