<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php //print_r($items);?>

<a href='<?php echo site_url('admin/notices/create')?>'>Create nu notice</a>
<table border=1>
<thead>
	<tr>
		<th>id</th>
		<th>title</th>
		<th>date created</th>
		<th>created by</th>
		<th>date published</th>
		<th>edit</th>
		<th>delete</th>
	</tr>
</thead>
<tbody>
	<?php foreach($items as $item): ?>
		<tr>
			<td><?php echo $item->id?></td>
			<td><a href='<?php echo site_url('admin/notices/view/'.$item->id)?>'>
					<?php echo $item->title?>
				</a></td>
			<td><?php echo $item->date_created?></td>
			<td><?php echo $item->created_by?></td>
			<td><?php echo $item->date_published?></td>
			<td><a href='<?php echo site_url('admin/notices/edit/'.$item->id)?>'>
					edit
				</a></td>
			<td>
				<form method='post' action='<?php echo site_url('admin/notices/del/')?>'>
					<input type='hidden' name='notices_id' value='<?php echo $item->id?>'/>
					<input type='submit' name='del' value='Delete'/>
				</form>
			</td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>