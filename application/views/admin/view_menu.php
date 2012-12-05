<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>

	title :
	<?php echo $title;?>
	<br/>

	link :
	<a href='<?php echo base_url().$link;?>'><?php echo base_url().$link?></a>
	<br/>

	parent id :
	<?php echo @$parent_id;?>
	<br/>

	<label>
		active
		<?php echo $active?>
	</label>
	<br/>

	comments:
	<?php echo @$comments;?>

</div>