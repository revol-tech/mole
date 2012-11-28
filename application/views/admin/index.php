<form id="logout_form" method="post" action='<?php echo site_url('admin/main')?>'>
	<input type="submit" name='logout' value="Logout">
</form>

<h1>Admin Panel</h1>
<br/>

<a href='<?php echo site_url('admin/main')?>'>Admin homepage</a>
<br/>

<a href='<?php echo site_url('admin/news/create')?>'>Add new News</a>
<br/>

<a href='<?php echo site_url('admin/poll')?>'>Polls</a>
<br/>