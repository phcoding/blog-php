<?php
include_once "start_user.php";
global $mysql;

$articles = $mysql->gets('article');
?>
<!DOCTYPE html>
<html>
<head>
	<!--header.php-->
	<?php include_once PATH_PUBLIC."header/header.php";?>
	<link rel="stylesheet" href="<?php echo URL_ROOT?>css/index.css" />
	<!--header.php-->
	<title>个人博客首页</title>
</head>

<body>
<!--巨幕-->
<div class="jumbotron header">
	<div class="container">
		<h1>PH的个人博客</h1>
		<p style="font-family: '楷体'">
			路漫漫其修远兮，吾将上下而求索！
		</p>
	</div>
</div>

<!--导航条-->
<nav class="navbar navbar-default main-navbar">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
			<ul class="nav navbar-nav menu">
				<li class="current"><a href="#">首页</a></li>
				<li><a href="#">JAVA</a></li>
				<li><a href="#">PHP</a></li>
				<li><a href="#">关于</a></li>
				<li class="navbar-right">
					<a href=<?=URL_ROOT."admin/"?> title="管理员登录">
						<span class="glyphicon glyphicon-log-in btn-lg"></span>
					</a>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

<!--主体内容-->
<div class="main container col-md-12">
	<div class="panel">
		<div class="panel-body">
			<!--博文区-->
			<div class="container col-md-8">

				<?php
				foreach ($articles as $article) {
				?>
				<!--1-->
				<div class="panel panel-default post">
					<div class="panel-body">
						<article class="container col-sm-12 post-main">
							<div class="post-header text-center">
								<h1><?=$article['at_title']?></h1>
								<p class="post-meta">作者：<span class="author"><?=$article['at_auth']?></span> • <?=date("Y年m月d日",$article['at_date'])?></p>
							</div>
							<div class="post-media">
								<a href="blog.php?at_id=<?=$article['at_id']?>">
									<img src="http://image.youzhan.org/0/ed/36ea2cdcaa17fd57d6337e6dfc977.png!thumb" />
								</a>
							</div>
							<div class="post-content">
								<p><?=substr(strip_tags($article['at_cont']),0,200)."..."?></p>
							</div>
							<div class="post-link">
								<a href="blog.php?at_id=<?=$article['at_id']?>" class="btn btn-common">阅读全文</a>
							</div>
							<div class="post-footer">
								<span class="glyphicon glyphicon-link"></span>
								<a href="#">link1</a>,<a href="#">link2</a>
							</div>
						</article>
					</div>
				</div>
				<!--1-->
				<?php
				}
				?>
				</div>
			<!--博文区-->

			<!--挂件区-->
			<div class="container col-md-4 auto-hidden">
				<div class="panel panel-default">
					<div class="panel-body post">
						<article class="container col-sm-12 post-main">
							<div class="post-header text-center">
								<h1>title</h1>
								<p class="post-meta">
									作者：<span class="author">PH</span> • 2016年5月12日
								</p>
							</div>
							<div class="post-media">
								<a href="#">
									<img src="http://image.youzhan.org/0/ed/36ea2cdcaa17fd57d6337e6dfc977.png!thumb" width="100%" />
								</a>
							</div>
							<div class="post-content" >
								<p>2433243242323432432444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444</p>
							</div>
							<div class="post-link">
								<a href="#" class="btn btn-common">阅读全文</a>
							</div>
							<div class="post-footer" >
								footer
							</div>
						</article>
					</div>
				</div>
			</div>
			<!--挂件区-->
		</div>
	</div>
</div>
<!--主体内容-->
</body>

</html>