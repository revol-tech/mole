<section class="login_box">

	<?php
		if(isset($errors)){
			echo '<div id="err">The following error occured : ';
			foreach($errors as $error){
				echo $error;
			}
			echo '</div>';
		}
	?>

	<form id="login_form" method="post">
		<article>
			<label>
				Username:
				<input type="text" name="username" value='<?php echo isset($username)?$username:''?>'>
			</label>
			<br/>

			<label>
				Password:
				<input type="password" name="password">
			</label>
			<br/>

			<?php echo $image; ?>
			<a href=''>Change captcha</a>

			<input type='text' name='captcha'/>
			<br/>

			<input type="submit" name='login' value="Login">

		</article>
	</form>

</section>