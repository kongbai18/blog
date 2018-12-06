DROP TABLE IF EXISTS `daishu_user`;
CREATE TABLE `daishu_user` (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户Id',
  `user_name` varchar(30) NOT NULL UNIQUE  COMMENT '用户名',
  `user_password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `user_phone` varchar(25) NOT NULL UNIQUE COMMENT '手机号',
  `user_email` varchar(100) NOT NULL UNIQUE DEFAULT '0' COMMENT '邮箱',
  `user_photo_url` varchar(150)  NOT NULL DEFAULT '100' COMMENT '头像',
  `user_level` tinyint UNSIGNED NOT NULL DEFAULT 1 COMMENT '用户等级',
  `user_last_login_ip` varchar(25)  NOT NULL DEFAULT '' COMMENT '最后登陆IP',
  `user_last_login_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登陆时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
   PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

DROP TABLE IF EXISTS `daishu_article`;
CREATE TABLE `daishu_article`(
  `article_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `article_tittle` varchar(255) NOT NULL DEFAULT '' COMMENT '文章标题',
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户ID',
  `article_content` text COMMENT '文章内容',
  `article_view_count` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '浏览量',
  `article_comment_count` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论数',
  `article_like_count` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '点赞数',
  `is_top` tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否置顶',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (`article_id`)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='文章表';

DROP TABLE IF EXISTS `daishu_comment`;
CREATE TABLE `daishu_comment`(
  `comment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `article_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文章ID',
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户ID',
  `parent_comment_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父级ID',
  `comment_content` varchar(255) NOT NULL DEFAULT '' COMMENT '评论内容',
  `comment_like_count` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '点赞数',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (`comment_id`),
  KEY `article_id`(`article_id`)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='评论表';

DROP TABLE IF EXISTS `daishu_category`;
CREATE TABLE `daishu_category`(
  `cate_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `cate_name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `cate_alias` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '分类别名',
  `parent_cate_id` INT(11) NOT NULL DEFAULT 0 COMMENT '父类ID',
  `cate_description` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '分类描述',
  `is_index` tinyint NOT NULL DEFAULT 1 COMMENT '是否显示',
  `order_id` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `create_time` int(10) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`cate_id`)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT '分类表';

DROP TABLE IF EXISTS `daishu_article_cate`;
CREATE TABLE `daishu_article_cate`(
  `article_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文章ID',
  `cate_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类ID',
  KEY `article_id`(`article_id`),
  KEY `cate_id`(`cate_id`)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT '文章分类联系表';

DROP TABLE IF EXISTS `daishu_label`;
CREATE TABLE `daishu_label`(
  `label_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '标签ID',
  `label_name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '标签名称',
  `label_alias` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '标签别名',
  `label_description` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '标签描述',
  `is_index` tinyint NOT NULL DEFAULT 1 COMMENT '是否显示',
  `order_id` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `create_time` int(10) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`label_id`)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT '标签表';

DROP TABLE IF EXISTS `daishu_article_label`;
CREATE TABLE `daishu_article_label`(
  `article_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文章ID',
  `label_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '标签ID',
  KEY `article_id`(`article_id`),
  KEY `label_id`(`label_id`)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT '文章标签联系表';