<?php
include_once "start_user.php";
global $mysql,$input;

if($at_id = $input->get('at_id')){
	if($article = $mysql->get('article','*',['at_id'=>$at_id])){
		//	入口
	}else{
		header('location: index.php');
		exit();
	}
}else{
	header('location: index.php');
	exit();
}
?>
<!DOCTYPE html>
<html>

<head>
	<!--header.php-->
	<?php include_once PATH_PUBLIC."header/header.php";?>
	<link rel="stylesheet" href="<?php echo URL_ROOT?>css/index.css" />
	<link rel="stylesheet" href="<?php echo URL_ROOT?>css/blog.css" />
	<!--header.php-->

	<title>个人博客首页</title>
</head>

<body>
<div class="jumbotron header">
	<div class="container">
		<h1>PH的个人博客</h1>
		<p style="font-family: '楷体'">
			路漫漫其修远兮，吾将上下而求索！
		</p>
	</div>
</div>

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
					<a href="#" title="管理员登录">
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
			<div class="container col-md-9">
				<!--1-->
				<div class="panel panel-default post">
					<div class="panel-body">
						<article class="container col-sm-12 post-main">
							<div class="post-header text-center">
								<h1><?=$article['at_title']?></h1>
								<p class="post-meta">作者：<span class="author"><?=$article['at_auth']?></span> • <?=date("Y年m月d日",$article['at_date'])?></p>
							</div>
<!--							<div class="post-media">-->
<!--								<a href="#">-->
<!--									<img src="http://image.youzhan.org/0/ed/36ea2cdcaa17fd57d6337e6dfc977.png!thumb" />-->
<!--								</a>-->
<!--							</div>-->
							<div class="post-content">
								<p><?=$article['at_cont']?></p>
							</div>
							<div class="post-permalink">
								<nav>
									<ul class="pager">
										<li class="previous disabled"><a href="#"><span aria-hidden="true">&larr;</span> 上一篇</a></li>
										<li class="next"><a href="#">下一篇 <span aria-hidden="true">&rarr;</span></a></li>
									</ul>
								</nav>
							</div>
							<div class="col-md-12 post-footer">
								<div class="pull-left tag-list">
									<span class="glyphicon glyphicon-link"></span>
									<a href="#">link1</a>,<a href="#">link2</a>
								</div>
								<div class="pull-right user-action ">
									<a href="#"><span class="glyphicon glyphicon-thumbs-up"></span></a>
									<a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
								</div>
							</div>
						</article>
						<div class="col-md-12 comment">
							<div class="comment-header">
								<p class="lab">查看评论</p>
								<a href="#"><span class="glyphicon glyphicon-menu-down"></span></a>
							</div>
							<div class="col-md-12 comment-body">
								<ul class="col-md-12 comment-main">
									<li class="card col-md-12">
										<a href="#" class="c-id" style="position: absolute;">
											<img src="img/head.jpg"/>
										</a>
										<div class="c-main" style="position: relative;">
											<div class="c-header">
												<h4 class="h-title">biaoti</h4>
												<p class="h-detail">留兰香</p>
											</div>
											<ul class="c-content">
												<li>12121</li>
											</ul>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!--1-->
			</div>
			<!--博文区-->

			<!--挂件区-->
			<div class="container col-md-3 auto-hidden">
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