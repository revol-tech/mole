<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php echo form_open(site_url('admin/organizations/save'),array('style'=>'width:700px;'))?>
	
	<label>
		Title
		<!--<input type='text' name='title' value='<?php echo @$title?>' />-->
		<select style="width: 200px;" onchange="$('#title').val($(this).val());">
			<?php echo @$title_dropdown?>
		</select>
		<input id='title' type='text' name='title' value='<?php echo @$title?>' style="margin-left: -200px; width: 170px; height: 1.2em; border: 0;z-index:5;" />
	</label>
	<br/>

	<label>
		Title (नेपाली)
		<!--<input type='text' name='title' value='<?php echo @$title?>' />-->
		<select style="width: 200px;" onchange="$('#title').val($(this).val());">
			<?php echo @$title_dropdown_np?>
		</select>
		<input id='title_np' type='text' name='title_np' value='<?php echo @$title_np?>' style="margin-left: -200px; width: 170px; height: 1.2em; border: 0;z-index:5;" />
	</label>
	<br/>



	<label>
		Sub Title
		<textarea name='sub_title'><?php echo @$sub_title?></textarea>
	</label>
	<br/>

	<label>
		Sub Title (नेपाली)
		<textarea name='sub_title_np'><?php echo @$sub_title_np?></textarea>
	</label>
	<br/>

<!--
	<label>
		image :
		<input type='file' name='about_img' />
	</label>
	<br/>
-->

	<label>
		created on
		<input type='text' name='date_created' disabled='disabled' value='<?php echo $date_created?>'/>
	</label>
	<br/>

	<label>
		created by
		<input type='text' name='created_by' disabled='disabled' value='<?php echo $created_by?>' />
	</label>
	<br/>
<!--	<label>
		publish on
		<input type='text' name='date_published' class='datepicker' />
	</label>
	<br/>
	<label>
		removed on
		<input type='text' name='date_published' class='datepicker' />
	</label>
--->
	<input type='hidden' name='id' value='<?php echo @$id?>'>
	
	<input type="submit" name='submit' value='Submti' />
</form>
