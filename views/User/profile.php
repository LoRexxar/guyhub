<div id="main" class="form jumbotron question">
	<div class="form-group">
	<h3>Your Profile:</h3>
	</div>
	<div class="form-group">
	<label>昵称：</label> <p><?=$user_info['username'];?></p>
	</div>
	<div class="form-group">
	<label for="email">邮箱：</label> <input type="text" value="<?=$user_info['email'];?>" id="email" />
	</div>
	<div class="form-group">
	<label for="password">新密码(不需修改可留空)：</label> <input type="text" id="password" />
	</div>
	<div class="form-group">
	<label for="repass">请再输入一次密码：</label> <input type="text" id="repass" />
	</div>
	<div class="form-group">
	<label for="question">密保问题：</label> <input type="text" id="question" value="<?=$user_info['question']?>" />
	</div>
	<div class="form-group">
	<label for="answer">密保答案：</label> <input type="text" id="answer">
	</div>
	<div class="form-group">
	<label>头像：</label>
	<img src="<?=$user_info['head_img']?>" alt="点击修改头像" title="点击修改头像" id="headimg" />
	<input type="file"  name="head_img" id="head_img" onchange="test()" />
	</div>
	<div class="form-group">
	<label for="code">验证码：</label> <input type="text" id="code" placeholder="请输入验证码" />
		<a id="cap" title="换一张"><?=$cap['image'];?></a>
	</div>
	<button id="modify"  class="btn btn-lg btn-default">修改个人信息</button>
	<div role="alert" class="alert alert-warning"  id="error" style="display:none; margin-top:10px;">
        		<strong>Warning!</strong> 提交失败.
      	</div>
</div>
<script src="/static/js/jquery.ajaxfileupload.js"></script>
<script>
$('#cap').click(function(){
	load_captcha('cap','/WebCapt');
});
function load_captcha(id,url){
	var ran = Math.random();
	$("#"+id).load(url+"?r="+ran); 
}
$('#headimg').click(function(){
	$('#head_img').click();
});
$('#modify').click(function(){
	var data = {};
	data['email'] = $('#email').val();
	data['password'] = $('#password').val();
	data['repass'] = $('#repass').val();
	data['question'] = $('#question').val();
	data['answer'] = $('#answer').val();
	data['code'] = $('#code').val().toLowerCase();
	$.ajax({
		url: '/WebUser/up_profile',
		type: 'post',
		data: data,
		dataType: 'json',
		success: function(data){
			if (! data.code) {
				var s = '<div role="alert" class="alert alert-danger" margin-top:10px;><strong>Oh snap!</strong> '+data.msg+'</div>';
				document.getElementById("main").innerHTML += s;
				load_captcha('cap','/WebCapt');
			}
			else{
				var s = '<div role="alert" class="alert alert-success" style="margin-top:10px;"><strong>Well done!</strong></div>';
				document.getElementById("main").innerHTML += s;
				location.href="profile";
			}
		},
		error: function(){
			$('#error').show();
		}
	});
});
function test(){
	$.ajaxFileUpload({
		url:"/WebUser/up_head",
		secureuri : false,
		dataType : 'json',           
		fileElementId : 'head_img',              
		success : function(data) {
			if (data.code) {
				$('#headimg').attr('src', data.msg);
			}
			else{
				var s = '<div role="alert" class="alert alert-danger" margin-top:10px;><strong>Oh snap!</strong> '+data.msg+'</div>';
				document.getElementById("main").innerHTML += s;
			}
		},
		error : function() {
			var s = '<div role="alert" class="alert alert-warning"  id="error" style="display:none; margin-top:10px;"><strong>Warning!</strong>网络错误!</div>';
			document.getElementById("main").innerHTML += s;
		}
	});
}
</script>