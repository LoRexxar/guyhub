<div id="main">
	<button id="newp">New Project</button>
	<table>
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
			<td><a id="project"><?=$value['project_name'];?></a></td>
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
	$('#project').click(function(){
		location.href = "/WebUser/detail?name=" + this.innerHTML;
	});
</script>
	
	