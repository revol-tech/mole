<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>
	<a href='<?php echo site_url('admin/contacts/edit')?>'>
		add/edit
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
