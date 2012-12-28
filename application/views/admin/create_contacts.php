<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!--<form method='post' action='<?php echo site_url('admin/contacts/save')?>' style='width:700px;'>-->
<?php echo form_open(site_url('admin/contacts/save'),array('style'=>'width:700px;'))?>

	<hr/>
	address :<br/>
	<textarea name='address' id='address'>
		<?php echo @$address?>
	</textarea>
	<br/>

	<label>tel :
		<input type='text' name='tel' value='<?php echo @$tel?>' />
	</label>
	<br/>

	<label>fax :
		<input type='text' name='fax' value='<?php echo @$fax?>' />
	</label>
	<br/>

	<label>email :
		<input type='text' name='email' value='<?php echo @$email?>' />
	</label>
	<br/>

	<label>
		link :
		<?php echo site_url('contacts').'/'?>
		<input type='text' name='link' value='<?php echo @$link?>' />
	</label>
	<br/>
	<input type='hidden' name='linktype' value='contacts' />

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
	
	<input type='submit' name='save' value='Save' />
</form>
