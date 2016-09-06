<div id="main" class="container">
	<button id="newp" class="btn btn-lg btn-default" style="margin-left: 10px; margin-bottom: 20px">New Project</button>
	<div class="col-md-13"> 
	<table class="table table-striped">
		<tr>
			<th>ID</th>
			<th>项目名称</th>
			<th>点赞数</th>
			<th>评论数</th>
			<th>关注数</th>
			<th>创建时间</th>
		</tr>
	<?php foreach($pro as $key => $value) : ?>
		<tr>
			<td><?=$key;?></td>
			<td><a id="project" href="/WebUser/detail?name=<?=$value['project_name'];?>"><?=$value['project_name'];?></a></td>
			<td><?=$value['praise'];?></td>
			<td><?=$value['com_count'];?></td>
			<td><?=$value['foc_count'];?></td>
			<td><?=$value['build_time'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
</div>
<script>
	$('#newp').click(function(){
		location.href = "/WebUser/Project";
	});
</script>
	
	
