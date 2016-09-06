	<div id="main" class="container-fluid box panel panel-primary" >
		<div id="user" class="span12 panel-heading" >
			<div class="col-md-2"><img class="img-rounded" src="<?=$ques['head_img'];?>" alt="touxiang" ></div>
			<div class="col-md-4"><p>昵称：<?=$ques['username'];?></p></div>
			<div class="col-md-6"><p>email：<?=$ques['email'];?></p></div>
		</div>
		<div id="ques"  class="span12 panel-body">
			<h3><?=$ques['title'];?></h3>
			<p><?=$ques['content'];?></p>
			<p class="text-right">提问时间：<?=$ques['ask_time'];?></p>
		</div>
	</div>
	<?php foreach ($anw as $value): ?>
		<div class="child container-fluid panel panel-primary" id="box" >
			<div class="user span12 panel-heading">
				<div class="col-md-2"><img class="img-rounded" src="<?=$value['head_img'];?>" alt="touxiang"></div>
				<div class="col-md-4"><p>昵称：<?=$value['username'];?></p></div>
				<div class="col-md-6"><p>email：<?=$value['email'];?></p></div>
			</div>
			<div class="anw span12 panel-body">
				<p><?=$value['content'];?></p>
				<p class="text-right">回答时间：<?=$value['anw_time'];?></p>
			</div>
		</div>
	<?php endforeach?>
	<div id="answer" class="form jumbotron question">
		<p style="font-size: 25px">我来回答：</p>
		<?php if ($is_login):?>
			<div class="form-group">
			<label for="username">昵称：</label> <input id="username" type="text" placeholder="请输入昵称" value="<?=$user_info['username']?>" disabled/>
			</div>
			<div class="form-group">
			<label for="email">Email：</label> <input id="email" type="text" placeholder="请输入邮箱" value="<?=$user_info['email']?>" disabled/>
			</div>
		<?php else: ?>
			<div class="form-group">
			<label for="username">昵称：</label> <input id="username" type="text" placeholder="请输入昵称" />
			</div>
			<div class="form-group">
			<label for="email">Email：</label> <input id="email" type="text" placeholder="请输入邮箱" />
			</div>
		<?php endif;?>
		<div class="form-group">
		<label for="content">回复：</label>
		<textarea id="content" class="form-control"></textarea>
		</div>
		<div class="form-group">
		<label for="code">验证码：</label> <input type="text" id="code" placeholder="请输入验证码" />
		<a id="cap" title="换一张"><?=$cap['image'];?></a>
		</div>
		<button id="sub" class="btn btn-lg btn-default">提交</button>
		<div role="alert" class="alert alert-warning"  id="error" style="display:none; margin-top:10px;">
        		<strong>Warning!</strong> 提交失败.
      		</div>
	</div>
<script>
	$('#cap').click(function(){
		load_captcha('cap','/WebCapt');
	});
	function load_captcha(id,url){
		var ran = Math.random();
		$("#"+id).load(url+"?r="+ran); 
	}
	$('#sub').click(function(){
		var data = {};
		data['content'] = $('#content').val();
		data['username'] = $('#username').val();
		data['email'] = $('#email').val();
		data['code'] = $('#code').val();
		data['tit_id'] = "<?=$ques['id'];?>";
		//  在一群大黑客面前，前台我就懒得验证了～～～
		$.ajax({
			url: '/WebDiscuss/anwsub',
			type: 'post',
			data: data,
			dataType: 'json',
			success: function(data){
				if (data.status) {
					var s = '<div role="alert" class="alert alert-danger" margin-top:10px;><strong>Oh snap!</strong> '+data.msg+'</div>';
					document.getElementById("answer").innerHTML += s;
					load_captcha('cap','/WebCapt');
				}
				else{
					var s = '<div role="alert" class="alert alert-success" style="margin-top:10px;"><strong>Well done!</strong></div>';
					document.getElementById("answer").innerHTML += s;
					location.href="detail?id=<?=$ques['id'];?>";
				}
			},
			error: function(){
				$('#error').show();
			}
		});
	});
</script>
