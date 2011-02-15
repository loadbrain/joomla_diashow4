<?php
/**
* DiaShow View class
* 
* @author Ralf Weber  <ralf@weberr.de>
* @version 2.0
* @copyright Copyright (c) 2007, LoadBrain
* @link http://www.weberr.de/
*
* @license GNU/GPL
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class DiaShowViewDiaShowAbout extends JView
{
	/**
	 * display method of Hello view
	 * @return void
	 **/
	function display($tpl = null)
	{
		JToolBarHelper::title( JText::_( 'DIASHOW_ABOUT_TITLE' ) . " " . JText::_( 'DIASHOW_VERSION'), 'diashow' );
		JHTML::_('stylesheet', 'diashow.css', 'administrator/components/com_diashow/css/');
		JToolBarHelper::cancel( 'cancel', 'Cancel' );

		parent::display($tpl);
	}
}
