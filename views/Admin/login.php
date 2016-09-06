<?php $attr=array("id"=>"form","style"=>"max-width:500px;"); echo form_open('/Web_admin/check',$attr); ?>
				<div class="form-group">
				<h2>admin 登陆:</h2>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="admin" placeholder="admin name"/>
			        <?php echo form_error('username'); ?>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password"/>
			        <?php echo form_error('password'); ?>
				</div>
				<div class="control-group form-group">
				    <input type="text" name="code"  class="form-control" placeholder="code" />
					<a id="cap" title="换一张"><?php echo $image;?></a>
                    <?php echo form_error('code'); ?>
				</div>
				<div >
					<input type="submit"  style="min-width: 150px;" class="btn btn-lg btn-default" value="login">
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
</script>
