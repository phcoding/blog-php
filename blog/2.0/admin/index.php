<?php
include_once("start.php");
global $mysql,$input;

if(!($result = $input->sessions(['aid','aname','apass']))){
    header("location: login.php");
    exit("重新登录");
}else{
    $aid = (int)$result['aid'];
    $aname = $result['aname'];
    $apass = $result['apass'];

    $info = $mysql->get("admins","aid",$aid);

    //登录验证
    if($aid != (int)$info['aid'] || $aname != $info['aname'] || $apass != $info['apass'] ){
        header("location: login.php");
        exit("重新登录");
    }else{
        $admins = $mysql->gets("select * from `admins`");
        $limit = (int)$mysql->getConfigValueByName("ADM_LIMIT_ADMIN_LIST");//配置项
        $total = count($admins);
        $pagesplit = new \ph\mysql\pagesplit($total,$limit,"index.php");
        $page =limit($input->get('page',1),1,$pagesplit->pagecount);

        $start = ($page-1)*$limit;
        $admins = $mysql->gets("select * from `admins` limit {$start},{$limit}");
    }
}

?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>管理员首页</title>
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
		      <a class="navbar-brand" href="index.php">
				  <span class="glyphicon glyphicon-home"></span>
			  </a>
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
		
		<div class="col-md-1"></div>
		<div class="container col-md-10">
			<div class="panel panel-danger">
			    <div class="panel-heading">
			    	管理员列表
			  	  	<a class='btn btn-danger btn-xs pull-right' href='add_admin.php?page=<?php echo $page;?>'>
			  	  		<span class="glyphicon glyphicon-plus"></span>添加
			  	  	</a>
			    </div>
			    <div class="panel-body">
			    <table class="table table-condensed table-responsive table-bordered table-striped">
			    	<thead>
			    		<tr class="bg-danger">
			    			<th>编号</th>
			    			<th>用户名</th>
			    			<th>密码</th>
			    			<th>编辑</th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		<?php
						foreach ($admins as $admin) {
							echo "<tr>";
							echo "<td>"."{$admin['aid']}"."</td>";
							echo "<td>"."{$admin['aname']}"."</td>";
							echo "<td>"."{$admin['apass']}"."</td>";
							echo "<td class='col-md-2'>";
							echo "<a class='btn btn-primary btn-sm' href='#'><span class='glyphicon glyphicon-pencil'></span></a> ";
							if($admin['aid'] != $aid){
								echo "<a class='btn btn-danger btn-sm' href='add_admin.php?action=del&&aid={$admin['aid']}&&page={$page}'><span class='glyphicon glyphicon-trash'></span></a>";
							}
							echo "</td>";
							echo "<tr>";
						}
			    		?>
			    	</tbody>
				</table>
				<?php $pagesplit->create($page)?>
			  </div>
			</div>
		</div>
		
	</body>
</html>