
<?php $attr=array("id"=>"form","style"=>"max-width:600px;"); echo form_open('/register/check',$attr) ?>
		  		<div class="form-group">
		  		<h2>Sign Up:</h2>
		  		</div>
				<div class="form-group">
				    <input  type="text" name="username" class="form-control" placeholder="Username"/>
			
			        <?php echo form_error('username'); ?>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="email" placeholder="Email Address"/>
			        <?php echo form_error('email'); ?>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password"/>
			        <?php echo form_error('password'); ?>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="vpassword" placeholder="Verify Password"/>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="question" placeholder="safe question"/>
				    <?php echo form_error('question'); ?>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="answer" placeholder="answer"/>
				    <?php echo form_error('answer'); ?>
				</div>
				<div class="control-group form-group" >
				    <input type="text" class="form-control" name="code" placeholder="code" />
				<a id="cap" title="换一张"><?php echo $image;?></a>
                    <?php echo form_error('code'); ?>
                    
				</div>
				<div class="form-group">
					<input class="btn btn-lg btn-default" type="submit"  name="register">
					<input type="button" style="min-width: 150px;" class="btn btn-lg btn-default" id="login1" value="Have An Account?" >	
				</div>
		  <?php echo form_close(); ?>
<script type="text/javascript">
function load_captcha(id,url){
        var ran = Math.random();　
　$("#"+id).load(url+"?r="+ran); 
}

$('#cap').click(function(){
        load_captcha('cap','/WebCapt');
});

$('#login1').click(function(){
	window.location.href='/WebIndex/login';
});
</script>
