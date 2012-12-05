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
			<td><?php echo $item->title_link?></td>
			<td><?php echo $item->date_created?></td>
			<td><?php echo $item->created_by?></td>
			<td><?php echo $item->date_published?></td>
			<td><?php echo $item->edit?></td>
			<td><?php echo $item->del?></td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>