<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php //print_r($items);?>

<a href='<?php echo site_url('admin/health/create')?>'>Create nu health</a>
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
			<td><a href='<?php echo site_url('admin/health/view/'.$item->id)?>'>
					<?php echo $item->title?>
				</a></td>
			<td><?php echo $item->date_created?></td>
			<td><?php echo $item->created_by?></td>
			<td><?php echo $item->date_published?></td>
			<td><a href='<?php echo site_url('admin/health/edit/'.$item->id)?>'>
					edit
				</a></td>
			<td>
				<form method='post' action='<?php echo site_url('admin/health/del/')?>'>
					<input type='hidden' name='health_id' value='<?php echo $item->id?>'/>
					<input type='submit' name='del' value='Delete'/>
				</form>
			</td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>