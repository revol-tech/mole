<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php echo validation_errors()?>

<?php echo form_open_multipart(site_url('admin/pages/save'),array('style'=>'width:700px;'))?>

	<label>
		Title
		<input type='text' name='title' value='<?php echo @$title?>' />
	</label>
	<br/>
	
	<label>
		Title (नेपाली)
		<input type='text' name='title_np' value='<?php echo @$title_np?>' />
	</label>
	<br/>

	content :
	<textarea name="content" id="content" >
		<?php echo @$content?>
	</textarea>
	<br/>
	
	content (नेपाली) : 
	<textarea name="content_np" id="content_np" >
		<?php echo @$content_np?>
	</textarea>
	<br/>

	image : 
	<?php if(!isset($filename)){?>
		<input class="img" type='file' name='file' />
	<?php } else {?>
		<img class="img" src='<?php echo base_url().DOCUMENTS.$filename?>' height='140' width='150'>
		<a href='#' class='change_img'>change</a>
	<?php }?>
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
	
	<input type='submit' name='submit' value='save' />
</form>

<?php echo $generated_editor ?>
<?php echo $generated_editor2 ?>
<div id='preview'></div>
