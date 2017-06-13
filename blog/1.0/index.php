<?php
include ("inc.php");
include(ROOT_PATH."/lib/mysql.class.php");
include (ROOT_PATH."/lib/mysql_blog.class.php");
include (ROOT_PATH."/lib/pagesplit.class.php");
$mysql = new \ph\mysql\mysql_blog("localhost:3306","root","ph1996","blog");
$articles = $mysql->get("select * from `article`");
$limit = (int)$mysql->getConfigValueByName("USER_LIMIT_ARTICLE");//配置项
$total = count($articles);
$pagesplit = new \ph\mysql\pagesplit($total,$limit,"index.php");
if(isset($_GET['page'])){
    $page = (int)$_GET['page'];
    if($pagesplit->pagecount>0){
        if($page<1){
            $page = 1;
            header("location: index.php?page=".$page);
        }
        if($page>$pagesplit->pagecount){
            $page = $pagesplit->pagecount;
            header("location: index.php?page=".$page);
        }
        //唯一条件入口
    }else{
        $page = 1;
        header("location: index.php?page=".$page);
    }
}else{
    $page = 1;
    header("location: index.php?page=".$page);
}
$start = ($page-1)*$limit;
$articles = $mysql->get("select * from `article` limit {$start},{$limit}");
?>
<html>
<head>
    <meta charset="utf-8"/>
    <title>博客首页</title>
    <?php include(PUBLIC_PATH."/header.php");?>
    <style type="text/css">
        @media only screen and (max-width: 400px) {
            span.auto-change{
                display: none;
            }
        }
        @media only screen and (min-width: 401px) {
            span.auto-change{
                display: auto;
            }
        }
    </style>
</head>
<body style="background-image: url('img/bg1.jpg');background-size: cover;background-repeat: no-repeat;">
    <div class="jumbotron" style="background-color:rgba(250,250,250,0.8);color: #222;text-shadow: 1px 1px 1px #666;">
        <h2><a class="pull-right" href="admin/index.php"><span class="glyphicon glyphicon-log-in" style="margin-top: -50px;margin-right: 20px;"></span></a></h2>
        <h1><?php echo $mysql->getConfigValueByName("APP_NAME");?></h1>
        <p>天将降大任于斯人也，必先苦其心志！</p>
    </div>
    <div class="col-md-2"></div>
    <div class="container col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a href="index.php" style="color: #eee;">博客文章栏</a>
            </div>
            <div class="panel-footer">博客总数：<?php echo $total;?></div>
        </div>
        <!-- 展示博客列表 -->
        <?php
        foreach ($articles as $article) {
            echo "<div class='panel panel-success'>";
            echo "<div class='panel-heading  table-responsive'>";
            echo "<a href='blog.php?atid={$article['atid']}&&page={$page}'>{$article['title']}</a>";
            echo "<span class='pull-right small'><span class='glyphicon glyphicon-user'></span> ".$article['author']." <span class='auto-change'><span class='glyphicon glyphicon-calendar'></span> ".date("Y-m-d/H:i:s",$article['time'])."</span></span>";
            echo "</div>";
            echo "<div class='panel-body'>";
            echo substr(strip_tags($article['content']),0, 160)."...";
            echo "</div>";
            echo "</div>";
        }
        ?>
        <!-- 创建分页 -->
        <?php $pagesplit->create($page);?>
    </div>

    <div class="container col-md-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                挂件区
            </div>
            <div class="panel-footer">Panel footer</div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                挂件一
            </div>
            <div class="panel-body">
                body
            </div>
        </div>
    </div>
</body>
</html>

