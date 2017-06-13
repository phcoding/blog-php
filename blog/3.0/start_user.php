<?php
/**用户启动文件
 * Created by PhpStorm.
 * User: ph
 * Date: 2016/5/28
 * Time: 15:16
 */

use ph\input\input;
use ph\mysql\myblog\myblog;

include_once "env.inc";
include_once PATH_LIB."functions.php";
include_once PATH_LIB."mysql.class.php";
include_once PATH_LIB."myblog.class.php";
include_once PATH_LIB."input.class.php";
include_once PATH_LIB."pagesplit.class.php";

$mysql = new myblog("blog3.0");
$input = new input();
