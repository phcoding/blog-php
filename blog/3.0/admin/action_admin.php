<?php
include_once "start_admin.php";
global $mysql,$input;

if($sess = $input->session('a_id')){
    if($action = $input->get('action')){
        if($action == 'add'){
            if($form = $input->posts(['a_name','a_pawd'])){
                $mysql->insert("admin",$form);
                header("location: index.php");
            }
        }
        else if($action == 'mod'){
            if($form = $input->posts(['a_id','a_name','a_pawd'])){
                $mysql->update("admin",['a_name'=>$form['a_name'],'a_pawd'=>$form['a_pawd']],['a_id'=>$form['a_id']]);
                header("location: index.php");
            }
        }
        else if($action == 'del'){
            if($form = $input->posts(['a_id'])){
                $mysql->delete("admin",$form);
                header("location: index.php");
            }
        }
        else{

        }
    }
    header("location: index.php");
}