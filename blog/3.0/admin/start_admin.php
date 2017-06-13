<?php
/**
 * 管理员启动脚本
 */

use ph\input\input;
use ph\mysql\myblog\myblog;

session_start();
include_once "../env.inc";
include_once PATH_LIB."functions.php";
include_once PATH_LIB."input.class.php";
include_once PATH_LIB."mysql.class.php";
include_once PATH_LIB ."myblog.class.php";
include_once PATH_LIB."pagesplit.class.php";

$input = new input();
$mysql = new myblog("blog3.0");
