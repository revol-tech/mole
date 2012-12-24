<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>
	<a href='<?php echo site_url('admin/faqs/edit/'.$id)?>'>
		edit
	</a>
	<br/>


	created by :
	<span class='created_by'><?php echo $created_by;?></span>
	<br/>


<!--	Publish :
	<?php //echo $active?>
	<br/>
-->
	question :
	<span class='question'><?php echo $question;?></span>
	<br/>

	faq type :
	<span class='faqs_type'><?php echo $faqs_type;?></span>
	<br/>	

	answer :<br/>
	<hr/>
	<?php echo $answer?>
	<br/>
	<hr/>
</div>
