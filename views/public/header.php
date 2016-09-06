<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="HCTF_7" />
	<meta name="keywords" content="HCTF_7" />
	<meta name="author" content="Hcamael" />
	<title><?=$title;?></title>
	<link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/static/css/style.css">
	<script src="/static/js/jquery-1.11.3.min.js"></script>
	<script src="/static/js/jquery.particleground.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body style="padding-top: 100px;">
 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div id ="head" class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="/WebIndex"><h3>Gayhub</h3></a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right uuu">
            <li><a href="/WebDiscuss/discuss"><p id="discuss">Discuss</p></a></li>
          <?php if ((isset($is_login)) && $is_login): ?>
		<li class="dropdown">
		<a class="dropdown-toggle" aria-expanded="true" ariz-haspopup="ture" role="button" data-toggle="dropdown" href="#"><?=$user_info['username'];?><span class="caret"></span></a>
		<ul class="dropdown-menu">
		<li class="profile"><a href="#">Your Profile</a></li>
		<li id="index"><a href="#">Your Project</a></li>
		<li id="mail"><a href="#">Message</a></li>
		<li id="out"><a href="#">Sign out</a></li>
		</ul>
		</li>
		<li><img class="profile" src="<?=$user_info['head_img'];?>" title="更换头像" alt="更换头像"></li>
	<?php elseif(isset($is_login)): ?>
		<li><button id="login" class="btn btn-success">Sign In</button></li>
		<li><button id="register" class="btn btn-success">Sign up</button></li>
	<?php endif;?>
          </ul>
          <form class="navbar-form navbar-right search">
           <input type="text" placeholder="搜索" id="s" class="form-control"/>
           <button id="search" class="btn btn-default">Click</button>
           </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
