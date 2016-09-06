<div class="form form-group  jumbotron question">
<div id="b" class="col-md-13  modal-body">
<div class="form-group">
	<h3>ALL adviser:</h3>
	</div>
	<?php foreach( $res as $value ):?>
	<table class="table table-striped userr" >
	<tr>
		<td>id:</td>
		<td> <?=$value['id'];?> </td>
	</tr>
	<tr>
		<td>username:</td>
		<td><?=$value['username']?></td>
	</tr>
	<tr>
		<td>email:</td>
		<td><?=$value['email'];?></td>
	</tr>
	<tr>
		<td>title:</td>
		<td><?=$value['title']?></td>
	</tr>
	<tr>
		<td>advise:</td>
		<td><?=$value['content'];?></td>
	</tr>
	<tr>
		<td>advise time</td>
		<td><?=$value['advise_time'];?></td>
	</tr>
	<hr>
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
