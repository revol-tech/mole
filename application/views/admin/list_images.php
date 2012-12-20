<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php //print_r($data);?>

<a href='<?php echo site_url('admin/gallery/upload_imgs')?>'>upload nu imgs</a>

<br/>
<?php //echo @$items['links']?>

<table border=1>
<thead>
	<tr>
		<th>id</th>
		<th>image</th>
		<th>title</th>
		<th>description</th>
		<th>album</th>
		<th>date created</th>
		<th>created by</th>
		<!--<th>date published</th>-->
		<!--<th>download</th>-->
		<th>delete</th>
	</tr>
</thead>
<tbody>
	<?php foreach($data as $item): ?>
		<tr>
			<td><?php echo $item->id?></td>
			<td><?php echo $item->filename?></td>
			<td><?php echo $item->title_link?></td>
			<td><?php echo $item->description?></td>
			<td><?php echo $item->album?></td>
			<td><?php echo $item->date_created?></td>
			<td><?php echo $item->created_by?></td>
			<!--<td><?php //echo $item->date_published?></td>-->
			<!--<td><?php //echo $item->download?></td>-->
			<td><?php echo $item->del?></td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>
