<?php
include_once "start_admin.php";
global $mysql,$input;

if($action = $input->get('action')){
    if($action == "login"){
        if($form = $input->posts(['a_name','a_pawd'])){
            $a_name = $form['a_name'];
            $a_pawd = $form['a_pawd'];
            if($adm = $mysql->get("admin","a_id",['a_name'=>$a_name,'a_pawd'=>$a_pawd])){
                $input->session_set('a_id',$adm['a_id']);
                echo "({typecode:200})";
            }else{
                if($mysql->get("admin","*",['a_name'=>$a_name])){
                    echo "({typecode:199})";
                }else{
                    echo "({typecode:400})";
                }
            }
        }
    }
    else if($action == "logout"){
        $input->session_set('a_id');
        header("location: login.php");
    }else{

    }
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="../public/bootstrap-3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/common.css"/>
    <link rel="stylesheet" href="css/common.css"/>
    <link rel="stylesheet" href="css/login.css">
    <script type="text/javascript" src="../public/simditor-2.3.6/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="../public/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <title>管理员登录</title>
</head>
<body>
<div class="main">
    <div class="col-md-2"></div>
    <div class="container col-md-8">
        <div class="panel panel-form">
            <div class="panel-heading">
                管理员登录
            </div>
            <div class="panel-body">
                <form class="form-horizontal" name="form" action="login.php?action=login" method="post">
                    <div class="form-group">
                        <label for="a_name" class="col-sm-2 control-label">用 户 名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="a_name" id="a_name" placeholder="用户名" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="a_pawd" class="col-sm-2 control-label">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="a_pawd" id="a_pawd" placeholder="密码" required="required">
                        </div>
                    </div>
                    <!--<div class="form-group">-->
                        <!--<div class="col-sm-offset-2 col-sm-10">-->
                            <!--<div class="checkbox">-->
                                <!--<label>-->
                                    <!--<input type="checkbox"> Remember me-->
                                <!--</label>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-common" id="submit" value="登 录">
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer" id="footer">
                状态：<span style="color: orange;">就绪</span>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<script type="text/javascript">
    $("#submit").click(function(e){
        e.preventDefault();
        var form = document.form;
        $.ajax({
            url:"login.php?action=login",
            type:"post",
            data:{
                a_name:form.a_name.value,
                a_pawd:form.a_pawd.value
            },
            success:function(e){
                e = eval(e);
                console.log(e);
                if(e.typecode===400){
                    $("#footer").html("状态："+"<span style='color:#F76969;'>用户名不存在！</span>");
                }
                else if(e.typecode===199){
                    $("#footer").html("状态："+"<span style='color:#F76969;'>密码错误！</span>");
                }
                else{
                    $("#footer").html("状态："+"<span style='color:#48B348;'>登录成功！</span>");
//                  $("head").append("<meta http-equiv='refresh' content='0.5;url=index.php'>");
                    window.location.href = "index.php";
                }
            }
        });
    });
</script>
</body>
</html>