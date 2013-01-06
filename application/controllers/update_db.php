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
				(4, 'slide4.jpg', 'Children', 'Have rights too', '1355935352.8419.jpg', 0, '2012-12-19 16:42:11', NULL, 'slider', NULL),
				(5, 'gallery_1.png', 'Album 1', 'More about album 1', '1356033859.9995.png', 0, '2012-12-20 20:04:07', NULL, NULL, 1),
				(6, 'gallery_2.png', 'Album 2', 'More about album 2', '1356033913.3109.png', 0, '2012-12-20 20:04:53', NULL, NULL, 2),
				(7, 'gallery_3.png', 'Album 2', 'More about album 2', '1356033941.4707.png', 0, '2012-12-20 20:05:17', NULL, NULL, 2),
				(8, 'gallery_4.png', 'Album 3', 'More about album 3', '1356033966.351.png', 0, '2012-12-20 20:05:46', NULL, NULL, 3);";
				
		$this->db->query($sql);
		copy('./'.IMGPATH.'sliders/slide1.jpg','./'.DOCUMENTS.'1355935239.1404.jpg');
		copy('./'.IMGPATH.'sliders/slide2.jpg','./'.DOCUMENTS.'1355935275.3907.jpg');
		copy('./'.IMGPATH.'sliders/slide3.jpg','./'.DOCUMENTS.'1355935328.0733.jpg');
		copy('./'.IMGPATH.'sliders/slide4.jpg','./'.DOCUMENTS.'1355935352.8419.jpg');

		copy('./'.IMGPATH.'gallery/gallery_1.png','./'.DOCUMENTS.'1356033859.9995.png');
		copy('./'.IMGPATH.'gallery/gallery_2.png','./'.DOCUMENTS.'1356033913.3109.png');
		copy('./'.IMGPATH.'gallery/gallery_3.png','./'.DOCUMENTS.'1356033941.4707.png');
		copy('./'.IMGPATH.'gallery/gallery_4.png','./'.DOCUMENTS.'1356033966.351.png');

		$sql = 	"INSERT INTO `menu` (`id`, `title_np`, `comments_np`, `title`, `comments`, `link`, `parent_id`, `active`) VALUES
				(1, 'हाम्रो बारे', 'कलज;ाद;ल सकज;लसदकज', 'about us', 'as asdg asg sa sg s', 'pages/xx', 0, 1),
				(2, 'रिसोर्सेस', '', 'resources', '', 'resources', 0, 1),
				(3, '', '', 'publications', '', 'publications', 0, 0),
				(5, '', '', 'contact us', '', 'contacts/x4', 0, 0),
				(7, '', '', 'All possible links', 'Contains the tree of all possible links', 'all', 0, 0),
				(8, 'ऐन कानुन', '', 'acts & laws', '', 'acts', 7, 1),
				(9, 'श्रम', '', 'Employments', '', 'employments', 7, 1),
				(10, 'कार्यकौम', '', 'events', '', 'events', 7, 1),
				(11, 'प्रश्न-उत्तर', '', 'FAQs', 'shoqs all of the faqs ...', 'faqs', 7, 1),
				(12, 'स्वास्त', '', 'health', 'Safety & Health Management System', 'health', 7, 1),
				(14, 'नोटिसेस्', '', 'Notices', 'lists all the notices', 'notices', 7, 1),
				(15, 'छापा', '', 'Press Release', 'press releases ....', 'press', 7, 1),
				(16, 'पोल', '', 'Polls', 'polls', 'polls', 7, 1),
				(17, 'ओरगनाईजेसन', '', 'Organization', 'About organization', '', 0, 1),
				(19, 'सुरुवात', '', 'Introduction', '', 'pages/introduction', 17, 1),
				(20, 'मान्डेटस', '', 'Mandates', '', 'pages/mandates', 17, 1),
				(21, 'सस्ता', '', 'Organization Chart', '', 'pages/chart', 17, 1),
				(22, 'मुख्य प्लान', '', 'Master Plan', '', 'pages/plan', 17, 1),
				(23, 'सम्बन्धित कार्यलय', '', 'Related Offices', '', 'pages/offices', 0, 1),
				(24, 'ढि ओ ऐफ ई', '', 'DOFE', '', 'pages/dofe', 23, 1),
				(26, 'सुरुवात', '', 'Introduction to DOFE', '', 'pages/dofe-intro', 24, 1),
				(27, 'समाचार', '', 'News and Alerts', '', 'pages/dofe-news-and-alerts', 24, 1),
				(28, 'ढि ओ ऐल', '', 'DOL', '', 'pages/dol', 23, 1),
				(29, 'ओ एस् एच पि', '', 'OSHP', '', 'pages/oshp', 23, 1),
				(30, 'मिडिया', '', 'Media', '', 'pages/media', 0, 1);";

		$this->db->query($sql);

		$sql =	"INSERT INTO `networks` (`id`, `title`, `link`, `description`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`) VALUES
				(1, 'Like us on Facebook', 'http://facebook.com', '', 1, '2012-12-19 17:25:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
				(2, 'Follow us on Twitter', 'http://twitter.com', '', 1, '2012-12-19 17:24:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);";
		$this->db->query($sql);

		$sql = 	"INSERT INTO `news` (`id`, `title`, `content`, `title_np`, `content_np`, `news_type`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`, `lang`) VALUES
				(1, ' Development of Labour Administrator', '&lt;p&gt;\n The Development of Labour Administrator for the strengthening of Trade Cooperation in ASEAN Community Program&lt;/p&gt;\n', NULL, NULL, 1, 1, '2012-12-18 23:28:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
				(4, 'The National Budget for 2013', '&lt;p&gt;\n 9th Annual Sujatha Jayawardena Memorial Oration, organized by Alumini Association, University of Colombo was delivered on &amp;quot;Challenges in formulating the National Budget for 2013&amp;quot; by Dr. P. B. Jayasundera, Secretary, Ministry o', NULL, NULL, 4, 1, '2012-12-18 23:46:08', '2012-12-18 23:46:08', '0000-00-00 00:00:00', 1, 0, 'en'),
				(5, 'The floods submits documents', '&lt;p&gt;\n An employer or an establishment hit by the floods submits dicuments concerned to the Provincial Office of Labour&lt;/p&gt;\n', NULL, NULL, 2, 1, '2012-12-18 23:55:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
				(6, 'The floods submits documents', '&lt;p&gt;\n An employer or an establishment hit by the floods submits dicuments concerned to the Provincial Office of Labour&lt;/p&gt;\n', NULL, NULL, 2, 1, '2012-12-18 23:58:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
				(7, 'Restricated Trading Days', '&lt;p&gt;\n Restricated Trading Days&lt;/p&gt;\n', NULL, NULL, 7, 1, '2012-12-19 00:11:06', '2012-12-30 02:37:40', '0000-00-00 00:00:00', 1, 0, 'en'),
				(8, 'Minimum wage rates', '&lt;p&gt;\n Minimum wage rates&lt;/p&gt;\n', NULL, NULL, 7, 1, '2012-12-19 00:12:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
				(9, 'Public holidays dates 2012', '&lt;p&gt;\n Public holidays dates 2012&lt;/p&gt;\n', NULL, NULL, 7, 1, '2012-12-19 00:13:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
				(10, 'Minimum employment rights', '&lt;p&gt;\n Minimum employment rights&lt;/p&gt;\n', NULL, NULL, 7, 1, '2012-12-19 00:14:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
				(14, 'WSH Regulatory Framework ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', NULL, NULL, 5, 1, '2012-12-19 18:58:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
				(15, 'Safety & Health Management System ', '&lt;p&gt;\n Nunc aliquet tortor in lectus porttitor fringilla&lt;br /&gt;\n lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta&lt;br /&gt;\n arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.&lt;br /&gt;\n Pellentesque varius ', NULL, NULL, 5, 1, '2012-12-19 19:00:44', '2012-12-19 19:04:50', '0000-00-00 00:00:00', 1, 0, 'en'),
				(16, 'Monitoring and Surveillance ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', NULL, NULL, 5, 1, '2012-12-19 19:01:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
				(17, 'Work Injury Compensation', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', NULL, NULL, 5, 1, '2012-12-19 19:02:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'en'),
				(18, 'Certification & Registration', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', NULL, NULL, 5, 1, '2012-12-19 19:03:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
				(19, 'Incident Reporting ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', NULL, NULL, 5, 1, '2012-12-19 19:04:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'en'),
				(21, ' Amendments to the Employment of Foreign Manpower Act', '&lt;p&gt;\r\n The Employment of Foreign Manpower Act (EFMA) prescribes the responsibilities and obligations pertaining to the employment of foreign workers. The EFMA was last amended in 2007.Since 2010, following the recommendations of the Economic Strategi', NULL, NULL, 8, 1, '2012-12-22 02:39:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
				(23, '.askldfjpwei;we g', '&lt;p&gt;\n ;oiasdf kjasd ;fowaf af aw&lt;/p&gt;\n', NULL, NULL, 5, 1, '2012-12-26 08:10:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
				(24, ' Ministry of Labour and Employments', '&lt;p&gt;\n Establishment Ministry of Labour &amp;amp; Social Welfare, 2038 BS, Ministry of Labour, 2052 BS, Ministry of Labour &amp;amp; Transport Management, 2057 BS, Ministry of Labour &amp;amp; Employment, 2069. Objectives and Long Term vision of Minis', 'छवबब', '<p>\n सग सउग ासगारग ासग ागासगा</p>\n', 6, 1, '2012-12-27 10:57:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 'en'),
				(25, 'uyi', '&lt;p&gt;\n ;h iuhpiu hpiu hoiu hoi ugoi oi&lt;/p&gt;\n', NULL, NULL, 1, 1, '2012-12-28 12:47:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
				(26, 'nnnn', '&lt;p&gt;\n ndaoijad iof jweopf japsodif jaoeijf aposija w&lt;/p&gt;\n', NULL, NULL, 8, 1, '2012-12-30 02:37:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en');";

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

		$sql = 	"INSERT INTO `album` (`id`, `title`, `description`, `created_by`, `date_created`, `date_published`, `active`) VALUES
				(1, 'Album 1', 'More about album 1', 1, '2012-12-20 19:05:58', NULL, 1),
				(2, 'Album 2', 'More about album 2', 1, '2012-12-20 19:06:16', NULL, 1),
				(3, 'Album 3', 'More about album 3', 1, '2012-12-20 19:06:29', NULL, 1);";
		$this->db->query($sql);

		$sql = 	"INSERT INTO `links` (`id`, `link`, `table`, `row_id`) VALUES
				(1, 'pages/xx', 'news', '24'),
				(4, 'contacts/x4', 'contacts', '0'),
				(5, 'news/gtd', 'news', '25'),
				(6, 'acts/nn', 'news', '26'),
				(7, 'employments/emp', 'news', '7'),
				(8, 'acts/acts/eve', 'news', '3'),
				(9, 'acts/h1', 'news', '14');";
		$this->db->query($sql);


		$sql = 	"INSERT INTO `faqs` (`id`, `faqs_type_id`, `question`, `answer`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`) VALUES
				(1, 1, 'Lorem ipsum dolor sit amet?', '&lt;pre&gt;\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan\narcu et orci ultricies condimentum sed sed enim. Phasellus sed augue\nnisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla\nlobortis erat tristique. Morbi pulvinar augue in metus euismod id porta\narcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.\nPellentesque varius massa id elit posuere placerat. Integer tempor\ncursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu\npurus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum\ninterdum in, cursus a nunc. Quisque varius libero id ligula congue\neuismod. In consequat ultrices diam, eu gravida tortor suscipit et.&lt;/pre&gt;\n', 1, '2013-01-01 16:50:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
				(2, 2, 'Ut pellentesque dolor?', '&lt;pre&gt;\nUt pellentesque dolor ut sem ornare non malesuada nisl pellentesque.\nNulla convallis scelerisque dignissim. Quisque vitae venenatis eros.\nQuisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in\nfelis imperdiet dignissim. Integer lobortis, diam vel ultrices\nfringilla, ipsum magna fermentum felis, in semper lacus neque sit amet\neros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget\nlibero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar\nsapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices\nposuere cubilia Curae; Pellentesque habitant morbi tristique senectus et\nnetus et malesuada fames ac turpis egestas. Nullam eget est eros.&lt;/pre&gt;\n', 1, '2013-01-01 16:52:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
				(3, 2, 'In nec faucibus ipsum?', '&lt;pre&gt;\nIn nec faucibus ipsum. Integer vehicula congue sapien non tincidunt.\nPhasellus eget massa ligula, vitae consectetur risus. Cras sed nisi\nlorem. Aliquam erat volutpat. In vulputate sapien eget arcu sagittis\nlacinia. Curabitur et tortor nisi, a aliquet justo. Donec id purus at\ntellus eleifend tempor.\n\nFusce mauris leo, dignissim id ornare sed, gravida in augue. Curabitur\nid quam massa, sit amet fermentum nulla. In a ipsum a elit eleifend\nlobortis at sit amet risus. Quisque eros ligula, imperdiet vitae\ndignissim a, rhoncus in est. Etiam ullamcorper metus eget quam ornare\ntristique vitae non sapien. In accumsan adipiscing lorem, eget faucibus\nleo tempor vel. Ut id mi eget turpis porta pharetra. Mauris elementum,\nquam consectetur hendrerit ultricies, purus velit congue quam, vulputate\nsemper nibh mi quis mi. Etiam condimentum lobortis accumsan. Vestibulum\nfelis erat, mattis vel viverra eget, laoreet quis est. Suspendisse\ncongue pretium semper. Integer viverra tristique velit, in tincidunt\nsapien ultrices id. Morbi fringilla pellentesque leo sit amet congue.\nQuisque eget mi sed sem euismod bibendum id porttitor lorem.&lt;/pre&gt;\n', 1, '2013-01-01 16:53:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
				(4, 2, 'Praesent ac varius dui?', '&lt;pre&gt;\nPraesent ac varius dui. Maecenas in leo libero. Integer malesuada, neque\nnon interdum malesuada, dolor velit viverra nunc, nec suscipit sapien\nmetus vitae libero. Vestibulum eu quam nulla, ut facilisis tellus. Cras\nneque magna, pellentesque non sagittis sed, adipiscing convallis turpis.\nVivamus rhoncus ipsum nec purus convallis consectetur. In pretium\nultrices nisi, ut tincidunt odio porta sit amet. Curabitur vulputate\nquam at ipsum semper ut mollis ante dapibus. Suspendisse a sapien\nturpis, ac convallis mauris.&lt;/pre&gt;\n', 1, '2013-01-01 16:54:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
				(5, 1, 'In accumsan adipiscing lorem, eget?', '&lt;pre&gt;\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan\narcu et orci ultricies condimentum sed sed enim. Phasellus sed augue\nnisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla\nlobortis erat tristique. Morbi pulvinar augue in metus euismod id porta\narcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.\nPellentesque varius massa id elit posuere placerat. Integer tempor\ncursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu\npurus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum\ninterdum in, cursus a nunc. Quisque varius libero id ligula congue\neuismod. In consequat ultrices diam, eu gravida tortor suscipit et.\n\nUt pellentesque dolor ut sem ornare non malesuada nisl pellentesque.\nNulla convallis scelerisque dignissim. Quisque vitae venenatis eros.\nQuisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in\nfelis imperdiet dignissim. Integer lobortis, diam vel ultrices\nfringilla, ipsum magna fermentum felis, in semper lacus neque sit amet\neros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget\nlibero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar\nsapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices\nposuere cubilia Curae; Pellentesque habitant morbi tristique senectus et\nnetus et malesuada fames ac turpis egestas. Nullam eget est eros.\n\nIn nec faucibus ipsum. Integer vehicula congue sapien non tincidunt.\nPhasellus eget massa ligula, vitae consectetur risus. Cras sed nisi\nlorem. Aliquam erat volutpat. In vulputate sapien eget arcu sagittis\nlacinia. Curabitur et tortor nisi, a aliquet justo. Donec id purus at\ntellus eleifend tempor.\n\nFusce mauris leo, dignissim id ornare sed, gravida in augue. Curabitur\nid quam massa, sit amet fermentum nulla. In a ipsum a elit eleifend\nlobortis at sit amet risus. Quisque eros ligula, imperdiet vitae\ndignissim a, rhoncus in est. Etiam ullamcorper metus eget quam ornare\ntristique vitae non sapien. In accumsan adipiscing lorem, eget faucibus\nleo tempor vel. Ut id mi eget turpis porta pharetra. Mauris elementum,\nquam consectetur hendrerit ultricies, purus velit congue quam, vulputate\nsemper nibh mi quis mi. Etiam condimentum lobortis accumsan. Vestibulum\nfelis erat, mattis vel viverra eget, laoreet quis est. Suspendisse\ncongue pretium semper. Integer viverra tristique velit, in tincidunt\nsapien ultrices id. Morbi fringilla pellentesque leo sit amet congue.\nQuisque eget mi sed sem euismod bibendum id porttitor lorem.&lt;/pre&gt;\n', 1, '2013-01-01 16:54:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);";
		$this->db->query($sql);



		$sql = 	"INSERT INTO `faqs_type` (`id`, `title`, `description`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`) VALUES
				(1, 'General', 'General questions   ', 1, '2013-01-01 16:46:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
				(2, 'Situations', 'About Labour unions', 1, '2013-01-01 16:47:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
				(3, ' Working Abroad', 'Foreign Employment ', 1, '2013-01-01 16:48:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
				(4, ' Labour Acts', 'Questions about Acts related to labour and Employment  ', 1, '2013-01-01 16:49:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
				(5, ' Safety and Health', 'Smoke free law and employers responsibility ', 1, '2013-01-01 16:49:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);";
		$this->db->query($sql);


		echo 'sample data entered.';
		$this->_comments();
	}
	
	private function _comments(){
		echo '<br/>goto <a href="'.base_url().'">homepage</a>';
		echo '<br/>or <a href="'.site_url('admin/login').'">admin page</a>';		
		echo '<br/>you can safely delete <code>./applications/controllers/update_db.php</code>';
		echo '<br/>if everything is fine.';
	}
}

/* End of file update_db.php */
/* Location: ./application/controller/update_db.php */
