<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
//$this->template->set_template('admin');
//$this->template->render();
?>
<?php echo form_open(site_url('admin/main'),array('id'=>'logout_form'))?>
	<input type="submit" name='logout' value="Logout">
</form>

<h1>Admin Panel</h1>
<br/>

<a href='<?php echo site_url('admin/main')?>'>Admin homepage</a>
<br/><br/>


<table border='1' style='width:700px;'>
	<tr>
		<td><!--<a href='<?php echo site_url('admin/acts')?>'>Acts and Laws</a>--></td>
		<td><a href='<?php echo site_url('admin/gallery')?>'>Albums</a></td>
		<td><a href='<?php echo site_url('admin/contacts')?>'>Contactus</a></td>
		<td><a href='<?php echo site_url('admin/divisions')?>'>Divisions</a></td>
		<td><a href='<?php echo site_url('admin/employments')?>'>Employments</a></td>
	</tr>
	<tr>
		<td><a href='<?php echo site_url('admin/events')?>'>Events</a></td>
		<td><a href='<?php echo site_url('admin/faqs')?>'>FAQs</a></td>
		<td><a href='<?php echo site_url('admin/faqs/faqs_type')?>'>FAQ Types</a></td>
		<td><a href='<?php echo site_url('admin/files')?>'>Files</a></td>
		<td><a href='<?php echo site_url('admin/health')?>'>Health</a></td>
	</tr>
	<tr>
		<td><a href='<?php echo site_url('admin/gallery/list_imgs')?>'>Images</a></td>
		<td><a href='<?php echo site_url('admin/menu')?>'>Menu</a></td>
		<td><a href='<?php echo site_url('admin/networks')?>'>Networks</a></td>
		<td><a href='<?php echo site_url('admin/news')?>'>News</a></td>	
		<td><a href='<?php echo site_url('admin/notices')?>'>Notices</a></td>
	</tr>
	<tr>
		<td><a href='<?php echo site_url('admin/organizations')?>'>Organizations</a></td>
		<td><a href='<?php echo site_url('admin/pages')?>'>Pages</a></td>
		<td><a href='<?php echo site_url('admin/poll')?>'>Polls</a></td>
		<td><a href='<?php echo site_url('admin/press')?>'>Press</a></td>
		<td><a href='<?php echo site_url('admin/slider')?>'>Slider</a></td>
	</tr>
	<tr>
		<td><a href='<?php echo site_url('admin/submenu')?>'>Submenu</a></td>
		<td><a href='<?php echo site_url('admin/usefullinks')?>'>Usefullinks</a></td>
		<td><a href='<?php echo site_url('admin/vip')?>'>VIP</a></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
