<?php
/**
* @version		$Id: helper.php 8813 2007-09-09 22:05:30Z hackwar $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2007 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class modDiashowHelper
{
	public function getDiaShowData(&$params){
		$app	= JFactory::getApplication();

		$db	=& JFactory::getDbo();
		$Itemid = JRequest::getVar('Itemid', 1, 'get', 'int');

		$query = "SELECT * FROM #__diashow, #__diashow_visibility WHERE (#__diashow_visibility.menu_id = '" . $Itemid . "' and #__diashow.id = #__diashow_visibility.diashow_id) or (#__diashow_visibility.menu_id = '0' and #__diashow.id = #__diashow_visibility.diashow_id) and published = '1' order by ordering";

		$db->setQuery($query);
		$rows = $db->loadObjectList();
        if ($params->get( 'optionalRandomOrder') == "R"){
            shuffle(&$rows);
        }

		return $rows;
	}
}
