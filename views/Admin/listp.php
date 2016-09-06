<div class="form form-group  jumbotron question">
<div id="b" class="col-md-13  modal-body">
<div class="form-group">
	<h3>ALL project:</h3>
	</div>

	<?php foreach( $res as $value ):?>
	<table class="table table-striped userr" >
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
	</table>
	<?php endforeach;?>
<button id="back"  class="btn btn-lg btn-default" style="margin-left:10px">back</button>
</div>
</div>
<script>
$('#back').click(function(){
	window.location.href='/admin_qwe.php/Web_admin/manage';
});
</script>
