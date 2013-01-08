<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php echo form_open(site_url('admin/poll/save'))?>

	question :
	<input type='text' name='question' value='<?php echo @$question;?>'/>
	<br/>

	question (नेपाली):
	<input type='text' name='question_np' value='<?php echo @$question;?>'/>
	<br/>

	option 1 :
	<input type='text' name='option1' value='<?php echo @$option1;?>'/>
	<br/>

	option 1 (नेपाली):
	<input type='text' name='option1_np' value='<?php echo @$option1;?>'/>
	<br/>

	option 2 :
	<input type='text' name='option2' value='<?php echo @$option2;?>'/>
	<br/>

	option 2 (नेपाली):
	<input type='text' name='option2_np' value='<?php echo @$option2;?>'/>
	<br/>

	option 3 :
	<input type='text' name='option3' value='<?php echo @$option3;?>'/>
	<br/>

	option 3 (नेपाली):
	<input type='text' name='option3_np' value='<?php echo @$option3;?>'/>
	<br/>

	option 4 :
	<input type='text' name='option4' value='<?php echo @$option4;?>'/>
	<br/>

	option 4 (नेपाली):
	<input type='text' name='option4_np' value='<?php echo @$option4;?>'/>
	<br/>


	<label>
		Publish
		<input type='checkbox' name='publish' value='1' <?php echo @$active==1?'checked=checkedd':''?>/>
	</label>
	<br/>

	<?php /* to get the id of the question when editing. */?>
	<input type='hidden' name='id' value='<?php echo @$id?>'/>

	<input type='submit' name='submit' value='Submit' id='submit' />
</form>
