<?php
/*------------------------------------------------------------------------
# mod_diashow - DiaShow4
# ------------------------------------------------------------------------
# author Ralf Weber
# copyright Copyright (C) 2011 http://www.weberr.de/. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.weberr.de/
# Technical Support: Forum - http://www.weberr.de/
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

class modDiashowHelper
{
	public static function getDiaShowData($params){
		$app = JFactory::getApplication();
		$menu = $app->getMenu();
		$active = $menu->getActive($params);

		$db	= JFactory::getDbo();
		$query = "SELECT * FROM #__diashow, #__diashow_visibility WHERE (#__diashow_visibility.menu_id = '" . $active->id . "' and #__diashow.id = #__diashow_visibility.diashow_id) or (#__diashow_visibility.menu_id = '0' and #__diashow.id = #__diashow_visibility.diashow_id) and published = '1' order by ordering";
		$db->setQuery($query);
		$rows = $db->loadObjectList();
        if ($params->get( 'optionalRandomOrder') == "R"){
            shuffle($rows);
        }

		return $rows;
	}
}
