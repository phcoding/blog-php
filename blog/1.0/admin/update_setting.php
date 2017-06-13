<?php
include("start.php");
if(isset($_SESSION['aid']) && isset($_SESSION["aname"]) && $_GET['sname']){
    $aid = (int)$_SESSION['aid'];
    $aname = $_SESSION["aname"];
    $sname = $_GET['sname'];
    $pagetitle = "修改配置";
    if(isset($_GET['action'])){
        switch ($_GET['action']) {
            case 'update':
                if(isset($_POST['conf_name']) && isset($_POST['conf_value']) && isset($_POST['conf_inst'])){
                    $conf_name = (string)$_POST['conf_name'];
                    $conf_value = $_POST['conf_value'];
                    $conf_inst = (string)$_POST['conf_inst'];
                    $mysql->update_setting($conf_name,$conf_value,$conf_inst);
                }
                header("location: setting.php");
                exit();
                break;
        }
    }else{
        $instructions = $mysql->get("select * from `setting_inst` where `sname`='{$sname}'");
        $instruction = $instructions[0]['instruction'];

        $config = $mysql->get("select * from `setting_conf`")[0];
        $conf_value = $config[$sname];

    }
}else{
    header("location: login.php");
    exit("重新登录");
}
?>

<html>
<head>
    <meta charset="utf-8"/>
    <title>全局设置 | <?php echo $pagetitle;?></title>
    <?php include(PUBLIC_PATH."/header.php");?>
    <?php include(PUBLIC_PATH."/simditor_header.php");?>
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
<div class="col-md-1">

</div>
<div class="container col-md-10">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                添加博客
                <a class='btn btn-default btn-xs pull-right' href='setting.php'>
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    返回
                </a>
            </h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="update_setting.php?action=update&&sname=<?php echo $sname;?>" method="post">
                <div class="form-group">
                    <label for="conf_name" class="col-sm-2 control-label">配置项</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="conf_name" name="conf_name" placeholder="配置项" value="<?php echo $sname;?>" required="required" readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <label for="conf_value" class="col-sm-2 control-label">配置值</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="conf_value" id="conf_value" placeholder="配置值" value="<?php echo $conf_value;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="conf_inst" class="col-sm-2 control-label">配置说明</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="conf_inst" id="conf_inst" placeholder="配置说明" rows="10" required><?php echo $instruction;?></textarea>
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