<?php
/**
 * Created by PhpStorm.
 * User: ph
 * Date: 2016/5/19
 * Time: 22:08
 */

namespace ph\MySql;

class MySql
{
    /**构造MySql对象
     * MySql constructor.
     * @param $db_name
     * @param string $host  数据库主机名
     * @param string $user  连接用户名
     * @param string $pass  连接密码
     */
    public function __construct($db_name, $host = "localhost:3306", $user = "root", $pass = "")
    {
        $this -> host       =     $host;
        $this -> user       =     $user;
        $this -> pass       =     $pass;
        $this -> db_name    =  $db_name;
        $this -> mysqli = new \mysqli($this->host, $this->user, $this->pass, $this->db_name);
        $this -> connect_error = $this->mysqli->connect_error;
    }

    /**根据sql语句获取多条记录
     * @param $query    sql选择语句
     * @return mixed    返回多条array型数组记录
     */
    public function gets($query){
        $result =  $this->mysqli->query($query);
        if(!empty($result)){
            return $result->fetch_all(MYSQLI_BOTH);
        }else{
            return array();
        }
    }

    /**根据表名和选择键值对获取一条记录
     * @param string $table 查询所在表明
     * @param string $key   选择键名
     * @param $value        选择键值
     * @return mixed        返回查询到的最多一条记录
     */
    public function get($table = "", $key = "", $value){
        $table  =   (string)$table;
        $key    =   (string)$key;
        $value  =   is_string($value)?'"'.$value.'"':$value;
        $result =   $this->gets("select * from `{$table}` where `{$key}`={$value}");
        if(empty($result)){
            return null;
        }else{
            return $result[0];
        }
    }

    /**在get的基础上添加选择标签flag,获取记录中指定字段值
     * @param string $table
     * @param $flag
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function get_value($table = "", $flag, $key = "", $value){
        $flag = (string)$flag;
        return $this->get($table,$key,$value)[$flag];
    }


    /**update,insert相关操作
     * @param $query
     * @return bool|\mysqli_result
     */
    public function puts($query/*update,insert,...*/){
        return $this->mysqli->query($query);
    }

    /**关闭数据库
     * @return bool
     */
    public function close(){
        return $this->mysqli->close();
    }
}