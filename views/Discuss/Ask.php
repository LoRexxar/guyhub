	<form class="form-horizontal question  jumbotron" id="form">
		<div class="form-group" style="margin-left:30px;margin-right:30px;">
		<h2>提问:</h2>
		</div>
		<div class="form-group" style="margin-left:30px;margin-right:30px;">
			<label for="title">标题：</label>
			<input id="title" type="text" class="form-control"/>
		</div>
		<div class="form-group" style="margin-left:30px;margin-right:30px;">
		<label for="user">昵称：</label>
		<?php if ($is_login): ?>
			<input id="user" type="text" class="form-control" value="<?=$user_info['username']?>" disabled />
			</div>
			<div class="form-group" style="margin-left:30px;margin-right:30px;">
			<label for="mail">邮箱：</label>
			<input id="mail" type="text" class="form-control" value="<?=$user_info['email']?>" disabled />
			</div>
		<?php else: ?>
			<input type="text" class="form-control" id="user" />
			</form>
			<div class="form-group">v
			<label for="mail">邮箱：</label>
			<input type="text" class="form-control" id="mail" />
			</div>
		<?php endif;?>
		<div class="form-group" style="margin-left:30px;margin-right:30px;">
		<label for="content">问题详情：</label>
		<textarea id="content" class="form-control" rows="5"></textarea>
		</div>
		<div class="form-group" style="margin-left:30px;margin-right:30px;">
		<label for="code">验证码：</label>
		<input type="text" id="code" />
		<a id="cap" title="换一张"><?=$cap['image'];?></a>
		</div>
		<button id="sub" class="btn btn-lg btn-default" style="margin-left:30px">提交</button>
		<div role="alert" class="alert alert-warning"  id="error" style="display:none; margin-top:10px;">
        		<strong>Warning!</strong> 提交失败.
      		</div>
	</form>
<script>
	$('#cap').click(function(){
		load_captcha('cap','/WebCapt');
	});
	function load_captcha(id,url){
		var ran = Math.random();
		$("#"+id).load(url+"?r="+ran); 
	}
	$('#sub').click(function(event){
		event.preventDefault();
		var data = {};
		data['title'] = $('#title').val();
		data['content'] = $('#content').val();
		data['username'] = $('#user').val();
		data['email'] = $('#mail').val();
		data['code'] = $('#code').val();
		//  在一群大黑客面前，前台我就懒得验证了～～～
		$.ajax({
			url: '/WebDiscuss/asksub',
			type: 'post',
			data: data,
			dataType: 'json',
			success: function(data){
				if (data.status) {
					var s = '<div role="alert" class="alert alert-danger" margin-top:10px;><strong>Oh snap!</strong> '+data.msg+'</div>';
					document.getElementById("form").innerHTML += s;
					load_captcha('cap','/WebCapt');
				}
				else{
					var s = '<div role="alert" class="alert alert-success" style="margin-top:10px;"><strong>Well done!</strong></div>';
					document.getElementById("form").innerHTML += s;
					location.href="discuss";
				}
			},
			error: function(){
				$('#error').show();
			}
		});
	});

</script>
