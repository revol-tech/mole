<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<!DOCTYPE html>
<html>
<head>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<title><?php echo $title?></title>

	<!-- CSS Start //-->
	<link rel="shortcut icon" href="<?php echo CSSPATH?>images/favicon.png"/>
	<!--<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH?>style.css"/>-->

	<!-- Import CSS Reset File -->
	<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH?>reset.css"/>
	<!-- Import CSS 960 Grid System File -->
	<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH?>grid.css"/>
	<!-- Import MAIN CSS File -->
	<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH?>styles.css"/>

	<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH?>superfish.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH?>default.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH?>nivo-slider.css" media="screen" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

	<script src="<?php echo JSPATH?>jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>jquery.superfish.js"></script>
	<script type="text/javascript" src="<?php echo JSPATH?>jquery.supersubs.js"></script>
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
          <form>
            <input type="text" value="Search..." name="" class="search fl" onfocus="if(this.value=='Search...')this.value='';" onblur="if(this.value=='')this.value='Search...';"/>
            <input class="btn-search fr" type="submit" value=""/>
          </form>
        </div>
        <div class="language fr"> <a href="#" class="nepal fl color">Nepali</a> <a href="#" class="active fl">English</a> </div>
      </div>
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
</div>

<!-- Contain starts Here -->
<div id="container">
  <div id="topheader">
    <div class="grid_1 alpha fl">
		<a href="<?php echo base_url()?>" title="Government of Nepal Ministry of Labour and Employment" id="logo">
			Government of Nepal Ministry of Labour and Employment
		</a>
	</div>
    <div class="grid_2 omega fr">
      <div class="links fr">
        <ul>
          <li>
			  <a href="#" class="download">
				  <span>Downloads</span>
			  </a>
		  </li>
          <li>
			  <a href="#" class="login">
				  <span>Login</span>
			  </a>
		  </li>
        </ul>
      </div>
    </div>
  </div>


	<div class="slider-wrapper theme-default fl">
		<?php echo $slider?>
	</div>


	<div class="container_1 fl">
		<div class="newsticker">
			<div class="ticker_title fl">
				<h3>News</h3>
			</div>
			<div class="ticker_block fl">
				<p>The Development of Labour Administration for the Strengthening
					of Trade Cooperation in ASEAN Community Program...</p>
				<a href="#" class="readon">Read more</a>
			</div>
		</div>
	</div>

  <div class="container_2 fl">
    <div class="grid_3 alpha fl">
      <div class="about">
        <h1>Ministry of Labour and Employment</h1>
        <p>The Ministry of Labour and Employment is entrusted to promote economic development of the country by creating an investment-friendly environment by means of mobilizing and managing public-private partnership, cooperative and domestic and foreign private investments, and for making the process of industrialization orderly and rapid, and for the development of infrastructure and other sectors to create employment opportunities, and to offer meaningful contribution to poverty alleviation</p>
        <a href="#" class="btn_red fr">read more</a> </div>
    </div>
    <div class="grid_4 omega alpha fl">
      <div class="highlight fl">
        <div class="intro_block fl">
          <div class="block_img1 fl"> <img src="images/Prime minister Baburam Bhattarai.jpg" alt="Prime Minister Baburam Bhattarai" title="Prime Minister Baburam Bhattarai"/> </div>
          <div class="intro_box fr">
            <div class="name fl">Dr. Baburam Bhattarai</div>
            <div class="title fl">Prime Minister of Nepal</div>
          </div>
        </div>
        <div class="intro_block omega_bottom fl">
          <div class="block_img1 fl"> <img src="images/Minister.jpg" alt="Prime Minister Baburam Bhattarai" title="Prime Minister Baburam Bhattarai"/> </div>
          <div class="intro_box fr">
            <div class="name fl">Mr. Purna Chandra Bhattrai</div>
            <div class="title fl">Minister of Department</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container_3 fl">
    <div class="grid_5 alpha omega fl">
    <!--<div id="simple-tabs">
                        <ul class="tabs">
                            <li><a href="#tab1">Tab 1</a></li>
                            <li><a href="#tab2">Tab 2</a></li>
                            <li><a href="#tab3">Tab 3</a></li>
                        </ul>

                        <div class="tab_container">
                            <div id="tab1" class="tab_content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. <strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit</strong>. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. <strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit</strong>. Vestibulum lacinia arcu eget nulla. </p>
                                <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. <strong>Mauris massa</strong>. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. <strong>Curabitur tortor</strong>. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. </p>
                            </div>
                            <div id="tab2" class="tab_content">
                                <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. <strong>Mauris massa</strong>. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. <strong>Curabitur tortor</strong>. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. </p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. <strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit</strong>. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. <strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit</strong>. Vestibulum lacinia arcu eget nulla. </p>
                            </div>
                            <div id="tab3" class="tab_content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. <strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit</strong>. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. <strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit</strong>. Vestibulum lacinia arcu eget nulla. </p>
                                <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. <strong>Mauris massa</strong>. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. <strong>Curabitur tortor</strong>. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. </p>
                            </div>
                        </div>
                    </div>-->


    </div>
    <div class="grid_6 alpha omega fl">
      <div class="item1 fl">
        <h2><span>Latest</span> Notices</h2>
        <ul>
          <li><strong>The floods submits documents... <a href="#" class="title_date">Nov 12 2012</a></strong> <span>An employer or an establishment hit by the floods submits documents concerned to the Provincial Office of Labour...<a href="#" class="more">more</a></span> </li>
          <li><strong>The floods submits documents... <a href="#" class="title_date">Nov 12 2012</a></strong> <span>An employer or an establishment hit by the floods submits documents concerned to the Provincial Office of Labour...<a href="#" class="more">more</a></span> </li>
        </ul>
      </div>

	<?php echo $poll?>

    </div>
  </div>
  <div class="clear"></div>

</div>

<script type="text/javascript" src="<?php echo JSPATH?>jquery.nivo.slider.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
</body>
</html>