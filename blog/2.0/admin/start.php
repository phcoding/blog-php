<?php
session_start();
include_once("../inc.php");
include_once(ROOT_PATH."/lib/MySql.class.php");
include_once (ROOT_PATH."/lib/mysql_blog.class.php");
include_once (ROOT_PATH."/lib/pagesplit.class.php");
include_once (ROOT_PATH."/lib/Input.class.php");
include_once (ROOT_PATH."/lib/functions.php");
$mysql = new \ph\mysql\mysql_blog("blog", "localhost:3306", "root", "ph1996");
$input = new \ph\Input\Input();