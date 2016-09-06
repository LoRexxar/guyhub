<div id="main" class="form form-group  jumbotron question">
	<div id="info">
	<?php if ($pro['is_create']): ?>
	<button id="showg"  class="btn btn-lg btn-default" style="margin-bottom:10px;">项目群组</button>
	<?php endif;?>
		<div class="form-group">
		<p>项目信息：</p>
		</div>
		<div class="form-group">
		<p>名称：<span><?=$pro['project_name'];?></span>  创建时间：<span><?=$pro['build_time']?></span></p>
		</div>
		<div class="form-group">
		<p>创建者：<span><?=$pro['creater_name'];?></span></p>
		</div>
		<?php if ($pro['public']): ?>
		<div class="form-group">
		<p>关注数：<span><?php echo count($pro['foc']);?></span> 点赞数：<span><?=$pro['praise']?></span></p>
		</div>
		<?php endif;?>
		<div class="form-group">
		<p>描述：<span><?=$pro['project_com']?></span></p>
		</div>
	</div>

	<?php if ($pro['is_create']): ?>
	<div  class="modal" id="mymodal">
		<div class="modal-dialog">
        		<div class="modal-content">
        		<div class="modal-header" id="h">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">邀请成员</h4>
				<input type="text"  placeholder="输入邀请成员的邮箱" id="email" style="display:none; min-width:250px; min-height:40px;"><button  class="btn btn-lg btn-default" id="a" style="display:none;">添加</button><button  class="btn btn-lg btn-default" id="shown">添加新成员</button>
		
			</div>
		<div id="message"></div>
		<div id="b" class="col-md-11  modal-body">
			<table class="table table-striped">
				<tr>
					<th>
						头像
					</th>
					<th>
						昵称
					</th>
					<th>
						邮箱
					</th>
				</tr>
			<?php foreach ($pro['sha'] as $key => $value): ?>
				<tr>
					<td><img src="<?=$value['head_img']?>"></td>
					<td><p><?=$value['username'];?></p></td>
					<td><p><?=$value['email'];?></p></td>
				</tr>
			<?php endforeach;?>
			</table>
			
		</div>
		<div class="modal-footer">
				<button type="button" class="btn btn-lg btn-default" data-dismiss="modal" style="margin-right:20px;">关闭</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
<?php endif;?>
	<div id="file">
	<div>
		<button id="upload" disabled class="btn btn-lg btn-default" style="margin-bottom:30px;">上传文件</button>
	</div>
	<div  class="modal" id="mymodal2">
		<div class="modal-dialog">
        		<div class="modal-content">
        		<div class="modal-header" id="h">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">上传文件</h4>
			</div>
		<div id="message2"></div>
		<div id="b" class="col-md-11  modal-body">
			<div id="upfile" >
				<input class="btn btn-lg btn-default" type="file" id="f" name="f">
				<label for="code">验证码：</label> <input type="text" id="code" placeholder="请输入验证码" />
				<a id="cap" title="换一张"><?=$cap['image'];?></a>
				<button id="sub" class="btn btn-lg btn-default" style="max-height=25px">提交</button>
				<div role="alert" class="alert alert-warning"  id="error" style="display:none; margin-top:10px;">
        				<strong>Warning!</strong> 提交失败.
      				</div>
			</div>
			
		</div>
		<div class="modal-footer">
				<button type="button" class="btn btn-lg btn-default" data-dismiss="modal" style="margin-right:20px;">关闭</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<div class="col-md-15"> 
	<table class="changef table table-striped">
		<tr>
			<th>
				名称
			</th>
			<th>
				修改时间
			</th>
		</tr>
		<tr>
			<td id="dir"><a href="#"><?php $str = $pro['code_addr'];$s = strrpos($str,'/');echo substr($str,$s+1);?></a></td>
			<td><?php $a=fileatime($str); echo date("m-d H:i:s",$a);?></td>
		</tr>
	</table>
	</div>
	</div>
</div>
<script src="/static/js/jquery.ajaxfileupload.js"></script>
<script type="text/javascript">
	$('#cap').click(function(){
		load_captcha('cap','/WebCapt');
	});
	function load_captcha(id,url){
		var ran = Math.random();
		$("#"+id).load(url+"?r="+ran); 
		$('#code').val('');
	}
	$('#shown').click(function(){
		$('#shown').hide();
		$('#a').show();
		$('#email').show();
	});
	$('#dir').click(function(){
		get_file();
	});
	$('#sub').click(function(){
		$.ajaxFileUpload({
			url:"/WebUser/up_file?id=<?=$pro['id']?>",
			secureuri : false,
			type: 'POST',
			data: {'code': $('#code').val().toLowerCase()},
			dataType : 'json',           
			fileElementId : 'f',              
			success : function(data) {
				if (data.code) {
					var s = '<div role="alert" class="alert alert-success" style="margin-top:10px;"><strong>文件上传成功！</strong></div>';
					document.getElementById("message2").innerHTML = s;
					get_file();
				}
				else{
					var s = '<div role="alert" class="alert alert-danger" margin-top:10px;><strong>Oh snap!</strong> '+data.msg+'</div>';
					document.getElementById("message2").innerHTML = s;
					load_captcha('cap','/WebCapt');
				}
			},
			error: function(){
				$('.changef').html('<div role="alert" class="alert alert-warning"  id="error" style="display:none; margin-top:10px;"><strong>Warning!</strong> 网络错误.</div>');

			}
		});
	});
	$('#a').click(function(){
		$.ajax({
			url: '/WebUser/add_group',
			type: 'post',
			data: {'email': $('#email').val(), 'project_name': "<?=$pro['project_name'];?>"},
			dataType: 'html',
			success: function(data){
				$('#message').html('<div role="alert" class="alert alert-success" margin-top:10px;><strong>Well done!</strong> '+data+'</div>');
			},
			error: function(){
				$('#message').html('<div role="alert" class="alert alert-warning"  id="error" style="display:none; margin-top:10px;"><strong>Warning!</strong> 网络错误.</div>');
			}
		});
	});
	function get_file () {
		$.ajax({
			url: '/WebUser/getfile?id=<?=$pro["id"]?>',
			type: 'get',
			dataType: 'html',
			success: function(data){
				$('.changef').html(data);
				$('#upload').removeAttr("disabled");
				$('.fname').click(function(){
					get_f_d(this);
				})
			},
			error: function(){
				$('.changef').html('<div role="alert" class="alert alert-warning"  id="error" style="display:none; margin-top:10px;"><strong>Warning!</strong> 网络错误.</div>');
			}
		});
	}
    	$("#showg").click(function(){
      		$("#mymodal").modal("toggle");
    	});
    	$('#upload').click(function(){
		$("#mymodal2").modal("toggle");
		$('#f').click();
	});
    	function get_f_d(target){
    		var url = '/WebUser/file_con?id=<?=$pro["id"]?>&name=' + $(target).html();
    		$.ajax({
    			url: url,
			type: 'get',
			dataType: 'html',
			success: function(data){
				alert(data);
			},
			error: function(){
				$('.changef').html('网络错误');
			}
    		})
    	}
</script>