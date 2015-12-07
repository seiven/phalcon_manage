-- --------------------------------------------------------
-- 主机:                           10.10.20.202
-- 服务器版本:                        5.5.46-cll-lve - MySQL Community Server (GPL) by Atomicorp
-- 服务器操作系统:                      Linux
-- HeidiSQL 版本:                  9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出  表 customer_skymoons_com.cu_admin_group 结构
DROP TABLE IF EXISTS `cu_admin_group`;
CREATE TABLE IF NOT EXISTS `cu_admin_group` (
  `gid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(6) unsigned NOT NULL DEFAULT '0',
  `gname` varchar(30) DEFAULT NULL COMMENT '用户组名称',
  `rightList` text COMMENT '权限列表',
  `product_list` text COMMENT '产品权限列表',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='管理员分组';

-- 正在导出表  customer_skymoons_com.cu_admin_group 的数据：1 rows
/*!40000 ALTER TABLE `cu_admin_group` DISABLE KEYS */;
REPLACE INTO `cu_admin_group` (`gid`, `parent_id`, `gname`, `rightList`, `product_list`) VALUES
	(1, 0, '超级管理员', '67,76,78', NULL);
/*!40000 ALTER TABLE `cu_admin_group` ENABLE KEYS */;


-- 导出  表 customer_skymoons_com.cu_admin_rights 结构
DROP TABLE IF EXISTS `cu_admin_rights`;
CREATE TABLE IF NOT EXISTS `cu_admin_rights` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) DEFAULT NULL COMMENT '权限名称',
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COMMENT='权限资源';

-- 正在导出表  customer_skymoons_com.cu_admin_rights 的数据：7 rows
/*!40000 ALTER TABLE `cu_admin_rights` DISABLE KEYS */;
REPLACE INTO `cu_admin_rights` (`id`, `name`, `content`) VALUES
	(67, '[系统管理]权限角色管理', 'adminRole@addRole,adminRole@editRole,adminRole@delRole'),
	(76, '[系统管理]权限资源管理', 'RightsController@save,RightsController@index,RightsController@del'),
	(78, '[系统管理]管理员管理', 'UsersController@index,UsersController@save,UsersController@del,UsersController@setpwd');
/*!40000 ALTER TABLE `cu_admin_rights` ENABLE KEYS */;


-- 导出  表 customer_skymoons_com.cu_admin_user 结构
DROP TABLE IF EXISTS `cu_admin_user`;
CREATE TABLE IF NOT EXISTS `cu_admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) DEFAULT '' COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码 ',
  `salt` char(6) NOT NULL DEFAULT '' COMMENT '密码随机值',
  `email` varchar(255) DEFAULT NULL COMMENT '邮件地址',
  `createTime` bigint(11) DEFAULT '0' COMMENT '创建时间',
  `lastTime` bigint(11) DEFAULT '0' COMMENT '最后登录时间',
  `lastIp` varchar(80) DEFAULT NULL COMMENT '最后登录IP',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '是否禁用   0禁用  1正常',
  `groupId` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '分组编号',
  `phone` bigint(11) unsigned DEFAULT '0' COMMENT '电话',
  `saveLog` text,
  `truename` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像图标',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `email` (`email`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=654 DEFAULT CHARSET=utf8 COMMENT='管理员账户';

-- 正在导出表  customer_skymoons_com.cu_admin_user 的数据：3 rows
/*!40000 ALTER TABLE `cu_admin_user` DISABLE KEYS */;
REPLACE INTO `cu_admin_user` (`id`, `username`, `password`, `salt`, `email`, `createTime`, `lastTime`, `lastIp`, `status`, `groupId`, `phone`, `saveLog`, `truename`, `avatar`) VALUES
	(628, 'seiven', '11d9ccdf99e8964b90317958197e85d2', '687054', '12eq@sa.sa', 1449467472, 0, NULL, 1, 1, 1, NULL, 'dasddasd', NULL),
	(651, 'dsadasda', '454739cb967f0a987e2ef66901020312', '324148', 'das@sa.das11', 1449469887, 0, NULL, 0, 1, 0, NULL, '测试1', NULL),
	(652, 'dasdas', '0da8f874761fa56435c28ed6137fe714', '541128', 'asdasda', 1449236470, 0, NULL, 0, 1, 0, NULL, 'dasddasd', NULL),
	(653, 'seiven123', '3b343d80c38171740ae6b647d4d16c49', '587133', 'dsa@da.11', 1449467991, 0, NULL, 0, 1, 0, NULL, 'dasddasd', NULL);
/*!40000 ALTER TABLE `cu_admin_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
