	<?php echo form_open('/Find/done') ?>
				<div class="form question">
				<div class="form-group">
					<p><?php  $username=$_SESSION['username']; echo "username:$username"; ?></p>
					<p><?php  $question = $_SESSION['question'];    echo "question: $question"; ?></p>
				</div>	
				<div class="form-group">
					<input type="text" name="answer" style="min-width:150px; min-height:40px;" placeholder="answer"/>
			        <?php echo form_error('answer'); ?>
				</div>
				<div class="form-group">
					<input type="password" name="password" style="min-width:150px; min-height:40px;" placeholder="password"/>
					<?php echo form_error('password'); ?>
				</div>
				<div class="control-group form-group" >
				    <input type="text" name="code" style="min-width:150px; min-height:40px;" placeholder="code" />
					<a id="cap" title="换一张"><?php echo $image;?></a>
                    <?php echo form_error('code'); ?>
               </div>
				<div class="form-group">
					<input type="submit" class="btn btn-lg btn-default" value="next">
					<input type="button" class="btn btn-lg btn-default" style="min-width:150px;" id="cancel" value="cancel"/>
				</div>
	<?php echo form_close(); ?>
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
