<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>
	<a href='<?php echo site_url('admin/poll/edit/'.$id)?>'>
		edit
	</a>
	<br/>


	question :
	<span class='question'><?php echo $question;?></span>
	<br/>

	question (नेपाली):
	<span class='question'><?php echo $question;?></span>
	<br/>

	Publish :
	<?php echo $active?>
	<br/>

	<h4>result:</h4>
	<div class='result'><?php echo $graph?></div>
</div>
