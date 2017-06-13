<?php
session_start();
include("../inc.php");
include(ROOT_PATH."/lib/mysql.class.php");
include (ROOT_PATH."/lib/mysql_blog.class.php");
include (ROOT_PATH."/lib/pagesplit.class.php");
$mysql = new \ph\mysql\mysql_blog("localhost:3306","root","ph1996","blog");
?>