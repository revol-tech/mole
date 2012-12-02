
<section class="login_box">

	<?php
		if(isset($errors)){
			foreach($errors as $error){
				echo '<div class="err">'.$error.'</div>';
			}
		}
	?>

	<form id="login_form" method="post">
		<article>
			<label>
				Username:
				<input type="text" name="username" value='<?php echo @$username?>'>
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