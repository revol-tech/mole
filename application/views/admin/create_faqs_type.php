<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<?php echo form_open(site_url('admin/faqs/save_type'),array('style'=>'width:700px;'))?>
	<label>
		title
		<input type='text' name='title' value='<?php echo @$title?>' />
	</label>
	<br/>
	description :
	<textarea name="description" id="description" >
		<?php echo @$description?>
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
	<input type='hidden' name='id' value='<?php echo @$id?>'>
	
	<input type='submit' value='save' />
</form>

<div id='preview'></div>
