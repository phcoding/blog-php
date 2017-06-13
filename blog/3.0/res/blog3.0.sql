CREATE TABLE `user` (
`u_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户ID',
`u_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户登录名',
`u_pawd` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户登录密码',
`u_time` int(12) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户注册时间',
PRIMARY KEY (`u_id`) 
)
COMMENT='用户信息表';

CREATE TABLE `admin` (
`a_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
`a_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '管理员登录名称',
`a_pawd` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '管理员登录密码',
PRIMARY KEY (`a_id`) 
)
COMMENT='管理员信息表';

CREATE TABLE `article` (
`at_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '文章ID',
`at_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章标题',
`at_auth` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章作者',
`at_date` int(12) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文章创建时间',
`at_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章简介',
`at_cont` varchar(20000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章内容',
PRIMARY KEY (`at_id`) 
)
COMMENT='文章数据表';

CREATE TABLE `config` (
`c_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置项ID',
`c_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配置项名称',
`c_value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配置项取值',
`c_type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'string' COMMENT '配置数据类型',
`c_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配置项描述',
PRIMARY KEY (`c_id`) 
)
COMMENT='配置信息表';

CREATE TABLE `comment` (
`co_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主贴ID',
`at_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '关联文章ID',
`co_nick` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '发帖昵称',
`co_to` int(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '要评论的ID,默认0则为新帖',
`co_time` int(12) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论时间',
`co_cont` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '评论类容',
PRIMARY KEY (`co_id`) 
);

