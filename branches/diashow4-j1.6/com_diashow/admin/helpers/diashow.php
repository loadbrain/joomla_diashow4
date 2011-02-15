<?php
// No direct access to this file
defined('_JEXEC') or die;

/**
 * Diashow component helper.
 */
abstract class DiashowHelper
{
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
                if ($submenu == 'diashow'){
                    $document->setTitle(JText::_('COM_DIASHOW_SUBMENU_DIASHOW'));
                }
                if ($submenu == 'upload'){
					$document->setTitle(JText::_('COM_DIASHOW_SUBMENU_UPLOAD'));
                }
                if ($submenu == 'about'){
					$document->setTitle(JText::_('COM_DIASHOW_SUBMENU_ABOUT'));
                }
        }
}
?>