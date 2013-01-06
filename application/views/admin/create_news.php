<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!--
	<!--for date picker

	<script src='<?php echo base_url().JSPATH?>jquery-ui.js'></script>
	<link href='<?php echo base_url().JSPATH ?>jquery-ui.css' rel='stylesheet'/>
	<script>
	$(function() {
		$( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd",defaultDate: 0 });
	});
	</script>
	<style>
	#ui-datepicker-div {
		font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
		font-size: 62.5%;
	}
	body{height:1000px;} /*temporoary. be edited in better format*/
	</style>
-->
<!--<form method='post' action='<?php echo site_url('admin/news/save')?>' style='width:700px;'>-->
<?php echo form_open(site_url('admin/news/save'),array('style'=>'width:700px;'))?>

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

	<textarea name="content" id="content" >
		<?php echo @$content?>
	</textarea>
	<br/>

	<textarea name="content_np" id="content_np" >
		<?php echo @$content_np?>
	</textarea>
	<br/>

	<label>
		link :
		<?php echo site_url('news').'/'?>
		<input type='text' name='link' value='<?php echo @$link?>' />
	</label>
	<br/>
	<input type='hidden' name='linktype' value='news' />

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
	<input type='submit' name='submit' value='save' />
</form>

<?php //echo $generated_editor ?>
<?php //echo $generated_editor2 ?>

<div id='preview'></div>
