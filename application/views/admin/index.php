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
<br/>



<a href='<?php echo site_url('admin/events')?>'>Events</a>
<br/>

<a href='<?php echo site_url('admin/files')?>'>Files</a>
<br/>

<a href='<?php echo site_url('admin/health')?>'>Health</a>
<br/>

<a href='<?php echo site_url('admin/menu')?>'>Menu</a>
<br/>

<a href='<?php echo site_url('admin/news')?>'>News</a>
<br/>

<a href='<?php echo site_url('admin/notices')?>'>Notices</a>
<br/>

<a href='<?php echo site_url('admin/pages')?>'>Pages</a>
<br/>

<a href='<?php echo site_url('admin/poll')?>'>Polls</a>
<br/>

<a href='<?php echo site_url('admin/press')?>'>Press</a>
<br/>

<a href='<?php echo site_url('admin/slider')?>'>Homepage Image Slider</a>
<br/>

<a href='<?php echo site_url('admin/gallery')?>'>Albums</a>
<br/>

<a href='<?php echo site_url('admin/gallery/list_imgs')?>'>images</a>
<br/>


<a href='<?php echo site_url('admin/contacts')?>'>Contactus</a>
<br/>

<a href='<?php echo site_url('admin/usefullinks')?>'>Usefullinks</a>
<br/>

<a href='<?php echo site_url('admin/networks')?>'>Networks</a>
<br/>

<a href='<?php echo site_url('admin/employments')?>'>Employments</a>
<br/>

<a href='<?php echo site_url('admin/vip')?>'>VIP</a>
<br/>
