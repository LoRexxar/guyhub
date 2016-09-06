	<?php echo form_open('/Find/change') ?>
				<div class="form question">
				<div class="form-group">
				<h3>密码找回:</h3>
				</div>
				<div class="form-group">
					<input type="text" style="min-width:150px; min-height:40px" name="username" placeholder="username"/>
			        <?php echo form_error('username'); ?>
				</div>
				<div class="control-group form-group" >
				    <input type="text" style="min-width:150px; min-height:40px" name="code" placeholder="code" />
					<a id="cap" title="换一张"><?php echo $image; ?></a>
                    <?php echo form_error('code'); ?>
               </div>
				<div>
					<input  class="btn btn-lg btn-default" type="submit"  value="next">
					<input type="button" class="btn btn-lg btn-default" style="min-width:150px;" id="cancel" value="cancel" />
				</div>
				</div>
<script type="text/javascript">

$('#cap').click(function(){
	load_captcha('cap','/WebCapt');
});
function load_captcha(id,url){
	var ran = Math.random();　
　$("#"+id).load(url+"?r="+ran); 
}
$('#cancel').click(function(){
        window.location.href='/WebIndex/login';
});

</script>
	<?php echo form_close(); ?>
