<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>

	<!--<form method='post' action='<?php echo site_url('admin/contacts/del')?>'>-->
	<?php echo form_open(site_url('admin/contacts/del'))?>
		<input type='submit' name='delete' value='Delete' />
		<input type='hidden' name='contacts_id' value='0' />
	</form>
	
	<a href='<?php echo site_url('admin/contacts/edit')?>'>
		edit
	</a>
	<br/>

	<hr/>
	address :<br/>
	<?php echo @$address?>
	<br/>

	tel :
	<span class='title'><?php echo @$tel;?></span>
	<br/>

	fax :
	<span class='title'><?php echo @$fax;?></span>
	<br/>

	email :
	<span class='title'><?php echo @$email;?></span>
	<br/>

	created by :
	<span class='created_by'><?php echo @$created_by;?></span>
	<br/>

	<hr/>
</div>
