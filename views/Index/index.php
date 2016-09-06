<style type="text/css">
			html, body{
				width: 100%;
				height: 100%;
				overflow: hidden;
			}
			body {
				background: rgb(115, 74, 191);
			}
			.in {
 			  position: absolute;
    		left: 20%;
    		top: 20%;
   			padding: 0 20px; 
    		width: 100%;
			}
			#particles {
			  width: 100%;
  			height: 1000px;
  			overflow: auto;
				color: white;				
				text-shadow: 1px 1px 1px #fff;
			}
		</style>

<canvas class="pg-canvas" width="1920" height="604"></canvas>
<div id="particles" class="jumbotron">
	<div class="in container">
		<h1>GayHub</h1>
		<p>一个交♂流哲♂学, 分享代码的网站.</p><span>(测试版)</span>
	</div>
</div>
<!-- <div>
	太困了～～这里就不写了。。。
</div> -->
<script type="text/javascript">
	$(document).ready(function(){
		$('body').particleground({
			dotColor: 'rgb(210, 210, 210)',
			lineColor: 'rgb(210, 210, 210)',
		});
		$('.in').css({
			'top': document.documentElement.clientHeight/3,
		});
	})
	</script>
</script>
