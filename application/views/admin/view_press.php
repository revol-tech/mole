<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>
	<a href='<?php echo site_url('admin/press/edit/'.$id)?>'>
		edit
	</a>
	<br/>
	<?php echo form_open(site_url('admin/press/del/'))?>
		<input type="hidden" name="press_id" value="<?php echo $id?>"/>
		<input type="submit" name="del" value="Delete"/>
	</form>

	title :
	<span class='title'><?php echo $title;?></span>
	<br/>

	title (नेपाली):
	<span class='title_np'><?php echo $title;?></span>
	<br/>

	image : 
	<img src="<?php echo base_url().DOCUMENTS.$filename?>" width='150' height='140'/>
	<br/>	

	content :<br/>
	<hr/>
	<?php echo $content?>
	<br/>
	<hr/>

	content (नेपाली):<br/>
	<hr/>
	<?php echo $content_np?>
	<br/>
	<hr/>

	created by :
	<span class='created_by'><?php echo $created_by;?></span>
	<br/>

	Publish :
	<?php echo $active?>
	<br/>
</div>
