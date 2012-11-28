<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<form method='post' action='<?php echo site_url('admin/poll/save')?>'>

	question :
	<input type='text' name='question'/>
	<br/>

	option 1 :
	<input type='text' name='option1'/>
	<br/>

	option 2 :
	<input type='text' name='option2'/>
	<br/>

	option 3 :
	<input type='text' name='option3'/>
	<br/>

	option 4 :
	<input type='text' name='option4'/>
	<br/>

	<label>
		Publish
		<input type='checkbox' name='publish' value='1'/>
	</label>
	<br/>

	<input type='submit' name='submit' value='Submit' id='submit' />
</form>