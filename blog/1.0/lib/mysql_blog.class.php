<?php
/**
 * Created by PhpStorm.
 * User: ph
 * Date: 2016/5/19
 * Time: 22:48
 */

namespace ph\mysql;


class mysql_blog extends mysql
{
    /**增加管理员
     * @param $aname
     * @param $apass
     * @return bool|\mysqli_result
     */
    public function add_admin($aname,$apass){
        return $this->mysql->query("insert into `admins` (`aname`,`apass`) values ('{$aname}','{$apass}')");
    }

    /**更新管理员信息
     * @param $value
     * @param $npass
     * @param string $key
     * @return bool|\mysqli_result
     */
    public function update_admin($value,$npass,$key="aid"){
        if(is_string($value)){
            $value = "'".$value."'";
        }
        return $this->mysql->query("update `admins` set `apass`='{$npass}' where `{$key}`={$value}");
    }

    /**删除管理员
     * @param $value
     * @param string $key
     * @return bool|\mysqli_result
     */
    public function del_admin($value, $key="aid"){
        $query = "delete from `admins` where `{$key}`={$value}";
        return $this->mysql->query($query);
    }

    /**
     * 显示数据表所有数据
     */
    public function show_all(){
        print_r($this->mysql->query("select * from `admins`")->fetch_all());
    }

    /**添加博客
     * @param $title
     * @param $author
     * @param $time
     * @param $content
     * @return bool|\mysqli_result
     */
    public function add_article($title,$author,$time,$content){
        return $this->mysql->query("insert into `article` (`title`,`author`,`time`,`lasttime`,`content`) values ('{$title}','{$author}',{$time},{$time},'{$content}')");
    }

    /**通过文章id获取文章数据
     * @param $atid
     * @return null
     */
    public function get_article_byId($atid){
        $atid = (int)$atid;
        $result = $this->get("select * from `article` where `atid`={$atid}");
        if(!empty($result)){
            return $result[0];
        }else{
            return null;
        }
    }

    /**删除博客
     * @param $value
     * @param string $key
     * @return bool|\mysqli_result
     */
    public function del_article($value,$key="atid"){
        $query = "delete from `article` where `{$key}`={$value}";
        return $this->mysql->query($query);
    }

    /**更新博客
     * @param $value
     * @param $n_title
     * @param $n_author
     * @param $n_time
     * @param $n_content
     * @param string $key
     * @return bool|\mysqli_result
     */
    public function update_article($value,$n_title,$n_author,$n_time,$n_content,$key="atid"){
        if(is_string($value)){
            $value = "'".$value."'";
        }
        return $this->mysql->query("update `article` set `title`='{$n_title}',`author`='{$n_author}',`lasttime`={$n_time},`content`='{$n_content}' where `{$key}`={$value}");
    }

    public function getArticlesCount(){
        return count($this->get("select * from `article`"));
    }

    /**更新博客
     * @param $value
     * @param $n_title
     * @param $n_author
     * @param $n_time
     * @param $n_content
     * @param string $key
     * @return bool|\mysqli_result
     */
    public function update_setting($value,$n_conf_value,$n_conf_inst,$key="sname"){
        return ($this->mysql->query("update `setting_conf` set `{$value}`='{$n_conf_value}'") && $this->mysql->query("update `setting_inst` set `instruction`='{$n_conf_inst}' where `{$key}`='{$value}'"));
    }


    public function getConfigValueByName($sname){
        $result = $this->get("select `{$sname}` from `setting_conf`")[0];
        return $result[$sname];
    }
}