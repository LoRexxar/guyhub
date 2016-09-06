<div id="main" class="form form-group  jumbotron question">
	<div class="form-group">
	<button id="send"  class="btn btn-lg btn-default" style="margin-left: 10px; ">发送站内信</button>
	</div>
	<div class="form-group">
		<p>收件箱</p>
		</div>
		<div class="form-group">
		<span>未读:</span>
		</div>
		<div class="col-md-13 form-group"> 
		<table class="table table-striped">
			<tr>
				<th>
					ID
				</th>
				<th>
					发送者邮箱
				</th>
				<th>
					标题
				</th>
				<th>
					发送时间
				</th>
			</tr>
		<?php foreach ($mail['receive']['noread'] as $key => $value): ?>
			<tr>
				<td>
					<?=$key;?>
				</td>
				<td>
					<a class="detail"><input class="id" type="hidden" value="<?=$value['id']?>"><?=$value['sour'];?></a>
				</td>
				<td>
					<?=$value['title'];?>
				</td>
				<td>
					<?=$value['time'];?>
				</td>
			</tr>
		<?php endforeach;?>
		</table>
		</div>
		<div class="form-group">
		<span>已读:</span>
		</div>
		<div class="col-md-13 form-group"> 
		<table class="table table-striped">
			<tr>
				<th>
					ID
				</th>
				<th>
					发送者邮箱
				</th>
				<th>
					标题
				</th>
				<th>
					发送时间
				</th>
			</tr>
		<?php foreach ($mail['receive']['read'] as $key => $value): ?>
			<tr>
				<td>
					<?=$key;?>
				</td>
				<td>
					<a class="detail"><input class="id" type="hidden" value="<?=$value['id']?>"><?=$value['sour'];?><a>
				</td>
				<td>
					<?=$value['title'];?>
				</td>
				<td>
				<?=$value['time'];?>
				</td>
			</tr>
		<?php endforeach;?>
		</table>
		
	</div>
	<div class="form-group">
		<span>已发送:</span>
		</div>
		<div class="col-md-13 form-group"> 
		<table class="table table-striped">
			<tr>
				<th>
					ID
				</th>
				<th>
					接收者邮箱
				</th>
				<th>
					标题
				</th>
				<th>
					发送时间
				</th>
			</tr>
			<?php foreach ($mail['send'] as $key => $value): ?>
				<tr>
					<td>
						<?=$key;?>
					</td>
					<td>
						<a class="detail"><input class="id" type="hidden" value="<?=$value['id']?>"><?=$value['des'];?><a>
					</td>
					<td>
						<?=$value['title'];?>
					</td>
					<td>
						<?=$value['time'];?>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
		</div>
		<div id="messsage" ></div>
	</div>
	<div id="detail" class="modal"></div>
	<div  class="modal" id="mymodal3">
		<div class="modal-dialog">
        		<div class="modal-content">
        		<div class="modal-header" id="h">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">发送站内信:</h4>
			</div>
		<div  class="modal" id="mymodal3"></div>
		<div class="modal-body" id="smail5" style="margin: 30px;">
			<form >
			<div class="form-group">
				<label for="des">收件人：</label><input type="text" class="form-control" id="des" placeholder="请输入邮箱" style="width:50%" />
			</div>
			<div class="form-group">
				<label for="title">标题 : </label><input type="text" class="form-control" id="title" placeholder="请输入标题"  style="width:50%"/>
				</div>
				<div class="form-group">
				<label for="content">正文</label>
				<textarea id="content" class="form-control" rows="3"></textarea>
				</div>
				<div class="form-group">
				<label for="code">验证码：</label> <input type="text" id="code" placeholder="请输入验证码" />
				<a id="cap" title="换一张"><?=$cap['image'];?></a>
				</div>
				<div class="form-group">
				<button id="sub" class="btn btn-lg btn-default">提交</button>
				<button class="btn btn-lg btn-default" data-dismiss="modal" style="margin-right:20px;">关闭</button>
				<div role="alert" class="alert alert-warning"  id="error" style="display:none; margin-top:10px;">
        				<strong>Warning!</strong> 提交失败.
      				</div>
				</div>
			</form>
			
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	$('#cap').click(function(){
		load_captcha('cap','/WebCapt');
	});
	function load_captcha(id,url){
		var ran = Math.random();
		$("#"+id).load(url+"?r="+ran); 
		$('#code').val('');
	}
	$("#send").click(function(){
      		$("#mymodal3").modal("toggle");
    	});
	$('.detail').click(function(e){
		get_detail(this);
	});
	function get_detail(target) {
		var da = $(target).find('input').val();
		url = "/WebUser/get_mail_detail?id=" + da;
		$.ajax({
    			url: url, 
			type: 'get',
			dataType: 'html',
			success: function(data){
				$('#detail').html(data);
				$("#detail").modal("toggle");
			},
			error: function(){
				$('#message').html('<div role="alert" class="alert alert-warning"  id="error" style="display:none; margin-top:10px;"><strong>Warning!</strong> 网络错误.</div>');
			}
    		});
	}
	$('#sub').click(function(event){
		event.preventDefault();
		var data = {};
		data['des'] = $('#des').val();
		data['title'] = $('#title').val();
		data['content'] = $('#content').val();
		data['code'] = $('#code').val();
		$.ajax({
			url: '/WebUser/send_mail',
			type: 'post',
			data: data,
			dataType: 'json',
			success: function(data){
				if (data.code) {
					var s = '<div role="alert" class="alert alert-success" style="margin-top:10px;"><strong>Well done!</strong></div>';
					document.getElementById("smail5").innerHTML += s;
				}
				else{
					var s = '<div role="alert" class="alert alert-danger" margin-top:10px;><strong>Oh snap!</strong> '+data.msg+'</div>';
					document.getElementById("smail5").innerHTML += s;
				}
			},
			error: function(){
				var s = '<div role="alert" class="alert alert-warning"  id="error" style="display:none; margin-top:10px;"><strong>Warning!</strong>网络错误!</div>';
				document.getElementById("smail5").innerHTML += s;
			}
		});
	});
</script>