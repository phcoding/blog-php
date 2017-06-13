<?php
/**
 * Created by PhpStorm.
 * User: ph
 * Date: 2016/5/19
 * Time: 22:08
 */

namespace ph\mysql;


class mysql
{
   public function __construct($host,$username,$pass,$dbname)
    {
        $this->host = $host;
        $this->username = $username;
        $this->pass = $pass;
        $this->dbname = $dbname;
        $this->mysql = new \mysqli($host,$username,$pass,$dbname);
    }

    public function get($query){
        $result = $this->mysql->query($query);
        return $result->fetch_all(MYSQLI_BOTH);
    }

    public function update($query){
        return $this->mysql->query($query);
    }
}