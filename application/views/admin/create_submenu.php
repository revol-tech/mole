<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php echo form_open(site_url('admin/submenu/save'))?>

	title :
	<input type='text' name='title' value='<?php echo @$title?>'/>
	<br/>

	title (नेपाली) :
	<input type='text' name='title_np' value='<?php echo @$title_np?>'/>
	<br/>

	comments :
	<input type='text' name='comments' value='<?php echo @$comments?>'/>
	<br/>

	comments (नेपाली) :
	<input type='text' name='comments_np' value='<?php echo @$comments_np?>'/>
	<br/>

	link :
	<?php echo base_url()?><input type='text' name='link' value='<?php echo @$link;?>'/>
	<br/>

	<label>
		active
		<input type='checkbox' name='active' value='1'<?php echo @$active==1?'checked="checked"':''?>/>
	</label>
	<br/>

	<?php /* to get the id of the menu when editing. */?>
	<input type='hidden' name='id' value='<?php echo @$id?>'/>

	<input type='submit' name='submit' value='Submit' id='submit' />
</form>
