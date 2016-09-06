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
		<td>username:</td>
		<td> <?=$value['username'];?> </td>
	</tr>
	<tr>
		<td>email:</td>
		<td><?=$value['email'];?></td>
	</tr>
	<tr>
		<td>power:</td>
		<td><?=$value['power']?></td>
	</tr>
	<tr>
		<td>head_img:</td>
		<td><?=$value['head_img'];?></td>
	</tr>
	<tr>
		<td>question:</td>
		<td><?=$value['question'];?></td>
	</tr>
	<tr>
		<td>answer:</td>
		<td><?=$value['answer'];?></td>
	</tr>
	<tr>
		<td>last_time</td>
		<td><?=$value['last_time'];?></td>
	</tr>
	<tr>
		<td>last_ip</td>
		<td><?=$value['last_ip'];?></td>
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
