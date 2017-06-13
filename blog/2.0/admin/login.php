<?php
include_once("start.php");
global $mysql,$input;

if($action = $input->get('action')){
	switch ($action) {
		case 'login':
			if($form = $input->posts(['aname','apass'])){
				$aname = $form["aname"];
				$apass = $form["apass"];
				$info = $mysql->get("admins","aname",$aname);
				if(!$info){
					header("location: login.php");
					exit("重新登录");
				}else{
					$aid = $info['aid'];
					$input->sessions_set(['aid'=>$aid,'aname'=>$aname,'apass'=>$apass]);
					$admins = $mysql->gets("select * from `admins`");
				}
				header("location: index.php");
			}
			break;
		case 'logout':
			$input->sessions_set(['aid'=>null,'aname'=>null,'apass'=>null]);
			break;
	}
}
?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>管理员登录</title>
		<?php include(PUBLIC_PATH."/header.php");?>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#" title="管理员首页">
				    <span class="glyphicon glyphicon-home"></span>
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li>
						<a href="#" title="管理员管理">
							管理员管理<span class="glyphicon glyphicon-user" ></span>
						</a>
					</li>
					<li>
						<a href="#" title="全局设置">
							全局设置<span class="glyphicon glyphicon-wrench"></span>
						</a>
					</li>
					<li>
						<a href="#" title="博客管理">
							博客管理<span class="glyphicon glyphicon-book"></span>
						</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle  disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员 <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">待添加...</a></li>
							<li role="separator" class="divider"></li>
							<li>
								<a href="login.php?action=logout">
									退出登录 <span class="glyphicon glyphicon-log-out"></span>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<div class="col-md-3">
			
		</div>
		<div class="container col-md-6">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">管理员登录</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" style="margin-top: 8%;" action="login.php?action=login" method="post">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">管理名称</label>
							<div class="col-sm-10">
							    <input type="text" class="form-control" name="aname" id="inputEmail3" placeholder="管理员名称">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">登录密码</label>
							<div class="col-sm-10">
							    <input type="password" class="form-control" name="apass" id="inputPassword3" placeholder="登录密码">
							</div>
						</div>
						<!--<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <div class="checkbox">
								<label>
								  <input type="checkbox"> Remember me
								</label>
							  </div>
							</div>
						</div>-->
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							    <button type="submit" class="btn btn-default">登录</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>