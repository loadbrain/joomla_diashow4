-- DROP TABLE IF EXISTS `#__diashow`;

CREATE TABLE IF NOT EXISTS `#__diashow` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `target` enum('_blank','_self','_top') NOT NULL,
  `ordering` int(11) NOT NULL,
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

ALTER TABLE `#__diashow` MODIFY COLUMN `ordering` int(11) NOT NULL default '0';

-- DROP TABLE IF EXISTS `#__diashow_visibility`;

CREATE TABLE IF NOT EXISTS `#__diashow_visibility` (
  `diashow_id` int(4) NOT NULL,
  `menu_id` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
