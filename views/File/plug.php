<?php if (isset($fname)): ?>
<tr>
			<th>
				名称
			</th>
			<th>
				修改时间
			</th>
			<th>
				大小
			</th>
			<th>
				操作
			</th>
		</tr>
<?php foreach ($fname as $key => $value): ?>
<tr>
	<td><a class="fname"><?=$value;?></a></td>
	<td><?=$atime[$key];?></td>
	<td><?=$size[$key];?></td>
	<td><a class="modi" onclick="alert('对不起！此功能尚未开通')">修改</a><span>|</span><a onclick="alert('对不起！此功能尚未开通')">删除</a><!-- <a class="" href="/WebUser/del_file?name=<?=$value;?>&id=<?=$id;?>">删除</a> --></td>
</tr>
<?php endforeach;?>
<?php endif;?>