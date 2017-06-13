<?php
include("start.php");
if(isset($_SESSION['aid']) && isset($_SESSION['aname'])){
	$aid = $_SESSION['aid'];
	$aname = $_SESSION['aname'];
	$page = isset($_GET['page'])?(int)$_GET['page']:1;
	if(isset($_GET['action'])){
		switch ($_GET['action']) {
			case 'add':
				if(isset($_POST['aname']) && isset($_POST['apass'])){
					$aname_add = $_POST["aname"];
					$apass_add = $_POST["apass"];
					$info = $mysql->get("select * from admins where aname='{$aname_add}'");
					if(empty($info)){
                        $result = $mysql->add_admin($aname_add, $apass_add);
                        $page++;
					}
				}
				break;
			case 'del':
				if(isset($_GET['aid'])){
					$aid_del = (int)$_GET['aid'];
					$mysql->del_admin($aid_del);
					header("location: index.php?page={$page}");
				}
                break;
		}
	}
}else{
	header("location: login.php");
}
?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>管理员管理|添加管理员</title>
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
		      <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></a>
		    </div>
		
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active">
						<a href="index.php" title="管理员管理">
							管理员管理 <span class="glyphicon glyphicon-user" ></span>
						</a>
					</li>
					<li>
						<a href="setting.php" title="全局设置">
							全局设置 <span class="glyphicon glyphicon-cog"></span>
						</a>
					</li>
					<li>
						<a href="article.php" title="博客管理">
							博客管理 <span class="glyphicon glyphicon-book"></span>
						</a>
					</li>
				</ul>
		      <ul class="nav navbar-nav navbar-right">
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" ></span> <?php echo $aname;?><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">待添加...</a></li>
						<li role="separator" class="divider"></li>
						<li>
							<a href="index.php?action=logout">
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
			    <h3 class="panel-title">
			    	添加管理员
			    	<a class='btn btn-default btn-xs pull-right' href='index.php?page=<?php echo $page;?>'>
			  	  		<span class="glyphicon glyphicon-chevron-left"></span>
			  	  		返回
			  	  	</a>
			    </h3>
			  </div>
			  <div class="panel-body">
				<form class="form-horizontal" style="margin-top: 8%;" action="add_admin.php?action=add&&page=<?php echo $page;?>" method="post">
				  <div class="form-group">
				    <label for="aname" class="col-sm-2 control-label">管理名称</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="aname" id="aname" placeholder="管理员名称">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="apass" class="col-sm-2 control-label">登录密码</label>
				    <div class="col-sm-10">
				      <input type="password" class="form-control" name="apass" id="apass" placeholder="登录密码">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-default">保存</button>
				    </div>
				  </div>
				</form>
			  </div>
			</div>
		</div>
	</body>
</html>