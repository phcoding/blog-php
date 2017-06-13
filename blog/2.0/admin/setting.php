<?php
include_once("start.php");
global $mysql,$input;
if(!($result = $input->sessions(['aid','aname']))){
    header("location: login.php");
    exit("请先登录");
}else{
    $aid = (int)$result['aid'];
    $aname = $result['aname'];
    $instructions = $mysql->gets("select * from `setting_inst`");
    $config = $mysql->gets("select * from `setting_conf`")[0];
}
?>

<html>
<head>
    <meta charset="utf-8"/>
    <title>全局设置页</title>
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
                <li class="active">
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
    <div class="panel panel-primary">
        <div class="panel-heading">
            配置项列表
            <a class='btn btn-danger btn-xs pull-right' href='add_setting.php?action=add'>
                <span class="glyphicon glyphicon-plus"></span>添加
            </a>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive table-bordered table-striped" style="word-break: break-all">
                <thead>
                <tr class="bg-info">
                    <th>配置项</th>
                    <th>配置值</th>
                    <th>配置说明</th>
                    <th>编辑</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($instructions as $instruction){
                    echo "<tr>";
                    echo "<td>"."{$instruction['sname']}"."</td>";
                    echo "<td>"."{$config[$instruction['sname']]}"."</td>";
                    echo "<td>"."{$instruction['instruction']}"."</td>";
                    echo "<td class='col-md-2'>";
                    echo "<a class='btn btn-primary btn-sm' href='update_setting.php?sname={$instruction['sname']}'><span class='glyphicon glyphicon-pencil'></span></a> ";
                    echo "</td>";
                    echo "<tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>