<?php
include_once "start_admin.php";
global $mysql,$input;

if($a_id = $input->session('a_id')){
    $articles = $mysql->gets("article");
}else{
    header("location: ".URL_PUBLIC."loginwarming/");
    return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- header.php   -->
    <?php include_once PATH_PUBLIC."header/header.php"?>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/article.css">
    <!-- header.php   -->
    <title>博文管理</title>
</head>
<body>
<!--导航条开始-->
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
                <li><a href="index.php">管理员</a></li>
                <li><a href="config.php">全局设置</a></li>
                <li class="current"><a href="article.php">博文管理</a></li>
                <li><a href="#">关于</a></li>
                <li class="navbar-right">
                    <a href="login.php?action=logout" title="管理员登出">
                        <span class="glyphicon glyphicon-log-out btn-lg"></span>
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--导航条结束-->

<!--主体内容开始-->
<div class="col-md-2"></div>
<div class="container col-md-8">
    <div class="panel panel-chart">
        <div class="panel-heading">
            博文管理
            <a class="btn btn-common btn-sm pull-right" data-toggle="modal" data-target="#myModal" data-set="{action:'add',at_title:'',at_auth:'',at_cont:'',title:'添加博文',ro_title:'',ro_auth:'',ro_cont:''}">
                <span class="glyphicon glyphicon-plus"></span>
                添加
            </a>
        </div>
        <div class="panel-body">
            <div class="table-head">
                <table class="table table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th class="col-md-1">编号</th>
                        <th class="col-md-3">标题</th>
                        <th class="col-md-2">作者</th>
                        <th class="col-md-4">日期</th>
                        <th class="col-md-2">编辑</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="table-body">
                <table class="table table-responsive table-bordered">
                    <tbody>
                    <?php
                    foreach ($articles as $num => $article) {
                    ?>
                    <tr>
                        <td class="col-md-1"><?=$num+1?></td>
                        <td class="col-md-3"><?=$article['at_title']?></td>
                        <td class="col-md-2"><?=$article['at_auth']?></td>
                        <td class="col-md-4"><?=date("Y-m-d H:i:s",$article['at_date'])?></td>
                        <td class="col-md-2">
                            <a class="btn btn-danger btn-xs btn-cont" data-toggle="modal" data-target="#myModal" data-set="{action:'del',at_id:<?=$article['at_id']?>,at_title:'<?=$article['at_title']?>',at_auth:'<?=$article['at_auth']?>',title:'确认删除下列博文？',ro_title:'readonly',ro_auth:'readonly',ro_cont:'readonly'}">
                                &nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;
                            </a>
                            <a class="btn btn-primary btn-xs btn-cont" data-toggle="modal" data-target="#myModal" data-set="{action:'mod',at_id:<?=$article['at_id']?>,at_title:'<?=$article['at_title']?>',at_auth:'<?=$article['at_auth']?>',title:'修改博文',ro_title:'',ro_auth:'',ro_cont:''}">
                                &nbsp;<span class="glyphicon glyphicon-edit"></span>&nbsp;
                            </a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer">
            111
        </div>
    </div>
</div>
<!--主体内容结束-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <form class="form-horizontal" action="" target="_self" method="post" data-get="[action]=action_article.php?action=$action">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" data-get="[text]=$title"></h4>
                </div>
                <div class="modal-body">
                    <!--修改管理员ID-->
                    <input type="hidden" name="at_id" value="" data-get="[value]=$at_id">
                    <div class="form-group">
                        <label for="at_title" class="col-sm-2 control-label">标 题</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="at_title" data-get="[value]=$at_title;[readonly]=$ro_title" id="at_title" value="" placeholder="请输入标题" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="at_auth" class="col-sm-2 control-label">作 者</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="at_auth" data-get="[value]=$at_auth;[readonly]=$ro_auth" id="at_auth" value="" placeholder="请输入作者" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text" class="col-sm-2 control-label">正 文</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="at_cont" data-get="[readonly]=$ro_cont;[simditor:text]=$at_cont" id="text" required="required"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="submit" class="btn btn-primary" value="确认">
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="../js/eidtor.js"></script>
<script type="text/javascript" src="js/data-poster.js"></script>
<script type="text/javascript">
//    动态获取文章内容并展示到编辑器
$(".btn-cont").click(function(e){
    var map = eval("("+$(this).attr('data-set')+")");
    $.ajax({
        url:"action_article.php?action=get",
        type:"post",
        data:{
            at_id:map['at_id']
        },
        success:function(data){
//            console.log(data);
            window['editor'].setValue(data);
        }
    });
});
</script>
</body>
</html>