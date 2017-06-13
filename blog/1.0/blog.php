<?php
/**
 * Created by PhpStorm.
 * User: ph
 * Date: 2016/5/21
 * Time: 10:21
 */
include ("inc.php");
include(ROOT_PATH."/lib/mysql.class.php");
include (ROOT_PATH."/lib/mysql_blog.class.php");
$mysql = new \ph\mysql\mysql_blog("localhost:3306","root","ph1996","blog");

if(isset($_GET['atid'])){
    $atid = (int)$_GET['atid'];
    $page = isset($_GET['page'])?(int)$_GET['page']:1;
    $article = $mysql->get_article_byId($atid);
    $articles = $mysql->get("select * from `article`");
    if(!$article){
        header("location: index.php");
    }
}else{
    header("location: index.php");
}
?>

<html>
<head>
    <meta charset="utf-8"/>
    <title>博文 | <?php echo $article['title'];?></title>
    <?php include(PUBLIC_PATH."/header.php");?>
    <style type="text/css">
        @media only screen and (max-width: 540px) {
            .auto-hidden{
                display: none;
            }
            .auto-show{
                display: auto;
            }
        }
        @media only screen and (min-width: 541px) {
            .auto-hidden{
                display: auto;
            }
            .auto-show{
                display: none;
            }
        }
    </style>
</head>
<body style="background-image: url('img/bg2.jpg');background-size: cover;background-repeat: no-repeat;">
<div class="jumbotron" style="background-color:rgba(250,250,250,0.8);">
    <h2><a class="pull-right" href="admin/index.php"><span class="glyphicon glyphicon-log-in" style="margin-top: -50px;margin-right: 20px;"></span></a></h2>
    <h1><?php echo $mysql->getConfigValueByName("APP_NAME");?></h1>
    <p>天将降大任于斯人也，必先苦其心志！</p>
</div>
<div class="col-md-1"></div>
<div class="container col-md-10">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <a href="index.php?page=<?php echo $page;?>" style="color: #eee;">博客文章栏</a>
        </div>
        <div class="panel-footer">博客总数：<?php echo count($articles);?></div>
    </div>
<!--    <div class="panel panel-success">-->
<!--        <div class="panel-heading table-responsive">-->
<!--            --><?php //echo $article['title'];?>
<!--            <span class='pull-right small'><span class='glyphicon glyphicon-user'></span> --><?php //echo $article['author'];?><!-- <span class="auto-hidden"><span class='glyphicon glyphicon-calendar'></span> --><?php //echo date("Y-m-d/H:i:s",$article['time']);?><!--</span></span>-->
<!--        </div>-->
<!--        <div class="panel-body">-->
<!--            --><?php //echo $article['content'];?>
<!--        </div>-->
<!--        <div class="panel-footer text-right">-->
<!--            --><?php //echo "<span class='small auto-show' style='color: #888;'><span class='glyphicon glyphicon-calendar'></span> ".date("Y-m-d / H:i:s",$article['time'])."</span>";?>
<!--        </div>-->
<!--    </div>-->
    <div class="panel panel-success">
        <div class="panel-body">
            <div class="page-header bg-default">
                <h3><?php echo $article['title'];?> <small><span class='glyphicon glyphicon-user'></span> <?php echo $article['author'];?></small><small class="pull-right auto-hidden"><span class='glyphicon glyphicon-calendar'></span> <?php echo date("Y-m-d/H:i:s",$article['time']);?></small></h3>
            </div>
            <?php echo $article['content'];?>
        </div>
        <div class="panel-footer text-right">
            <?php echo "<span class='small auto-show' style='color: #888;'><span class='glyphicon glyphicon-calendar'></span> ".date("Y-m-d / H:i:s",$article['time'])."</span>";?>
        </div>
    </div>
</div>
<div class="col-md-1"></div>

<div class="container col-md-12" style="background-color: rgba(250,250,250,0.6);">
    <div class="col-md-1"></div>
    <div class="panel panel-success col-md-10">
        <div class="panel-body">
            <p><h4 style="color: #aaa;">评论区</h4></p>
            <hr>
            <ul style="list-style-type: none;padding: 0;">
                <li>
                    <p>头</p>
                    <p>
                        内容内容内容内容内容
                    </p>
                    <hr>
                </li>
                <li>
                    <p>头</p>
                    <p>内容</p>
                    <hr>
                </li>
                <li>
                    <p>头</p>
                    <p>内容</p>
                    <hr>
                </li>
            </ul>
            <form class="form-horizontal" action="add_article.php?action=add&&page=" method="post">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">昵称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" maxlength="24" placeholder="标题(长度不超过48个字节)" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-sm-2 control-label">正文</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="content" id="content" placeholder="正文"  required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="author" class="col-sm-2 control-label">验证码</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="author" id="author" placeholder="作者(长度不超过24字节)" value="" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
</body>
</html>
