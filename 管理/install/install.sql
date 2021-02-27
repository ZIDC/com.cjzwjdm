DROP TABLE IF EXISTS `iapp_config`;</explode>
CREATE TABLE `iapp_config` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `switch` int(1) NOT NULL DEFAULT '1',
  `user` varchar(250) NOT NULL,
  `pwd` varchar(250) NOT NULL,
  `money` varchar(250) NOT NULL,
  `appname` text,
 `appversion` text,
 `appbuild` text,
 `qd` text,
 `qdjb` text,
 `qdip` text,
 `appmsg` text,
 `feed` text,
 `feedkeyword` text,
 `feedsize` text,
 `feedsame` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `user_list`;</explode>
CREATE TABLE `user_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text,
  `pass` text,
  `money` text,
  `date` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `km_list`;</explode>
CREATE TABLE `km_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `km` text,
  `money` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>


DROP TABLE IF EXISTS `iapp_notice`;</explode>
CREATE TABLE `iapp_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `center` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>


DROP TABLE IF EXISTS `qd_list`;</explode>
CREATE TABLE `qd_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text,
  `date` text,
  `time` text,
  `money` text,
  `ip` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>



DROP TABLE IF EXISTS `feed_list`;</explode>
CREATE TABLE `feed_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text,
  `date` text,
  `data` text,
  `return` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>


INSERT INTO `iapp_config`(`id`, `switch`, `user`, `pwd`, `money`, `appname`, `appversion`, `appbuild`, `qd`, `qdjb`, `qdip`, `appmsg`, `feed`, `feedkeyword`, `feedsize`, `feedsame`) VALUES
('1', '1', 'admin', '123456','0','IAPP应用','1.0','1000','1','10','1','1、修复了部分危险BUG','1','傻逼,弱智','10-200','1');</explode>