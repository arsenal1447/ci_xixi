-- 用户记录表

CREATE TABLE IF NOT EXISTS `xi_users` (
  `ID` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(64) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(64) NOT NULL DEFAULT '',
  `user_email` varchar(128) NOT NULL DEFAULT '',
  `user_url` varchar(128) NOT NULL DEFAULT '',
  `user_mobile` varchar(64) NOT NULL DEFAULT '',
  `user_picture` varchar(64) NOT NULL DEFAULT '',
  `user_register` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

-- 图片记录表

CREATE TABLE IF NOT EXISTS `xi_picture` (
  `ID` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `pic_uuid` varchar(64) NOT NULL DEFAULT '',
  `pic_name` varchar(64) NOT NULL DEFAULT '',
  `pic_url` varchar(128) NOT NULL DEFAULT '',
  `pic_text` varchar(256) NOT NULL DEFAULT '',
  `pic_type` varchar(32) NOT NULL DEFAULT '',
  `pic_tag` varchar(256) NOT NULL DEFAULT '',
  `pic_user` varchar(64) NOT NULL DEFAULT '',
  `pic_collect` int(11) NOT NULL DEFAULT '0',
  `pic_like` int(11) NOT NULL DEFAULT '0',
  `pic_share` int(11) NOT NULL DEFAULT '0',
  `pic_view` int(11) NOT NULL DEFAULT '0',
  `pic_status` int(11) NOT NULL DEFAULT '0',
  `pic_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

-- 分类信息表

CREATE TABLE IF NOT EXISTS `xi_catalogue` (
  `ID` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(64) NOT NULL DEFAULT '',
  `cat_another_name` varchar(64) NOT NULL DEFAULT '',
  `cat_icon` varchar(64) NOT NULL DEFAULT '',
  `cat_father` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

-- 标签信息表

CREATE TABLE IF NOT EXISTS `xi_tags` (
  `ID` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(64) NOT NULL DEFAULT '',
  `tag_amount` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

-- 系统设置信息表

CREATE TABLE IF NOT EXISTS `xi_systeminfo` (
  `ID` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `sys_title` varchar(64) NOT NULL DEFAULT '',
  `sys_value` varchar(256) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

INSERT INTO `xi_systeminfo` (`ID`, `sys_title`, `sys_value`) VALUES
(1, 'webtitle', '西西美图'),
(2, 'keywords', '图片,瀑布流,图片系统,php,开源,Bootstrap,CodeIgniter'),
(3, 'description', '基于Bootstrap与CodeIgniter的php瀑布流图片系统');

INSERT INTO `xi_tags` (`ID`, `tag_name`, `tag_amount`) VALUES (NULL, '海报', '0');
INSERT INTO `xi_tags` (`ID`, `tag_name`, `tag_amount`) VALUES (NULL, '黑白', '0');
INSERT INTO `xi_tags` (`ID`, `tag_name`, `tag_amount`) VALUES (NULL, '清纯', '0');
INSERT INTO `xi_tags` (`ID`, `tag_name`, `tag_amount`) VALUES (NULL, '性感', '0');

-- 评论记录表

CREATE TABLE IF NOT EXISTS `xi_messages` (
  `ID` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `msg_text` varchar(1024) NOT NULL DEFAULT '',
  `msg_pic` varchar(64) NOT NULL DEFAULT '',
  `msg_user` varchar(64) NOT NULL DEFAULT '',
  `msg_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

-- 喜欢记录表

CREATE TABLE IF NOT EXISTS `xi_like` (
  `ID` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `like_pic` varchar(64) NOT NULL DEFAULT '',
  `like_ip` varchar(128) NOT NULL DEFAULT '',
  `like_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

-- 收藏记录表

CREATE TABLE IF NOT EXISTS `xi_love` (
  `ID` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `love_pic` varchar(64) NOT NULL DEFAULT '',
  `love_user` varchar(64) NOT NULL DEFAULT '',
  `love_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

-- 私信记录表

CREATE TABLE IF NOT EXISTS `xi_letter` (
  `ID` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `letter_form` varchar(64) NOT NULL DEFAULT '',
  `letter_to` varchar(64) NOT NULL DEFAULT '',
  `letter_text` varchar(1024) NOT NULL DEFAULT '',
  `letter_type` int(11) NOT NULL DEFAULT '0',
  `letter_status` int(11) NOT NULL DEFAULT '0',
  `letter_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

-- 关注记录表

CREATE TABLE IF NOT EXISTS `xi_follow` (
  `ID` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `follow_form` varchar(64) NOT NULL DEFAULT '',
  `follow_to` varchar(64) NOT NULL DEFAULT '',
  `follow_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;