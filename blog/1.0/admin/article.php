<?php
include("start.php");
if(isset($_SESSION['aid']) && isset($_SESSION['aname'])){
    $aid = (int)$_SESSION['aid'];
    $aname = $_SESSION['aname'];

    $limit = (int)$mysql->getConfigValueByName("ADM_LIMIT_ARTICLE_LIST");//配置项
    $total = $mysql->getArticlesCount();
    $pagesplit = new \ph\mysql\pagesplit($total,$limit,"article.php");
    if(isset($_GET['page'])){
        $page = (int)$_GET['page'];
        if($pagesplit->pagecount>0){
            if($page<1){
                $page = 1;
                header("location: article.php?page=".$page);
            }
            if($page>$pagesplit->pagecount){
                $page = $pagesplit->pagecount;
                header("location: article.php?page=".$page);
            }
        }else{
            $page = 1;
            header("location: article.php?page=".$page);
        }
    }else{
        $page = 1;
        header("location: article.php?page=".$page);
    }
    $start = ($page-1)*$limit;
    $articles = $mysql->get("select * from `article` limit {$start},{$limit}");
}else{
    header("location: login.php");
    exit("请先登录");
}
?>

<html>
<head>
    <meta charset="utf-8"/>
    <title>博客管理页</title>
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
                <li>
                    <a href="index.php" title="管理员管理">
                        管理员管理 <span class="glyphicon glyphicon-user" ></span>
                    </a>
                </li>
                <li>
                    <a href="setting.php" title="全局设置">
                        全局设置 <span class="glyphicon glyphicon-cog"></span>
                    </a>
                </li>
                <li class="active">
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

<div class="col-md-1"></div>
<div class="container col-md-10">
    <div class="panel panel-success">
        <div class="panel-heading">
            管理员列表
            <a class='btn btn-danger btn-xs pull-right' href='add_article.php?action=add'>
                <span class="glyphicon glyphicon-plus"></span>添加
            </a>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive table-bordered table-striped">
                <thead>
                <tr class="bg-success">
                    <th>编号</th>
                    <th>标题</th>
                    <th>作者</th>
                    <th>时间</th>
                    <th>编辑</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($articles as $article){
                    echo "<tr>";
                    echo "<td>"."{$article['atid']}"."</td>";
                    echo "<td>"."{$article['title']}"."</td>";
                    echo "<td>"."{$article['author']}"."</td>";
                    echo "<td>".date("Y-m-d H:i:s",$article['lasttime'])." / ".date("Y-m-d H:i:s",$article['time'])."</td>";
                    echo "<td class='col-md-2'>";
                    echo "<a class='btn btn-primary btn-sm' href='update_article.php?atid={$article['atid']}&&page={$page}'><span class='glyphicon glyphicon-pencil'></span></a> ";
                    echo "<a class='btn btn-danger btn-sm' href='add_article.php?action=del&&atid={$article['atid']}&&page={$page}'><span class='glyphicon glyphicon-trash'></span></a>";
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