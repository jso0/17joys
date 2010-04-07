-- --------------------------------------------------------

-- 
-- 表的结构 `joys_user`
-- 

CREATE TABLE `joys_user` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `reg_date` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `joys_role`
-- 

CREATE TABLE `joys_role` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`,`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


-- --------------------------------------------------------

-- 
-- 表的结构 `joys_role_user`
-- 

CREATE TABLE `joys_role_user` (
  `role_id` mediumint(8) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  KEY `role_id` (`role_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- 表的结构 `joys_node`
-- 

CREATE TABLE `joys_node` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  `sort` smallint(5) unsigned NOT NULL,
  `pid` smallint(5) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`,`status`,`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


-- --------------------------------------------------------

-- 
-- 表的结构 `joys_access`
-- 

CREATE TABLE `joys_access` (
  `role_id` smallint(5) unsigned NOT NULL,
  `node_id` smallint(5) unsigned NOT NULL,
  `level` tinyint(4) NOT NULL,
  `pid` smallint(6) NOT NULL,
  KEY `role_id` (`role_id`,`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

-- 
-- 表的结构 `joys_section`
-- 

CREATE TABLE `joys_section` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `order` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- 表的结构 `joys_category`
-- 

CREATE TABLE `joys_category` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL,
  `order` int(11) NOT NULL,
  `access` tinyint(3) unsigned NOT NULL,
  `sectionid` int(10) unsigned NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `joys_article`
-- 

CREATE TABLE `joys_article` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `title_alias` varchar(255) NOT NULL,
  `introtext` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `sectionid` int(10) unsigned NOT NULL,
  `catid` int(10) unsigned NOT NULL,
  `created` date NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(10) unsigned NOT NULL,
  `publish_up` datetime NOT NULL,
  `publish_down` datetime NOT NULL,
  `order` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `hits` int(10) unsigned NOT NULL,
  `metadata` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `sectionid` (`sectionid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


-- --------------------------------------------------------

-- 
-- 表的结构 `joys_component`
-- 

CREATE TABLE `joys_component` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL,
  `option` varchar(50) NOT NULL,
  `order` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


-- --------------------------------------------------------

-- 
-- 表的结构 `joys_menu`
-- 

CREATE TABLE `joys_menu` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `menutype` varchar(75) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


-- --------------------------------------------------------

-- 
-- 表的结构 `joys_menu_item`
-- 

CREATE TABLE `joys_menu_item` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `menuid` int(10) unsigned NOT NULL,
  `alias` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `pid` int(10) unsigned NOT NULL default '0',
  `path` text NOT NULL,
  `componentid` int(10) unsigned NOT NULL,
  `order` int(11) NOT NULL default '0',
  `browserNav` tinyint(4) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


-- --------------------------------------------------------

-- 
-- 表的结构 `joys_modules`
-- 

CREATE TABLE `joys_modules` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `order` int(11) NOT NULL default '0',
  `position` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `module` varchar(50) NOT NULL,
  `access` tinyint(3) NOT NULL default '0',
  `showtitle` tinyint(3) NOT NULL default '1',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `published` (`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


-- --------------------------------------------------------

-- 
-- 表的结构 `joys_modules_menu`
-- 

CREATE TABLE `joys_modules_menu` (
  `modulesid` int(11) NOT NULL,
  `menuid` int(11) NOT NULL,
  PRIMARY KEY  (`modulesid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
