<?php  $attr=array("id"=>"form","style"=>"max-width:600px;");  echo form_open('/login/check',$attr); ?>
				<div class="form-group">
				<h2>Sign In:</h2>
				</div>
				<div class="form-group">
					<input type="text"  class="form-control" name="username" placeholder="username"/>
			        <?php echo form_error('username'); ?>
				</div>
				<div class="form-group">
					<input type="password"  class="form-control" name="password" placeholder="Password"/>
			        <?php echo form_error('password'); ?>
				</div>
				<div class="control-group form-group" >
				    <input type="text" name="code"  class="form-control" placeholder="code" />
					<a id="cap" title="换一张"><?php echo $image;?></a>
                    <?php echo form_error('code'); ?>
				</div>
				<div class="form-group">
					<input class="btn btn-lg btn-default" type="submit"  value="login">
					<input type="button" style="min-width: 150px;" class="btn btn-lg btn-default" id="register" value="register" />					<a href="/Find/index">Forget password?</a>
				</div>
<?php echo form_close(); ?>
<script type="text/javascript">
$('#cap').click(function(){
	load_captcha('cap','/WebCapt');
});
function load_captcha(id,url){
	var ran = Math.random();　
　$("#"+id).load(url+"?r="+ran); 
}
$('#register').click(function(){
	window.location.href='/WebIndex/register';
});
</script>
