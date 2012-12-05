<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<a href='<?php echo site_url('admin/poll/create')?>'>Create nu poll</a>
<table border=1>
<thead>
	<tr>
		<th>id</th>
		<th>question</th>
		<th>date created</th>
		<th>created by</th>
		<th>option 1</th>
		<th>option 2</th>
		<th>option 3</th>
		<th>option 4</th>
		<th>results</th>
		<th>active</th>
		<th>edit</th>
		<th>delete</th>
	</tr>
</thead>
<tbody>
	<?php foreach($items as $item): ?>
		<tr>
			<td><?php echo $item->id?></td>
			<td><?php echo $item->question_link?></td>
			<td><?php echo $item->date_created?></td>
			<td><?php echo $item->created_by?></td>
			<td><?php echo $item->option1?></td>
			<td><?php echo $item->option2?></td>
			<td><?php echo $item->option3?></td>
			<td><?php echo $item->option4?></td>
			<td><?php echo $item->graph?></td>
			<td><?php echo $item->active?></td>
			<td><?php echo $item->edit?></td>
			<td><?php echo $item->del?></td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>