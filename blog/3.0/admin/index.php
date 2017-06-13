<?php
include_once "start_admin.php";
global $mysql,$input;

if($a_id = $input->session('a_id')){
    $admins = $mysql->gets("admin");
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
    <!-- header.php   -->
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/index.css">
    

    <title>管理员首页</title>
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
                    <li class="current"><a href="index.php">管理员</a></li>
                    <li><a href="config.php">全局设置</a></li>
                    <li><a href="article.php">博文管理</a></li>
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
                管理员管理
                <a class="btn btn-common btn-sm pull-right" data-toggle="modal" data-target="#myModal" data-set="{action:'add',a_name:'',a_pawd:'',title:'添加管理员',ro:''}">
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
                            <th class="col-md-5">用户名</th>
                            <th class="col-md-4">密码</th>
                            <th class="col-md-2">编辑</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="table-body">
                    <table class="table table-responsive table-bordered">
                        <tbody>
                        <?php
                        foreach ($admins as $num => $admin) {
                        ?>
                            <tr>
                                <td class="col-md-1"><?=$num+1?></td>
                                <td class="col-md-5"><?=$admin['a_name']?></td>
                                <td class="col-md-4"><?=$admin['a_pawd']?></td>
                                <td class="col-md-2">
                                    <?php
                                    if($a_id != $admin['a_id']) {
                                    ?>
                                        <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"
                                           data-set="{title:'确定删除以下管理员？',action:'del',a_id:<?= $admin['a_id'] ?>,a_name:'<?= $admin['a_name'] ?>',a_pawd:'<?= $admin['a_pawd'] ?>',ro:'readonly'}">
                                            &nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;
                                        </a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-set="{action:'mod',a_id:<?=$admin['a_id']?>,a_name:'<?=$admin['a_name']?>',a_pawd:'<?=$admin['a_pawd']?>',title:'修改管理员',ro:''}">
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
        <div class="modal-dialog" role="document">
            <form class="form-horizontal" action="" target="_self" method="post" data-get="[action]=action_admin.php?action=$action">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" data-get="[text]=$title"></h4>
                    </div>
                    <div class="modal-body">
                        <!--修改管理员ID-->
                        <input type="hidden" name="a_id" value="" data-get="[value]=$a_id;">
                        <div class="form-group">
                            <label for="aname" class="col-sm-2 control-label">用 户 名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="a_name" data-get="[value]=$a_name;[readonly]=$ro" id="a_name" value="" placeholder="请输入用户名" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="a_pawd" class="col-sm-2 control-label" data-get="[text]=$lable_apawd">新 密 码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="a_pawd" data-get="[value]=$a_pawd;[readonly]=$ro" id="a_pawd" value="" placeholder="请输入新密码" required="required">
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
    <script type="text/javascript" src="js/data-poster.js"></script>
</body>
</html>