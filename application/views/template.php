<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<!DOCTYPE html>
<html>
<head>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<title><?php echo $title?></title>

	<!-- CSS Start //-->
	<link rel="shortcut icon" href="<?php echo CSSPATH?>images/favicon.ico" type="image/x-icon"/>
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
	<script type="text/javascript" src="<?php echo JSPATH?>jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>jquery.superfish.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>jquery.supersubs.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>jquery.totop.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>functions.js?<?php echo base_url()?>"></script>
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
							<input type="text" value="Search..." name="" class="search fl" onfocus="if(this.value=='Search...')this.value='';" onblur="if(this.value=='')this.value='Search...';"/>
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
	<div id="container">
		<div class="wrap_flag"></div>		
		
		<div id="topheader">
			<div class="grid_1 alpha fl">
				<a href="<?php echo base_url()?>" title="Government of Nepal Ministry of Labour and Employment" id="logo">
					Government of Nepal Ministry of Labour and Employment
				</a>
			</div>

			<div class="grid_2 omega fr">
				<div class="links fr">
					<ul>
						<li><a href="<?php echo base_url().'acts'?>" class="download"><span>Downloads</span></a></li>
						<li><a href="#" class="login"><span>Login</span></a></li>
					</ul>
				</div>
			</div>

		</div>

		<div class="slider-wrapper theme-default fl">
			<?php echo $slider?>
		</div>

		<div class="container_1 fl">
			<?php echo $flash_news?>
		</div>

		<div class="container_2 fl">

			<div class="grid_3 alpha fl">
				<?php echo $page?>
			</div>

			<div class="grid_4 omega alpha fl">
				<?php echo $vip?>
			</div>
		</div>
		<div class="container_3 fl">
			<div class="grid_5 alpha omega fl">
				<?php echo $events?>
				<div id="simple-tabs" class="fl">
					<ul class="tabs">
						<li>
							<a class='en' href="#tab3" <?php echo (($this->session->userdata('lang')=='en')?'':'style="display:none;"')?>>Activities Photos</a>
							<a class='np' href="#tab3" <?php echo (($this->session->userdata('lang')=='np')?'':'style="display:none;"')?>>तस्विर</a>
						</li>
						<li>
							<a class='en' href="#tab2" <?php echo (($this->session->userdata('lang')=='en')?'':'style="display:none;"')?>>Health and Safety</a>
							<a class='np' href="#tab2" <?php echo (($this->session->userdata('lang')=='np')?'':'style="display:none;"')?>>स्वास्थ</a>
						</li>
						<li>
							<a class='en' href="#tab1" <?php echo (($this->session->userdata('lang')=='en')?'':'style="display:none;"')?>>Press Release</a>
							<a class='np' href="#tab1" <?php echo (($this->session->userdata('lang')=='np')?'':'style="display:none;"')?>>प्रेस</a>
						</li>
					</ul>
					<div class="tab_container">
						<div id="tab3" class="tab_content">
							<?php echo $gallery?>
						</div>
						<div id="tab2" class="tab_content">
							<?php echo $health?>
						</div>
						<div id="tab1" class="tab_content">
							<div class="block_img1 fl"> 
								<img src="<?php echo IMGPATH?>Minister.jpg" alt="Prime Minister Baburam Bhattarai" title="Prime Minister Baburam Bhattarai"/>
							</div>
							<?php echo $press?>
						</div>
				</div>
			</div>
		</div>
		<div class="grid_6 alpha omega fl">
			<?php echo $notices?>
			<?php echo $poll?>
		</div>
	</div>
	<div class="clear"></div>
	</div>

	<div id="bottom">
		<div class="bottom_contain_1">
			<?php echo $contacts?>
			<?php echo $usefullinks?>
			<?php echo $network?>
			<?php echo $employments?>

			<div class="clear"></div>
		</div>
	</div>
	
	
	<div id="footer">
		<div class="footer_content en" 
				<?php echo (($this->session->userdata('lang')=='en')?'':'style="display:none;"')?>>
			<div class="grid_6">
				<div class="copyright-text fl"> © 2013 Ministry of Labour and Employment. All Rights Reserved </div>
			</div>
			<div class="grid_7 fr">
				<div class="dev-text fl"> Designed By <a href="http://www.revol-tech.com.np" target="_blank">Revol-tech</a> </div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="footer_content np"
				<?php echo (($this->session->userdata('lang')=='np')?'':'style="display:none;"')?>>
			<div class="grid_6">
				<div class="copyright-text fl"> © २०१३  श्रम तथा यातायात ब्यबस्था मन्त्रालय . सर्बधिकार निहित </div>
			</div>
			<div class="grid_7 fr">
				<div class="dev-text fl"> Designed By <a href="http://www.revol-tech.com.np" target="_blank">Revol-tech</a> </div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	
	
	<a href="#" id="top-link">Scroll to top</a>

	<span style='border:1px solid black;'>
		unique visitors upto now : <?php echo $counter?>
	</span>

</body>
</html>
