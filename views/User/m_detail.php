		<div class="modal-dialog">
        		<div class="modal-content">
        		<div class="modal-header" id="h">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">邮件信息：</h4>
			</div>
		<div class="modal-body" style="margin: 30px;">
			<div class="col-md-13 form-group"> 
			<table class="table table-striped">
			<tr>
			<td>
				发送方：
			</td>
			<td>
				<?=$de['sour'];?>
			</td>
		</tr>
		<tr>
			<td>
				收件方：
			</td>
			<td>
				<?=$de['des'];?>
			</td>
		</tr>
		<tr>
			<td>
				标题：
			</td>
			<td>
				<?=$de['title'];?>
			</td>
		</tr>
		<tr>
			<td>
				正文:
			</td>
			<td>
				<textarea disabled  class="form-control" rows="3">
					<?=$de['content'];?>
				</textarea>
			</td>
		</tr>
		<tr>
			<td>
				发送时间：
			</td>
			<td>
				<?=$de['time'];?>
			</td>
		</tr>
		</table>
		</div>
		</div>
		<div class="modal-footer">
				<button type="button" class="btn btn-lg btn-default" data-dismiss="modal" style="margin-right:20px;">关闭</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
