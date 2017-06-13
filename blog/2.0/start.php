<?php
/**
 * Created by PhpStorm.
 * User: ph
 * Date: 2016/5/23
 * Time: 20:44
 */
include_once("inc.php");
include_once(ROOT_PATH."/lib/MySql.class.php");
include_once (ROOT_PATH."/lib/mysql_blog.class.php");
include_once (ROOT_PATH."/lib/pagesplit.class.php");
include_once (ROOT_PATH."/lib/Input.class.php");
include_once (ROOT_PATH."/lib/functions.php");
$mysql = new \ph\mysql\mysql_blog("blog", "localhost:3306", "root", "ph1996");
$input = new \ph\Input\Input();