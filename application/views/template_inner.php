<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<!DOCTYPE html>
<html>
<head>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<title><?php echo @$title?></title>
	<?php echo $_styles?>
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
	</div>
	
	<!-- Contain starts Here -->
	<div id="inner_container">
		<div id="topheader">
			<div class="grid_1 alpha fl"> 
				<a href="<?php echo base_url()?>" title="Government of Nepal Ministry of Labour and Employment" id="logo">
					Government of Nepal Ministry of Labour and Employment
				</a> 
			</div>
			<!--
			<div class="grid_2 omega fr">
				<div class="links fr">
					<ul>
						<li><a href="#" class="download"><span>Downloads</span></a></li>
						<li><a href="#" class="login"><span>Login</span></a></li>
					</ul>
				</div>
			</div>
			-->
		</div>

		<div class="container_1 fl">
			
			<div class="grid_3 alpha fl">
				<?php echo @$page?>
			</div>
			<div class="grid_4 omega fl">
				<?php echo @$news?>
			</div>
		</div>
		
		<div class="container_1 fl">
			
			<div class="grid_3 alpha fl">
				<?php echo @$organizations?>
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

	<span style='border:1px solid black;'>
		unique visited upto now : <?php echo @$counter?>
	</span>

</body>
</html>
