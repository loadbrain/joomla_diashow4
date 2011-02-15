<?php
/**
* RWCards View class
* 
* @author Ralf Weber  <ralf@weberr.de>
* @version 3.0
* @copyright Copyright (c) 2007, LoadBrain
* @link http://www.weberr.de/
*
* @license GNU/GPL
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );


class DiaShowViewDiaShowManageUploadDiashows extends JView
{
	/**
	 * display method of Hello view
	 * @return void
	 **/
	function display($tpl = null)
	{
		$task =  JRequest::getVar('task');
		$this->getData();
	}

	function getData()
	{
		$diashowImages =& $this->get('Images');
                
		JToolBarHelper::title(   JText::_( 'UPLOAD_DIASHOW' ), 'diashow' );
		JHTML::_('stylesheet', 'diashow.css', 'administrator/components/com_diashow/css/');
		$bar = & JToolBar::getInstance('toolbar');
		$bar->appendButton( 'Popup', 'upload', 'UPLOAD', "index.php?option=com_media&view=images&tmpl=component&e_name=text", 650, 450 );

		JToolBarHelper::cancel('cancel', 'Close');
                
   		$this->assignRef('diashowImages', $diashowImages);
		parent::display($tpl);
		
	}
}
