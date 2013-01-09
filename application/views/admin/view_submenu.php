<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>
	<a href='<?php echo site_url('admin/submenu/edit/'.$id)?>'>
		edit
	</a>
	<br/>

	title :
	<?php echo $title;?>
	<br/>

	title (नेपाली) :
	<?php echo $title_np;?>
	<br/>

	comments:
	<?php echo @$comments;?>
	<br/>

	comments (नेपाली) :
	<?php echo @$comments;?>
	<br/>

	link :
	<a href='<?php echo base_url().$link;?>'><?php echo base_url().$link?></a>
	<br/>

	<label>
		active
		<?php echo $active?>
	</label>
	<br/>

</div>
