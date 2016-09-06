	<div id="tables" class="container">
	<p><button id="ask" class="btn btn-lg btn-default">提问</button></p>
	<div class="col-md-12"> 
	<table class="table table-striped">
		<tr>
			<th>id</th>
			<th>问题描述</th>
			<th>提问者</th>
			<th>提问时间</th>
		</tr>
		<?php foreach ($db as $key => $value): ?>
		<tr>
			<th><?=$key?></th>
			<th><a href="<?=$value['url'];?>"><?=$value['title'];?></a></th>
			<th><?=$value['username'];?></th>
			<th><?=$value['ask_time'];?></th>
		</tr>
		<?php endforeach;?>
	</table>
	</div>
	</div>
<script>
	$('#ask').click(function(){
		location.href = 'ask';
	});
</script>