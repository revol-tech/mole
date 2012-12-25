<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<!DOCTYPE html>
<html>
<head>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<title><?php echo @$title?></title>

	<!-- CSS Start //-->
	<link rel="shortcut icon" href="<?php echo CSSPATH?>images/favicon.png"/>
	<!--<link rel="stylesheet" type="text/css" href="./style.css"/>-->

	<!-- Import CSS Reset File -->
	<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH?>reset.css"/>
	<!-- Import CSS 960 Grid System File -->
	<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH?>grid.css"/>
	<!-- Import MAIN CSS File -->
	<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH?>styles.css"/>

	<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH?>superfish.css" />
	<link rel="stylesheet" href="<?php echo CSSPATH?>default.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo CSSPATH?>nivo-slider.css" type="text/css" media="screen" />
	<link href='<?php echo CSSPATH?>tmp.css' rel='stylesheet' type='text/css'>
	<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>-->
	<script src="<?php echo JSPATH?>jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>jquery.jqprint-0.3.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>jquery.superfish.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>jquery.supersubs.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>jquery.totop.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>functions.js"></script>
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
					<div class="language fr"> 
						<a href="#" class="nepal fl color">Nepali</a> 
						<a href="#" class="active fl">English</a> 
					</div>
				</div>
				<!-- Main menu end -->
				<div class="clear"></div>
			</div>
		</div>
		<div id="header_bottom">
			<div class="container_1">
				<ul class="sub_nav">
					<li ><a href="#">Signin</a> </li>
					<li><a href="#">Register Now</a> </li>
					<li><a href="#">Forgot Password</a> </li>
				</ul>
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
			<div class="grid_2 omega fr">
				<div class="links fr">
					<ul>
						<li><a href="#" class="download"><span>Downloads</span></a></li>
						<li><a href="#" class="login"><span>Login</span></a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container_1 fl">
			
			<div class="grid_3 alpha fl">
				<?php echo @$page?>
			</div>
			<div class="grid_4 omega fl">
				<?php echo @$news?>
			</div>
		</div>
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
		<div class="clear"></div>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div id="bottom">
		<div class="bottom_contain_1">
			<?php echo @$contacts?>
			<?php echo @$usefullinks?>
			<?php echo @$network?>
			<?php echo @$employments?>
			
			<div class="clear"></div>
		</div>
	</div>
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
