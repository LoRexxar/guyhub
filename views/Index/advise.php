<?php $attr=array("id"=>"form","style"=>"max-width:600px;"); echo form_open('/Advise/check',$attr) ?>
		  		<div class="form-group">
		  		<h2>Advise:</h2>
		  		</div>
				<div class="form-group">
				    <input  type="text" class="form-control" name="title" style="max-width:200px" placeholder="Title"/>
				
			        <?php echo form_error('title'); ?>
			     
				</div>
				<div class="form-group">
					<textarea   class="form-control" rows="5" name="advise" placeholder="The advise"></textarea>

				
			        <?php echo form_error('advise'); ?>
			       
				</div>
				<div class="form-group">
					<input type="text" name="code"  class="form-control" style="max-width:200px" placeholder="code" />
					<a id="cap" title="换一张"><?php echo $image;?></a>
                    <?php echo form_error('code'); ?>
                    			</div>
				<div class="form-group">
					<input type="submit"  class="btn btn-lg btn-default" name="submit">
					<input type="button"  class="btn btn-lg btn-default" style="margin-left:20px;" id="back" value="back" >	
				</div>
		  <?php echo form_close(); ?>
<script>
	$('#back').click(function(){
		window.location.href='/WebUser/index';
	});
	$('#cap').click(function(){
		load_captcha('cap','/WebCapt');
	});
</script>