<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<?php echo form_open(site_url('admin/faqs/save'),array('style'=>'width:700px;'))?>
	<label>
		question
		<input type='text' name='question' value='<?php echo @$question?>' />
	</label>
	<br/>

	<label>
		question (नेपाली)
		<input type='text' name='question_np' value='<?php echo @$question_np?>' />
	</label>
	<br/>

	<label>
		faqs type :
		<select name="faqs_type_id">
			<?php foreach($faqs_type as $key=>$val){?>
				<option value="<?php echo $val->id?>" 
					<?php echo $val->id==@$faqs_type_id?'selected=selected':''?>>
						<?php echo $val->title?>
				</option>
			<?php }?>
		</select>
	</label>
	<br/>

	answer :
	<textarea name="answer" id="answer" >
		<?php echo @$answer?>
	</textarea>
	<br/>

	answer (नेपाली):
	<textarea name="answer_np" id="answer_np" >
		<?php echo @$answer_np?>
	</textarea>
	<br/>

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
	<input type='hidden' name='id' value='<?php echo @$id?>'>
	<input type='submit' name='save' value='Save' />
</form>

<?php echo $generated_editor ?>
<?php echo $generated_editor2 ?>

<div id='preview'></div>
