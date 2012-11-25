<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
if($_REQUEST){
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
}
?>

<form method='post' action='<?php echo site_url('admin/news/save')?>' style='width:700px;'>
	<textarea name="content" id="content" >
		<?php echo isset($_POST['content'])?$_POST['content']:''?>
	</textarea>
	<label>
		Keywords
		<input type='text' name='title' />
	</label>
	<br/>
	<label>
		created on
		<input type='text' name='date_created' disabled='disabled' />
	</label>
	<br/>
	<label>
		created by
		<input type='text' name='created_by' disabled='disabled' />
	</label>
	<br/>
	<label>
		publish on
		<input type='text' name='date_published' />
	</label>
	<br/>
	<label>
		removed on
		<input type='text' name='date_published' />
	</label>
</form>

<?php echo $generated_editor ?>

<div id='preview'></div>

<script>
/*$(function() {
    var editor = CKEDITOR.editor.replace('CKEditor'); // define CKEditor

    $("#submit").click(function() {
        var text = editor.getData(); // Use CKEditor inbuilt functionality to get the content
        $.ajax({
            type: "POST",
            url: <?php echo site_url('admin/news/save')?>,
            data: "text=" + text,
            dataType: "html",
            success: function(data) {
				alert('adsf');
                $("#text-container").append(data);
            });
        });
    });
});
*/</script>