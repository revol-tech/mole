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
			<td><a href='<?php echo site_url('admin/poll/view/'.$item->id)?>'>
					<?php echo $item->question?>
				</a></td>
			<td><?php echo $item->date_created?></td>
			<td><?php echo $item->created_by?></td>
			<td><?php echo $item->option1?></td>
			<td><?php echo $item->option2?></td>
			<td><?php echo $item->option3?></td>
			<td><?php echo $item->option4?></td>
			<td><?php echo $item->graph?></td>
			<td><?php echo $item->active?></td>
			<td><a href='<?php echo site_url('admin/poll/edit/'.$item->id)?>'>
					edit
				</a></td>
			<td>
				<form method='post' action='<?php echo site_url('admin/poll/del/')?>'>
					<input type='hidden' name='poll_id' value='<?php echo $item->id?>'/>
					<input type='submit' name='del' value='Delete'/>
				</form>
			</td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>