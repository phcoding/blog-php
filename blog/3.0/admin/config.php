<?php
include_once "start_admin.php";
global $mysql,$input;

if($a_id = $input->session('a_id')){
    $configs = $mysql->gets("config");
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
    <link rel="stylesheet" href="css/config.css">
    <!-- header.php   -->
    <title>全局设置</title>
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
                <li class="current"><a href="config.php">全局设置</a></li>
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
            全局设置
            <a class="btn btn-common btn-sm pull-right" data-toggle="modal" data-target="#myModal" data-set="{action:'add',c_name:'',c_value:'',c_type:'',c_desc:'',ro_name:'',ro_type:'',ro_value:'',ro_desc:'',title:'添加配置'}">
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
                        <th class="col-md-2">配置名</th>
                        <th class="col-md-2">类型</th>
                        <th class="col-md-2">取值</th>
                        <th class="col-md-3">说明</th>
                        <th class="col-md-2">编辑</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="table-body">
                <table class="table table-responsive table-bordered">
                    <tbody>
                    <?php
                    foreach ($configs as $num => $config) {
                    ?>
                    <tr>
                        <td class="col-md-1"><?=$num+1?></td>
                        <td class="col-md-2"><?=$config['c_name']?></td>
                        <td class="col-md-2"><?=$config['c_type']?></td>
                        <td class="col-md-2"><?=$config['c_value']?></td>
                        <td class="col-md-3"><?=$config['c_desc']?></td>
                        <td class="col-md-2">
                            <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-set="{c_id:<?=$config['c_id']?>,c_name:'<?=$config['c_name']?>',c_type:'<?=$config['c_type']?>',c_value:'<?=$config['c_value']?>',c_desc:'<?=$config['c_desc']?>',ro_name:'readonly',ro_type:'readonly',ro_value:'readonly',ro_desc:'readonly',action:'del',title:'确定删除以下配置？'}">
                                &nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;
                            </a>
                            <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-set="{c_id:<?=$config['c_id']?>,c_name:'<?=$config['c_name']?>',c_type:'<?=$config['c_type']?>',c_value:'<?=$config['c_value']?>',c_desc:'<?=$config['c_desc']?>',ro_name:'readonly',ro_type:'readonly',ro_value:'',ro_desc:'',action:'mod',title:'修改配置'}">
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
        <form class="form-horizontal" action="" target="_self" method="post" data-get="[action]=action_config.php?action=$action">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" data-get="[text]=$title"></h4>
                </div>
                <div class="modal-body">
                    <!--修改管理员ID-->
                    <input type="hidden" name="c_id" value="" data-get="[value]=$c_id">
                    <div class="form-group">
                        <label for="c_name" class="col-sm-2 control-label">配 置 名 称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="c_name" data-get="[value]=$c_name;[readonly]=$ro_name" id="c_name" value="" placeholder="请输入配置名" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="c_type" class="col-sm-2 control-label">配 置 类 型</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="c_type" data-get="[value]=$c_type;[readonly]=$ro_type" id="c_type" value="" placeholder="请输入配置名" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="c_value" class="col-sm-2 control-label">配 置 取 值</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="c_value" data-get="[value]=$c_value;[readonly]=$ro_value" id="c_value" value="" placeholder="请输入配置值" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="c_desc" class="col-sm-2 control-label">配 置 说 明</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="c_desc" data-get="[text]=$c_desc;[readonly]=$ro_desc" id="c_desc" placeholder="请输入配置说明" required="required"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="submit" class="btn btn-primary" value="确定">
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="js/data-poster.js"></script>
</body>
</html>