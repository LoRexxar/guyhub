<div id="form" class="form jumbotron question" style="min-width:800px;">
	<div class="form-group" >
	<h2>New Project:</h2>
	</div>
	<div class="form-group">
	<label for="pname">Project name：</label><input type="text" id="pname" />
	</div>
	<div class="form-group">
	<label >项目状态：</label>
	 <input type="radio" name="status" value="1" /> 公开项目  <input type="radio" name="status" value="0" /> 私有项目
	</div>
	<div class="form-group">
	<label for="pcom">项目描述：</label> <textarea id="pcom"  class="form-control" rows="5"></textarea>
	</div>
	<div class="form-group">
	<label for="code">验证码：</label> <input type="text" id="code" placeholder="请输入验证码" />
		<a id="cap" title="换一张"><?=$cap['image'];?></a>
	</div>
	<button id="sub" class="btn btn-lg btn-default" style="min-width:150px;">提交</button>
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
	data['public'] = $('input[name="status"]:checked').val();
	data['project_name'] = $('#pname').val();
	data['project_com'] = $('#pcom').val();
	data['code'] = $('#code').val().toLowerCase();
	$.ajax({
		url: '/WebUser/addProject',
		type: 'post',
		data: data,
		dataType: 'json',
		success: function(data){
			if (! data.code) {
				var s = '<div role="alert" class="alert alert-danger" margin-top:10px;><strong>Oh snap!</strong> '+data.msg+'</div>';
				document.getElementById("form").innerHTML += s;
				load_captcha('cap','/WebCapt');
			}
			else{
				var s = '<div role="alert" class="alert alert-success" style="margin-top:10px;"><strong>Well done!</strong></div>';
				document.getElementById("form").innerHTML += s;
				location.href="/WebUser/index";
			}
		},
		error: function(){
			$('#error').show();
		}
	});
});
</script>
