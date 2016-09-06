	<div id="main" class="form jumbotron question manage">
	<div class="form-group">
	<h3>Manage:</h3>
	</div>
	<div class="form-group">
		<?php echo form_open('/Web_admin/find') ?>
				<div class="span12 panel-heading">
				<div class="col-md-3">
					<select name="method" class="form-control">
							<option value="username">username</option>
							<option value="email">email</option>
							<option value="power">power</option>
							<option value="last_ip">last_ip</option>
				   </select></div>
				   <div class="col-md-6">
					<input type="text" name="name" class="form-control"  placeholder="name"/>
			        <?php echo form_error('name'); ?>
			        </div>
			        <div class="col-md-3">
			        <input type='submit' value="Find user"/>
				</div>
				</div>
	<?php echo form_close(); ?>
	</div>
	<div class="form-group">		
		<?php echo form_open('/Web_admin/findp') ?>
				<div class="span12 panel-heading">
				<div class="col-md-3">
					<select name="method"  class="form-control">
							<option value="id">id</option>
							<option value="project_name">project name</option>
							<option value="creater_id">creater id</option>
							<option value="build_time">build time</option>
				   </select></div>
				    <div class="col-md-6">
					<input type="text" name="name"  class="form-control" placeholder="name"/>
			        <?php echo form_error('name'); ?>
			        </div>
			        <div class="col-md-3">
			        <input type='submit' value="Find project"/>
				</div>
				</div>
	<?php echo form_close(); ?>
	</div>
	<div class="form-group">		
		<?php echo form_open('/Web_admin/delete') ?>
				<div class="span12 panel-heading">
				<div class="col-md-3">
					<select name="method" class="form-control">
							<option value="username">username</option>
							<option value="email">email</option>
				   </select>
				   </div>
				   <div class="col-md-6">
					<input type="text" name="name"  class="form-control" placeholder="name"/>
			        <?php echo form_error('name'); ?>
			        </div>
			        <div class="col-md-3">
			        <input type='submit' value="Delete user"/>
				</div>
				</div>
	<?php echo form_close(); ?>
	</div>
	<div class="form-group">		
		<?php echo form_open('/Web_admin/deletep') ?>
				<div class="span12 panel-heading">
				<div class="col-md-3">
					<select name="method" class="form-control">
							<option value="id">id</option>
							<option value="creater_id">creater id</option>
							<option value="project_name">project name</option>
				   </select>
				   </div>
				   <div class="col-md-6">
					<input type="text" name="name"   class="form-control" placeholder="name"/>
			        <?php echo form_error('name'); ?>
			        </div>
			        <div class="col-md-3">
			        <input type='submit' value="Delete project"/>
				</div>
	<?php echo form_close(); ?>
	</div>
	</div>
	<div class="form-group" style="margin-top:10px;">
	<?php echo form_open('/Web_admin/update') ?>
				<div class="span12 panel-heading">
				<div class="col-md-3">
					<input type="text" name="username"  class="form-control" placeholder="username"/>					
				</div>
				<div class="col-md-3">
					<select name="type" class="form-control">
							<option value="email">email</option>
							<option value="password">password</option>
							<option value="head_img">head_img</option>
							<option value="question">question</option>
							<option value="answer">answer</option>
				   </select>
				   </div>
				   <div class="col-md-3">
					<input type="text" name="name"  class="form-control" placeholder="new_message"/>
			        <?php echo form_error('name'); ?>
			        	</div>
			        	<div class="col-md-3">
			        <input type='submit' value="Update User"/>
				</div>
				</div>
	<?php echo form_close(); ?>
	</div>
	<div class="form-group  span8 panel-heading" style="margin-top:50px;">
	<input type="button" style="min-width: 150px; margin-left:50px" class="btn btn-lg btn-default" id="lista" value="List All User" />
	<input type="button" style="min-width: 150px; margin-left:50px" class="btn btn-lg btn-default" id="advise" value="List All Advise" />
	<input type="button" style="min-width: 150px; margin-left:50px" class="btn btn-lg btn-default" id="signp" value="List All Project" />
	</div>
	</div>
<script>
$('#lista').click(function(){
	window.location.href='/admin_qwe.php/Web_admin/list';
});
$('#signp').click(function(){
	window.location.href='/admin_qwe.php/Web_admin/listp';
});
$('#advise').click(function(){
	window.location.href='/admin_qwe.php/Web_admin/lista';
});
</script>
