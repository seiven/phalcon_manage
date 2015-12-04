CREATE TABLE `cu_admin_user` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '用户名',
	`password` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '密码 ',
	`salt` CHAR(6) NOT NULL DEFAULT '' COMMENT '密码随机值',
	`email` VARCHAR(255) NULL DEFAULT NULL COMMENT '邮件地址',
	`createTime` BIGINT(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
	`lastTime` BIGINT(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
	`lastIp` VARCHAR(80) NULL DEFAULT NULL COMMENT '最后登录IP',
	`status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否禁用   0禁用  1正常',
	`groupId` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0' COMMENT '分组编号',
	`phone` BIGINT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '电话',
	`saveLog` TEXT NULL,
	`truename` VARCHAR(10) NULL DEFAULT NULL COMMENT '真实姓名',
	`avatar` VARCHAR(255) NULL DEFAULT NULL COMMENT '头像图标',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `username` (`username`) USING BTREE,
	INDEX `status` (`status`) USING BTREE,
	INDEX `email` (`email`) USING BTREE
)
COMMENT='管理员账户'
COLLATE='utf8_general_ci'
ENGINE=MyISAM
AUTO_INCREMENT=637
;