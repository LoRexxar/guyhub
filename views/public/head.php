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
            <li><a href="/admin_qwe.php/Web_admin/signout"><p id="asighout">Sign out</p></a></li>
          </ul>
            <ul class="nav navbar-nav navbar-right uuu">
            <li><a href="/WebDiscuss/discuss"><p id="discuss">Discuss</p></a></li>
          </ul>
          <form class="navbar-form navbar-right search">
           <input type="text" placeholder="搜索" id="s" class="form-control"/>
           <button id="search" class="btn btn-default">Click</button>
           </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
