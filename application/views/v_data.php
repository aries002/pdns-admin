<!DOCTYPE html>
<html>
<head>
	<title>Membuat Pagination Pada CodeIgniter | MalasNgoding.com</title>
</head>
<body>
<h1>Membuat Pagination Pada CodeIgniter | MalasNgoding.com</h1>
	<table border="1">
		<tr>
			<th>no</th>
			<th>name</th>
			<th>type</th>
			<th>value</th>		
		</tr>
		<?php 
		$no = $this->uri->segment('4') + 1;
		foreach($user as $u){ 
		?>
		<tr>
			<td><?php echo $u->id; ?></td>
			<td><?php echo $u->name ?></td>
			<td><?php echo $u->type ?></td>
			<td><?php echo $u->content ?></td>
		</tr>
	<?php } ?>
	</table>
	<br/>
	<?php 
	echo $this->pagination->create_links();
	?>
</body>
</html>
