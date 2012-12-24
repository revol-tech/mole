<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<a href='<?php echo site_url('admin/faqs/create')?>'>Create nu faqs</a>

<br/>
<?php echo @$items['links']?>

<table border=1>
<thead>
	<tr>
		<th>id</th>
		<th>question</th>
		<th>type</th>
		<th>date created</th>
		<th>created by</th>
		<!--<th>active</th>-->
		<th>edit</th>
		<th>delete</th>
	</tr>
</thead>
<tbody>
	<?php foreach($items['data'] as $item): ?>
		<tr>
			<td><?php echo $item->id?></td>
			<td><?php echo $item->question_link?></td>
			<td><?php echo $item->faqs_type?></td>
			<td><?php echo $item->date_created?></td>
			<td><?php echo $item->created_by?></td>
			<!--<td><?php echo $item->active?></td>-->
			<td><?php echo $item->edit?></td>
			<td><?php echo $item->del?></td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>
