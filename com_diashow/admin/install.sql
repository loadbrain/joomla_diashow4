DROP TABLE IF EXISTS `#__diashow`;

CREATE TABLE IF NOT EXISTS `#__diashow` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `target` enum('_blank','_self','_top') NOT NULL,
  `ordering` int(11) NOT NULL,
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `#__diashow_visibility`;

CREATE TABLE IF NOT EXISTS `#__diashow_visibility` (
   `diashow_id` INT( 4 ) NOT NULL ,
   `menu_id` INT( 4 ) NOT NULL
) TYPE=MyISAM;