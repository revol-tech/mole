<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
	<br/>
	<a href='<?php echo site_url('admin/divisions/edit/'.$id)?>'>
		edit
	</a>
	<br/>
	<?php echo form_open(site_url('admin/divisions/del/'))?>
		<input type="hidden" name="divisions_id" value="<?php echo $id?>"/>
		<input type="submit" name="del" value="Delete"/>
	</form>


	title :
	<span class='title'><?php echo $title?></span>
	<br/>

	title (नेपाली) :
	<span class='title_np'><?php echo $title_np?></span>
	<br/>

	image : 
	<img src="<?php echo base_url().DOCUMENTS.$filename?>" width='150' height='140'/>
	<br/>
	
	name:<?php echo $person?> 
	<a href="<?php echo site_url('admin/vip/edit/'.$person_id)?>">edit</a>
	<br/>
	post:<?php echo $person_post?>
	<br/>	


	content :<br/>
	<hr/>
	<?php echo $content?>
	<br/>
	<hr/>

	content (नेपाली) :<br/>
	<hr/>
	<?php echo $content_np?>
	<br/>
	<hr/>

	link :
	<span class='link'>
		<a href="<?php echo base_url().$link?>"><?php echo base_url().$link?></a>
	</span>
	<br/>
	

	created by :
	<span class='created_by'><?php echo $created_by;?></span>
	<br/>


	Publish :
	<?php echo $active?>
	<br/>
</div>
