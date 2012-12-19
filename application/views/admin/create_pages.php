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
<form method='post' action='<?php echo site_url('admin/pages/save')?>' style='width:700px;'>
	<textarea name="content" id="content" >
		<?php echo @$content?>
	</textarea>
	<label>
		Title
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
