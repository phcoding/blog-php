<?php
include_once "start_admin.php";
global $mysql,$input;

if($sess = $input->session('a_id')){
    if($action = $input->get('action')){

        //  添加博文
        if($action == 'add'){
            if($form = $input->posts(['at_title','at_auth','at_cont'],false)){
                $form['at_date'] = strtotime(date("Y-m-d H:i:s"));
                $form['at_cont'] = addslashes($form['at_cont']);
                $mysql->insert("article",$form);
            }
        }

        //  修改博文
        else if($action == 'mod'){
            if($form = $input->posts(['at_id','at_title','at_auth','at_cont'],false)){
                $form['at_cont'] = addslashes($form['at_cont']);
                $mysql->update("article",array_clip($form,['at_title','at_auth','at_cont']),array_clip($form,['at_id']));
            }
        }

        //  删除博文
        else if($action == 'del'){
            if($form = $input->posts(['at_id'])){
                $mysql->delete("article",$form);
            }
        }

        //  获取博文
        else if($action == 'get'){
            if($form = $input->posts(['at_id'])){
                if($content = $mysql->get("article",'at_cont',$form,false)){
                    exit("{$content['at_cont']}");
                }else{
                    exit("");
                }
            }
        }
        else{

        }
    }
    header("location: article.php");
}else{
    header("location: login.php");
}