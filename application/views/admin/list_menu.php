<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php //print_r($items);?>

<a href='<?php echo site_url('admin/menu/create')?>'>Create nu menu</a>

<br/>
<?php echo @$items['links']?>

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
	<?php foreach($items['data'] as $item): ?>
		<tr>
			<td><?php echo $item->id?></td>
			<td><?php echo $item->title_link?></td>
			<td><?php echo $item->link?></td>
			<td><?php echo $item->parent_id?></td>
			<td><?php echo $item->active?></td>
			<td><?php echo $item->comments?></td>
			<td><?php echo $item->edit?></td>
			<td><?php echo $item->del?></td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>