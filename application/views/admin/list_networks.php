<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<a href='<?php echo site_url('admin/networks/create')?>'>Create nu networks</a>

<br/>
<?php echo @$items['links']?>

<table border=1>
<thead>
	<tr>
		<th>title</th>
		<th>link</th>
		<th>description</th>
		<th>date created</th>
		<th>created by</th>
		<th>active</th>
		<th>edit</th>
		<th>delete</th>
	</tr>
</thead>
<tbody>
	<?php foreach($items['data'] as $item): ?>
		<tr>
			<td><?php echo $item->title_link?></td>
			<td><?php echo $item->link?></td>
			<td><?php echo $item->description?></td>
			<td><?php echo $item->date_created?></td>
			<td><?php echo $item->created_by?></td>
			<td><?php echo $item->active?></td>
			<td><?php echo $item->edit?></td>
			<td><?php echo $item->del?></td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>
