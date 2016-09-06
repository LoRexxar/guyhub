<div class="form form-group  jumbotron question">
<div id="b" class="col-md-13  modal-body">
<div class="form-group">
	<h3>Search result:</h3>
	</div>
<table class="table table-striped">
	<?php foreach( $res as $value ):?>
	<tr>
		<td>ID:</td>
		<td> <?=$value['id'];?> </td>
	</tr>
	<tr>
		<td>project name:</td>
		<td><?=$value['project_name'];?></td>
	</tr>
	<tr>
		<td>creater id:</td>
		<td><?=$value['creater_id']?></td>
	</tr>
	<tr>
		<td>code address:</td>
		<td><?=$value['code_addr'];?></td>
	</tr>
	<tr>
		<td>praise:</td>
		<td><?=$value['praise'];?></td>
	</tr>
	<tr>
		<td>public:</td>
		<td><?=$value['public'];?></td>
	</tr>
	<tr>
		<td>build time</td>
		<td><?=$value['build_time'];?></td>
	</tr>
	<tr>
		<td>project com</td>
		<td><?=$value['project_com'];?></td>
	</tr>
	<?php echo "<hr />"; endforeach;?>
</table>
<button id="back"  class="btn btn-lg btn-default">back</button>
</div>
</div>
<script>
$('#back').click(function(){
	window.location.href='/admin_qwe.php/Web_admin/manage';
});
</script>
