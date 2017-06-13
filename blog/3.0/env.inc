
<?php
/**
 * 定义全局环境
 */

//定义磁盘路径
define("PATH_ROOT", dirname(__FILE__)."/");
define("PATH_PUBLIC", PATH_ROOT."public/");
define("PATH_LIB", PATH_ROOT."/lib/");

//定义URL路径
define("URL_ROOT", "http://localhost/ph/blog/3.0/");
define("URL_ADMIN",URL_ROOT."admin/");
define("URL_PUBLIC", URL_ROOT."public/");

//定义数据库常量
define("DB_NAME","blog");
define("DB_HOST","localhost:3306");
define("DB_USER","root");
define("DB_PAWD","");