<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<a href='<?php echo site_url('admin/news/create')?>'>Create nu news</a>
<table border=1>
<thead>
	<tr>
		<th>id</th>
		<th>title</th>
		<th>date created</th>
		<th>created by</th>
		<th>active</th>
		<th>edit</th>
		<th>delete</th>
	</tr>
</thead>
<tbody>
	<?php foreach($items as $item): ?>
		<tr>
			<td><?php echo $item->id?></td>
			<td><a href='<?php echo site_url('admin/news/view/'.$item->id)?>'>
					<?php echo $item->title?>
				</a></td>
			<td><?php echo $item->date_created?></td>
			<td><?php echo $item->created_by?></td>
			<td><?php echo $item->active?></td>
			<td><a href='<?php echo site_url('admin/news/edit/'.$item->id)?>'>
					edit
				</a></td>
			<td>
				<form method='post' action='<?php echo site_url('admin/news/del/')?>'>
					<input type='hidden' name='news_id' value='<?php echo $item->id?>'/>
					<input type='submit' name='del' value='Delete'/>
				</form>
			</td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>