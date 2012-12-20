<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Update_db extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('migration');
	}

	public function index($version = FALSE)
	{
		if($version){
			/**
			 * updates db to the spcified version line 23.
			 */
			$this->migration->version($version);
		}else{
			/**
			 * updates db to be version mentioned in
			 * 	$config['migration_version']
			 *
			 * in line 23 of ./application/config/migration.php
			 * ????????
			 * unsure.
			 */
			$this->migration->latest();
			//$this->migration->version($version);
		}

		echo 'ur db tables should have been automatically initilized.<br/>';
		echo 'to fill in sample data click <a href="'.site_url('update_db/add_sample_data').'">here</a>.';
		$this->_comments();
	}

	public function add_sample_data(){
		$sql =	"INSERT INTO `contacts` (`id`, `address`, `tel`, `fax`, `email`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`, `contacts_type`) VALUES
				(0, ' Ministry of Labour and Employment   Minbhawan, Baneshwor, Kathmandu, Nepal', '+977-1-4107124, 4107288', 'F +977-1-4107288', 'info@mole.gov.np', 1, '2012-12-19 17:14:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, NULL);";
		$this->db->query($sql);

		$sql =	"INSERT INTO `files` (`id`, `filename`, `title`, `description`, `timestamp`, `created_by`, `date_created`, `date_published`, `file_type`, `album_id`) VALUES
				(1, 'slide1.jpg', 'Hon''ble Minister with Secretary', 'Innaguration DOL Program', '1355935239.1404.jpg', 0, '2012-12-19 16:39:31', NULL, 'slider', NULL),
				(2, 'slide2.jpg', 'The Labour Relations', 'Employment Law Practice', '1355935275.3907.jpg', 0, '2012-12-19 16:40:50', NULL, 'slider', NULL),
				(3, 'slide3.jpg', 'Labour''s Alternative', 'Employment Law Practice', '1355935328.0733.jpg', 0, '2012-12-19 16:41:18', NULL, 'slider', NULL),
				(4, 'slide4.jpg', 'Children', 'Have rights too', '1355935352.8419.jpg', 0, '2012-12-19 16:42:11', NULL, 'slider', NULL);";
		$this->db->query($sql);
		copy('./'.IMGPATH.'sliders/slide1.jpg','./'.DOCUMENTS.'1355935239.1404.jpg');
		copy('./'.IMGPATH.'sliders/slide2.jpg','./'.DOCUMENTS.'1355935275.3907.jpg');
		copy('./'.IMGPATH.'sliders/slide3.jpg','./'.DOCUMENTS.'1355935328.0733.jpg');
		copy('./'.IMGPATH.'sliders/slide4.jpg','./'.DOCUMENTS.'1355935352.8419.jpg');


		$sql =	"INSERT INTO `menu` (`id`, `title`, `link`, `parent_id`, `active`, `comments`) VALUES
				(1, 'about us', 'aboutus', 0, 1, ''),
				(2, 'resources', 'resources', 0, 1, ''),
				(3, 'publications', 'publications', 0, 1, ''),
				(4, 'media', 'media', 0, 1, ''),
				(5, 'contact us', 'contactus', 0, 1, '');";
		$this->db->query($sql);

		$sql =	"INSERT INTO `networks` (`id`, `title`, `link`, `description`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`) VALUES
				(1, 'Like us on Facebook', 'http://facebook.com', '', 1, '2012-12-19 17:25:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
				(2, 'Follow us on Twitter', 'http://twitter.com', '', 1, '2012-12-19 17:24:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);";
		$this->db->query($sql);

		$sql =	"INSERT INTO `news` (`id`, `title`, `content`, `news_type`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`) VALUES
				(1, '', '&lt;p&gt;\n The Development of Labour Administrator for the strengthening of Trade Cooperation in ASEAN Community Program&lt;/p&gt;\n', 1, 1, '2012-12-19 10:58:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(2, 'Ministry of Labour and Employment', '&lt;p&gt;\n The Ministry of Labour and Employment is entrusted to promote economic development of the country by creating an investment-friendly environment by means of mobilizing and managing public-private partnership, cooperative and domestic and foreign private investments, and for making the process of industrialization orderly and rapid, and for the development of infrastructure and other sectors to create employment opportunities, and to offer meaningful contribution to poverty alleviation&lt;/p&gt;\n', 6, 1, '2012-12-19 11:04:39', '2012-12-19 11:04:39', '0000-00-00 00:00:00', 1, 1),
				(3, 'An employer or an establishment', '&lt;p&gt;\n An employer or an establishment hit by the floods submits documents concerned to the Provincial Office of Labour&lt;/p&gt;\n', 3, 1, '2012-12-19 11:12:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(4, 'The National Budget for 2013', '&lt;p&gt;\n 9th Annual Sujatha Jayawardena Memorial Oration, organized by Alumini Association, University of Colombo was delivered on &amp;quot;Challenges in formulating the National Budget for 2013&amp;quot; by Dr. P. B. Jayasundera, Secretary, Ministry of Finance&lt;/p&gt;\n', 4, 1, '2012-12-19 11:16:08', '2012-12-19 11:16:08', '0000-00-00 00:00:00', 1, 0),
				(5, 'The floods submits documents', '&lt;p&gt;\n An employer or an establishment hit by the floods submits dicuments concerned to the Provincial Office of Labour&lt;/p&gt;\n', 2, 1, '2012-12-19 11:25:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(6, 'The floods submits documents', '&lt;p&gt;\n An employer or an establishment hit by the floods submits dicuments concerned to the Provincial Office of Labour&lt;/p&gt;\n', 2, 1, '2012-12-19 11:28:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(7, 'Restricated Trading Days', '&lt;p&gt;\n Restricated Trading Days&lt;/p&gt;\n', 7, 1, '2012-12-19 11:41:06', '2012-12-19 11:41:06', '0000-00-00 00:00:00', 1, 0),
				(8, 'Minimum wage rates', '&lt;p&gt;\n Minimum wage rates&lt;/p&gt;\n', 7, 1, '2012-12-19 11:42:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(9, 'Public holidays dates 2012', '&lt;p&gt;\n Public holidays dates 2012&lt;/p&gt;\n', 7, 1, '2012-12-19 11:43:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(10, 'Minimum employment rights', '&lt;p&gt;\n Minimum employment rights&lt;/p&gt;\n', 7, 1, '2012-12-19 11:44:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(11, 'Minimum employment rights', '&lt;p&gt;\n Minimum employment rights&lt;/p&gt;\n', 7, 1, '2012-12-19 11:44:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(14, 'WSH Regulatory Framework ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br /&gt;\n lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta&lt;br /&gt;\n arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.&lt;br /&gt;\n Pellentesque varius massa id elit posuere placerat. Integer tempor&lt;br /&gt;\n cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu&lt;br /&gt;\n purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum&lt;br /&gt;\n interdum in, cursus a nunc. Quisque varius libero id ligula congue&lt;br /&gt;\n euismod. In consequat ultrices diam, eu gravida tortor suscipit et.&lt;br /&gt;\n &lt;br /&gt;\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque.&lt;br /&gt;\n Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros.&lt;br /&gt;\n Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in&lt;br /&gt;\n felis imperdiet dignissim. Integer lobortis, diam vel ultrices&lt;br /&gt;\n fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet&lt;br /&gt;\n eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget&lt;br /&gt;\n libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar&lt;br /&gt;\n sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices&lt;br /&gt;\n posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et&lt;br /&gt;\n netus et malesuada fames ac turpis egestas. Nullam eget est eros.&lt;br /&gt;\n &lt;br /&gt;\n In nec faucibus ipsum. Integer vehicula congue sapien non tincidunt.&lt;br /&gt;\n Phasellus eget massa ligula, vitae consectetur risus. Cras sed nisi&lt;br /&gt;\n lorem. Aliquam erat volutpat. In vulputate sapien eget arcu sagittis&lt;br /&gt;\n lacinia. Curabitur et tortor nisi, a aliquet justo. Donec id purus at&lt;br /&gt;\n tellus eleifend tempor.&lt;br /&gt;\n &lt;br /&gt;\n Fusce mauris leo, dignissim id ornare sed, gravida in augue. Curabitur&lt;br /&gt;\n id quam massa, sit amet fermentum nulla. In a ipsum a elit eleifend&lt;br /&gt;\n lobortis at sit amet risus. Quisque eros ligula, imperdiet vitae&lt;br /&gt;\n dignissim a, rhoncus in est. Etiam ullamcorper metus eget quam ornare&lt;br /&gt;\n tristique vitae non sapien. In accumsan adipiscing lorem, eget faucibus&lt;br /&gt;\n leo tempor vel. Ut id mi eget turpis porta pharetra. Mauris elementum,&lt;br /&gt;\n quam consectetur hendrerit ultricies, purus velit congue quam, vulputate&lt;br /&gt;\n semper nibh mi quis mi. Etiam condimentum lobortis accumsan. Vestibulum&lt;br /&gt;\n felis erat, mattis vel viverra eget, laoreet quis est. Suspendisse&lt;br /&gt;\n congue pretium semper. Integer viverra tristique velit, in tincidunt&lt;br /&gt;\n sapien ultrices id. Morbi fringilla pellentesque leo sit amet congue.&lt;br /&gt;\n Quisque eget mi sed sem euismod bibendum id porttitor lorem.&lt;br /&gt;\n &amp;nbsp;&lt;/p&gt;\n', 5, 1, '2012-12-20 06:28:52', '2012-12-20 06:34:50', '0000-00-00 00:00:00', 1, 0),
				(15, 'Safety & Health Management System ', '&lt;p&gt;\n Nunc aliquet tortor in lectus porttitor fringilla&lt;br /&gt;\n lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta&lt;br /&gt;\n arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.&lt;br /&gt;\n Pellentesque varius massa id elit posuere placerat. Integer tempor&lt;br /&gt;\n cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu&lt;br /&gt;\n purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum&lt;br /&gt;\n interdum in, cursus a nunc. Quisque varius libero id ligula congue&lt;br /&gt;\n euismod. In consequat ultrices diam, eu gravida tortor suscipit et.&lt;br /&gt;\n &lt;br /&gt;\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque.&lt;br /&gt;\n Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros.&lt;br /&gt;\n Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in&lt;br /&gt;\n felis imperdiet dignissim. Integer lobortis, diam vel ultrices&lt;br /&gt;\n fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet&lt;br /&gt;\n eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget&lt;br /&gt;\n libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar&lt;br /&gt;\n sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices&lt;br /&gt;\n posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et&lt;br /&gt;\n netus et malesuada fames ac turpis egestas. Nullam eget est eros.&lt;br /&gt;\n &amp;nbsp;&lt;/p&gt;\n', 5, 1, '2012-12-20 06:30:44', '2012-12-20 06:34:50', '0000-00-00 00:00:00', 1, 0),
				(16, 'Monitoring and Surveillance ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br /&gt;\n lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta&lt;br /&gt;\n arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.&lt;br /&gt;\n Pellentesque varius massa id elit posuere placerat. Integer tempor&lt;br /&gt;\n cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu&lt;br /&gt;\n purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum&lt;br /&gt;\n interdum in, cursus a nunc. Quisque varius libero id ligula congue&lt;br /&gt;\n euismod. In consequat ultrices diam, eu gravida tortor suscipit et.&lt;br /&gt;\n &lt;br /&gt;\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque.&lt;br /&gt;\n Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros.&lt;br /&gt;\n Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in&lt;br /&gt;\n felis imperdiet dignissim. Integer lobortis, diam vel ultrices&lt;br /&gt;\n fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet&lt;br /&gt;\n eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget&lt;br /&gt;\n libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar&lt;br /&gt;\n sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices&lt;br /&gt;\n posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et&lt;br /&gt;\n netus et malesuada fames ac turpis egestas. Nullam eget est eros.&lt;br /&gt;\n &amp;nbsp;&lt;/p&gt;\n', 5, 1, '2012-12-20 06:31:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(17, 'Work Injury Compensation', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br /&gt;\n lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta&lt;br /&gt;\n arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.&lt;br /&gt;\n Pellentesque varius massa id elit posuere placerat. Integer tempor&lt;br /&gt;\n cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu&lt;br /&gt;\n purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum&lt;br /&gt;\n interdum in, cursus a nunc. Quisque varius libero id ligula congue&lt;br /&gt;\n euismod. In consequat ultrices diam, eu gravida tortor suscipit et.&lt;br /&gt;\n &lt;br /&gt;\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque.&lt;br /&gt;\n Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros.&lt;br /&gt;\n Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in&lt;br /&gt;\n felis imperdiet dignissim. Integer lobortis, diam vel ultrices&lt;br /&gt;\n fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet&lt;br /&gt;\n eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget&lt;br /&gt;\n libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar&lt;br /&gt;\n sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices&lt;br /&gt;\n posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et&lt;br /&gt;\n netus et malesuada fames ac turpis egestas. Nullam eget est eros.&lt;br /&gt;\n &amp;nbsp;&lt;/p&gt;\n', 5, 1, '2012-12-20 06:32:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(18, 'Certification & Registration', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br /&gt;\n lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta&lt;br /&gt;\n arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.&lt;br /&gt;\n Pellentesque varius massa id elit posuere placerat. Integer tempor&lt;br /&gt;\n cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu&lt;br /&gt;\n purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum&lt;br /&gt;\n interdum in, cursus a nunc. Quisque varius libero id ligula congue&lt;br /&gt;\n euismod. In consequat ultrices diam, eu gravida tortor suscipit et.&lt;br /&gt;\n &lt;br /&gt;\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque.&lt;br /&gt;\n Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros.&lt;br /&gt;\n Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in&lt;br /&gt;\n felis imperdiet dignissim. Integer lobortis, diam vel ultrices&lt;br /&gt;\n fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet&lt;br /&gt;\n eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget&lt;br /&gt;\n libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar&lt;br /&gt;\n sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices&lt;br /&gt;\n posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et&lt;br /&gt;\n netus et malesuada fames ac turpis egestas. Nullam eget est eros.&lt;br /&gt;\n &amp;nbsp;&lt;/p&gt;\n', 5, 1, '2012-12-20 06:33:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(19, 'Incident Reporting ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br /&gt;\n lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta&lt;br /&gt;\n arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.&lt;br /&gt;\n Pellentesque varius massa id elit posuere placerat. Integer tempor&lt;br /&gt;\n cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu&lt;br /&gt;\n purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum&lt;br /&gt;\n interdum in, cursus a nunc. Quisque varius libero id ligula congue&lt;br /&gt;\n euismod. In consequat ultrices diam, eu gravida tortor suscipit et.&lt;br /&gt;\n &lt;br /&gt;\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque.&lt;br /&gt;\n Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros.&lt;br /&gt;\n Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in&lt;br /&gt;\n felis imperdiet dignissim. Integer lobortis, diam vel ultrices&lt;br /&gt;\n fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet&lt;br /&gt;\n eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget&lt;br /&gt;\n libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar&lt;br /&gt;\n sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices&lt;br /&gt;\n posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et&lt;br /&gt;\n netus et malesuada fames ac turpis egestas. Nullam eget est eros.&lt;br /&gt;\n &amp;nbsp;&lt;/p&gt;\n', 5, 1, '2012-12-20 06:34:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0);";
		$this->db->query($sql);
				
		$sql =	"INSERT INTO `usefullinks` (`id`, `title`, `link`, `description`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`) VALUES
				(1, 'Employment Agreement Builder', 'http://google.com', 'description of usefullinks', 1, '2012-12-19 17:19:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(2, 'Paid Parental Leave Calculator', 'http://google.com', 'description of Paid Parental', 1, '2012-12-19 17:20:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(3, 'Employment Law Database', 'http://google.com', 'description of Database', 1, '2012-12-19 17:20:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
				(4, 'Collective Baiganing Resource', 'http://google.com', 'description of resource', 1, '2012-12-19 17:21:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0);";
		$this->db->query($sql);
				
		$sql =	"INSERT INTO `vip` (`id`, `filename`, `title`, `description`, `timestamp`, `created_by`, `date_created`, `date_published`, `file_type`) VALUES
				(1, 'Prime_minister_Baburam_Bhattarai.jpg', 'Dr. Babu Ram Bhattarai', 'Prime MInister', '1355936183.8766.jpg', 0, '2012-12-19 16:55:58', NULL, ''),
				(2, 'Minister.jpg', 'Mr. Purna Chandra Bhattrai', 'Minister', '1355936206.9151.jpg', 0, '2012-12-19 16:56:28', NULL, '');";
		$this->db->query($sql);
		copy('./'.IMGPATH.'Prime_minister_Baburam_Bhattarai.jpg','./'.DOCUMENTS.'1355936183.8766.jpg');
		copy('./'.IMGPATH.'Minister.jpg','./'.DOCUMENTS.'1355936206.9151.jpg');

		$sql = 	"INSERT INTO `poll` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `created_by`, `date_created`, `date_published`, `date_removed`, `count_option1`, `count_option2`, `count_option3`, `count_option4`, `active`) VALUES
				(1, 'How much should the minimum wage be increased by?', 'Choice 1', 'Choice 2', 'Choice 3', 'Choice 4', 1, '2012-12-20 06:25:51', NULL, NULL, 0, 0, 0, 0, 1);";
		$this->db->query($sql);

		echo 'sample data entered.';
		$this->_comments();
	}
	
	private function _comments(){
		echo '<br/>goto <a href="'.base_url().'">homepage</a>';
		echo '<br/>or <a href="'.site_url('admin/login').'">admin page</a>';		
		echo '<br/>you can safely delete <code>./applications/controllers/update_db.php</code> file.';
	}
}

/* End of file update_db.php */
/* Location: ./application/controller/update_db.php */
