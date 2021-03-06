<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<!DOCTYPE html>
<html>
<head>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<title id="main_title"><?php echo (($this->session->userdata('lang')=='en')?
										'Ministry of Labour and Employment':
										'श्रम तथा रोजगार मन्त्रालय')?></title>
	<?php echo $_styles?>
	<link rel="shortcut icon" href="<?php echo base_url().CSSPATH?>images/favicon.ico" type="image/x-icon"/>	
	<?php echo $_scripts?>
</head>

<body>
	<div id="wrapper">
		<div id="header">
			<div class="container_1">
				<div class="grid_1 fl">
					<?php echo $menu?>
				</div>
				<div class="grid_2 fr">
					<div id="search-box">
						<?php echo form_open()?>
							<input type="text" value="Search..." name="" class="search fl"
								onfocus="if(this.value=='Search...')this.value='';" 
								onblur="if(this.value=='')this.value='Search...';"/>
							<input class="btn-search fr" type="submit" value=""/>
						</form>
					</div>
					<?php echo $lang_menu ?>
				</div>

				<!-- Main menu end -->
				<div class="clear"></div>
			</div>
		</div>

		<!--Header End --> 
		<?php echo $sub_menu?>
	</div>
	
	<!-- Contain starts Here -->
	<div id="inner_container">
		<div id="topheader">
			<div class="grid_1 alpha fl"> 
				<a href="<?php echo base_url()?>" title="Government of Nepal Ministry of Labour and Employment" id="logo"
					class="en"	<?php echo (($this->session->userdata('lang')=='en')?'':'style="display:none;"')?> >
					Government of Nepal Ministry of Labour and Employment
				</a>
				<a href="<?php echo base_url()?>" title="Government of Nepal Ministry of Labour and Employment" id="logo_np"
					class="np" <?php echo (($this->session->userdata('lang')=='np')?'':'style="display:none;"')?> >
					Government of Nepal Ministry of Labour and Employment
				</a>				
			</div>
			<div class="grid_2 omega fr">
				<div class="links fr">
					<ul>
						<li>
							<a href="<?php echo base_url().'acts'?>" class="download en" <?php echo (($this->session->userdata('lang')=='en')?'':'style="display:none;"')?>>
								<span>Downloads</span>
							</a>
							<a href="<?php echo base_url().'acts'?>" class="download np" <?php echo (($this->session->userdata('lang')=='np')?'':'style="display:none;"')?>>
								<span>डाउनलोड</span>
							</a>
						</li>
						<li>
							<a href="#" class="login en" <?php echo (($this->session->userdata('lang')=='en')?'':'style="display:none;"')?>>
								<span>Login</span>
							</a>
							<a href="#" class="login np" <?php echo (($this->session->userdata('lang')=='np')?'':'style="display:none;"')?>>
								<span>लगिन</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container_1 fl">
			
			<div class="grid_3 alpha fl">
				<?php echo @$events?>
			</div>
		</div>
		
<!--		
		<div class="container_2 fl">
			<div class="grid_5 alpha fl">
				<?php echo @$acts?>
			</div>
			<div class="grid_6 fr omega">
				<?php echo @$poll?>
			</div>
		</div>
		
		
		<div class="container_3 fl">
			<div class="grid_7 fl">
				<?php echo @$feedback?>
			</div>
			<div class="grid_7  fl">
				<?php echo @$faqs?>
			</div>
			<div class="grid_7 fl">
				<?php echo @$notices?>
			</div>
		</div>
-->

		<div class="wrap_flag">
			<img title="Flag Nepal.gif" alt="Nepal_Flag moving" src="<?php echo base_url().IMGPATH?>nepal_flag_animation.gif">
		</div>	

		<div class="clear"></div>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php if(isset($contacts)||isset($usefullinks)||
				isset($network)||(isset($employments))):?>
	<div id="bottom">
		<div class="bottom_contain_1">
			<?php echo @$contacts?>
			<?php echo @$usefullinks?>
			<?php echo @$network?>
			<?php echo @$employments?>
			
			<div class="clear"></div>
		</div>
	</div>
	<?php endif;?>
	
	<div id="footer">
		<div class="footer_content">
			<div class="grid_6">
				<div class="copyright-text fl">
					 © 2012 Ministry of Labour and Employment. All Rights Reserved 
				</div>
			</div>
			<div class="grid_7 fr">
				<div class="dev-text fl"> Designed By <a href="#">Revol-tech</a> </div>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<a href="#" id="top-link">Scroll to top</a> 

</body>
</html>
