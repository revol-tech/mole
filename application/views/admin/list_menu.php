<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php //print_r($items);?>

<a href='<?php echo site_url('admin/menu/create')?>'>Create nu menu</a>
<table border=1>
<thead>
	<tr>
		<th>id</th>
		<th>title</th>
		<th>link</th>
		<th>parent id</th>
		<th>active</th>
		<th>comments</th>
		<th>edit</th>
		<th>delete</th>
	</tr>
</thead>
<tbody>
	<?php foreach($items as $item): ?>
		<tr>
			<td><?php echo $item->id?></td>
			<td><a href='<?php echo site_url('admin/menu/view/'.$item->id)?>'>
					<?php echo $item->title?>
				</a></td>
			<td><?php echo $item->link?></td>
			<td><?php echo $item->parent_id?></td>
			<td><?php echo $item->active?></td>
			<td><?php echo $item->comments?></td>
			<td><a href='<?php echo site_url('admin/menu/edit/'.$item->id)?>'>
					edit
				</a></td>
			<td>
				<form method='post' action='<?php echo site_url('admin/menu/del/')?>'>
					<input type='hidden' name='menu_id' value='<?php echo $item->id?>'/>
					<input type='submit' name='del' value='Delete'/>
				</form>
			</td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>