<?php
/*------------------------------------------------------------------------
# com_diashow - DiaShow5 - Joomla 3.x
# ------------------------------------------------------------------------
# author Ralf Weber
# copyright Copyright (C) 2011 http://www.weberr.de/. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.weberr.de/
# Technical Support: Forum - http://www.weberr.de/
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');

class DiashowHelper
{
    public static function getActions($messageId = 0)
    {
        $user	= JFactory::getUser();
        $result	= new JObject;

        if (empty($messageId)) {
            $assetName = 'com_diashow';
        } else {
            $assetName = 'com_diashow.diashow'.(int) $messageId;
        }

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.state', 'core.delete'
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }

    /**
      * Configure the Linkbar.
      */
    public static function addSubmenu($submenu)
    {
        JSubMenuHelper::addEntry(JText::_('COM_DIASHOW_SUBMENU_DIASHOW'), 'index.php?option=com_diashow', $submenu == 'diashow');
        JSubMenuHelper::addEntry(JText::_('COM_DIASHOW_SUBMENU_UPLOAD'), 'index.php?option=com_diashow&view=upload&extension=com_diashow', $submenu == 'upload');
        JSubMenuHelper::addEntry(JText::_('COM_DIASHOW_SUBMENU_ABOUT'), 'index.php?option=com_diashow&view=about&extension=com_diashow', $submenu == 'about');
        // set some global property
        $document = JFactory::getDocument();
        $document->addStyleDeclaration('.icon-48-diashow {background-image: url(../media/com_diashow/images/diashow.png);}');
        if ($submenu == 'diashow') {
            $document->setTitle(JText::_('COM_DIASHOW_SUBMENU_DIASHOW'));
        }
        if ($submenu == 'upload') {
            $document->setTitle(JText::_('COM_DIASHOW_SUBMENU_UPLOAD'));
        }
        if ($submenu == 'about') {
            $document->setTitle(JText::_('COM_DIASHOW_SUBMENU_ABOUT'));
        }
    }
 
    /**
    * Overriding JFolder::makeSafe so the dot is not removed from path like /var/www/xxx.net/html...
    */
    public static function makeSafe($path)
    {
        $regex = array('#[^A-Za-z0-9:_.\\\/-]#');
        return preg_replace($regex, '', $path);
    }
}
