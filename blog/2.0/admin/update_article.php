<?php
include_once("start.php");
global $mysql,$input;

if(($result = $input->sessions(['aid','aname'])) && ($atid = (int)$input->get('atid'))){
    $aid = (int)$result['aid'];
    $aname = $result["aname"];
    $page = $input->get('page',1);
    if($action = $input->get('action')){
        switch ($action) {
            case 'update':
                if($form = $input->posts(['title','author','content'],false)){
                    $title = $form['title'];
                    $author = $form['author'];
                    $lasttime = strtotime(date("Y-m-d H:i:s"));
                    $content =addslashes($form['content']);
                    $mysql->update_article($atid,$title,$author,$lasttime,trim($content));
                }
                header("location: article.php?page={$page}");
                exit();
                break;
            default:
                header("location: article.php?page={$page}");
                exit();
                break;
        }
    }else{
        $article = $mysql->get_article_byId($atid);
        $title = $article['title'];
        $author = $article['author'];
        $content =htmlspecialchars($article['content']);
    }
}else{
    header("location: login.php");
    exit("重新登录");
}
?>

<html>
<head>
    <meta charset="utf-8"/>
    <title>博客管理 | 更新博客</title>
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
            <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span></a>
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
<div class="col-md-1">

</div>
<div class="container col-md-10">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                添加博客
                <a class='btn btn-default btn-xs pull-right' href='article.php?page=<?php echo $page;?>'>
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    返回
                </a>
            </h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="update_article.php?action=update&&atid=<?php echo $atid;?>&page=<?php echo $page;?>" method="post">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">标题</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="标题" value="<?php echo $title;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="author" class="col-sm-2 control-label">作者</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="author" id="author" placeholder="作者" value="<?php echo $author;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-sm-2 control-label">正文</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="content" id="content" placeholder="正文" rows="10" required><?php echo $content;?></textarea>
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
<script type="text/javascript">
    $(function(){
        var tools = [
            'title',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'fontScale',
            'color',
            'ol',
            'ul',
            'blockquote',
            'code',
            'table',
            'link',
            'image',
            'hr',
            'indent',
            'outdent',
            'alignment'
        ]
        var editor = new Simditor({
            textarea: $('#content'),
            tabIndent:false,
            upload:true,
            pasteImage:true,
            toolbar:tools
        });
    });
</script>
</body>
</html>