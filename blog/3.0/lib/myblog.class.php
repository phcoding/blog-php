<?php
/**
 * Created by PhpStorm.
 * User: ph
 * Date: 2016/5/29
 * Time: 22:49
 */

namespace ph\mysql\myblog;


use ph\mysql\mysql;

class myblog extends mysql
{
    public function __construct($dbname, $host = "localhost:3306", $user = "root", $pass = "ph1996")
    {
        parent::__construct($dbname, $host, $user, $pass);
    }

    public function gets($table="", $field="*", $sele=null)
    {
        $field = $field=="*"?$field:"`{$field}`";

        if(is_array($sele)){
            $selector = "";
            $count = 0;
            foreach ($sele as $key => $val) {
                $key = (string)$key;
                if(is_string($val)){
                    $val = "'".$val."'";
                }
                $selector .= ($count>0?"AND ":"")."`{$key}`=$val ";
                $count++;
            }
        }else{
            $selector = 1;
        }
        return parent::gets("SELECT {$field} FROM `{$table}` WHERE {$selector}");
    }

    public function get($table="", $field="*", $sele=null){
        $result = $this->gets($table,$field,$sele);
        if($result){
            return $result[0];
        }else{
            return null;
        }
    }

    public function insert($table="",$kvs){
        $table = (string)$table;
        $sets = "";
        $count = 0;
        foreach ($kvs as $key => $val) {
            $key = (string)$key;
            if(is_string($val)){
                $val = "'".$val."'";
            }
            $sets .= ($count>0?",":"")."`{$key}` = {$val}";
            $count++;
        }
        return $this->puts("INSERT INTO `{$table}` SET {$sets}");
    }

    public function update($table="",$kvs,$fkvs){
        $table = (string)$table;
        $sets = "";
        $sele = "";
        $count = 0;
        foreach ($kvs as $key => $val) {
            $key = (string)$key;
            if(is_string($val)){
                $val = "'".$val."'";
            }
            $sets .= ($count>0?",":"")."`{$key}` = {$val}";
            $count++;
        }
        $count = 0;
        foreach ($fkvs as $key => $val) {
            $key = (string)$key;
            if(is_string($val)){
                $val = "'".$val."'";
            }
            $sele .= ($count>0?",":"")."`{$key}` = {$val}";
            $count++;
        }
        return $this->puts("UPDATE `{$table}` SET {$sets} WHERE {$sele}");
    }

    public function delete($table="",$fkvs){
        $table = (string)$table;
        $sele = "";
        $count = 0;
        foreach ($fkvs as $key => $val) {
            $key = (string)$key;
            if(is_string($val)){
                $val = "'".$val."'";
            }
            $sele .= ($count>0?"AND":"")."`{$key}` = {$val} ";
            $count++;
        }
        return $this->puts("DELETE FROM `{$table}` WHERE {$sele}");
    }
}