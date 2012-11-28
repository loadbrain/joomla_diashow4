<?php
/*------------------------------------------------------------------------
# com_diashow - DiaShow4
# ------------------------------------------------------------------------
# author Ralf Weber
# copyright Copyright (C) 2011 http://www.weberr.de/. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.weberr.de/
# Technical Support: Forum - http://www.weberr.de/
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 


/**
 * DiashowViewAbout View
 */
class DiashowViewAbout extends JViewLegacy{
	/**
	 * Rwcards view display method
	 * @return void
	 */
	function display($tpl = null){
		// Get data from the model

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Set the toolbar
		$this->addToolBar();

		//Get Version
		$this->version =  $this->get('DiashowVersion');		
		
		

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();

	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_DIASHOW_MANAGER_ABOUT'));
		JToolBarHelper::cancel('diashow.cancel', 'JTOOLBAR_CANCEL');
	}
	
        /**
         * Method to set up the document properties
         *
         * @return void
         */
        protected function setDocument() 
        {
                $document = JFactory::getDocument();
                $document->setTitle(JText::_('COM_DIASHOW_MANAGER_DIASHOWS'));
        }	

}
?>
