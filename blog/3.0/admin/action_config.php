<?php
include_once "start_admin.php";
global $mysql,$input;

if($sess = $input->session('a_id')){
    if($action = $input->get('action')){
        if($action == 'add'){
            if($form = $input->posts(['c_name','c_type','c_value','c_desc'])){
                $mysql->insert("config",$form);
            }
        }
        else if($action == 'mod'){
            if($form = $input->posts(['c_id','c_name','c_type','c_value','c_desc'])){
                $mysql->update("config",['c_value'=>$form['c_value'],'c_desc'=>$form['c_desc']],['c_id'=>$form['c_id']]);
            }
        }
        else if($action == 'del'){
            if($form = $input->posts(['c_id'])){
                $mysql->delete("config",$form);
            }
        }
        else{

        }
    }
    header("location: config.php");
}else{
    header("location: login.php");
}