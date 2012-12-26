<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed')?>

<section class="login_box">

	<?php
		if(isset($errors)){
			foreach($errors as $error){
				echo '<div class="err">'.$error.'</div>';
			}
		}
	?>

	<!--<form id="login_form" method="post">-->
	<?php echo form_open(null,array('id'=>'login_form'))?>
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

			<label>
				<input type="checkbox" name="remember" />
				Remember me
			</label>
			<br/>
			
			<label>
				<a href="#">Forgot password</a>
			</label>
			<br/>

			<input type="submit" name='login' value="Login">

		</article>
	</form>

</section>
