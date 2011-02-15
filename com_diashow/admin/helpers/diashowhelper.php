<?php
defined('_JEXEC') or die;

class DiashowHelper
{
	public static function getActions($bookId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($bookId)) {
			$assetName = 'com_diashow';
		} else {
			$assetName = 'com_diashow.diashow'.(int) $bookId;
		}

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
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

