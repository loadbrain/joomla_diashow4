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

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * DiashowViewUpload View
 */
class DiashowViewUpload extends JViewLegacy{
	/**
	 * Rwcards view display method
	 * @return void
	 */
	function display($tpl = null){

		// Get data from the model
		$this->get('ImageFolder');
		$this->form		= $this->get('Form');
		$items = $this->get('Items');
		$pagination = $this->get('Pagination');
		$this->state = $this->get('State');
		$this->images = $this->get('Images');
		$params = JComponentHelper::getParams( 'COM_DIASHOW' );
   		$this->params = $params;

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign data to the view
		$this->items = $items;
		$this->pagination = $pagination;
		// Set the toolbar
		$this->addToolBar();


		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();

	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar(){
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'diashowhelper.php';

		$user = JFactory::getUser();
		$this->canDo = DiashowHelper::getActions($this->state->get('filter.id'));
		JToolBarHelper::title(JText::_('COM_DIASHOW_MANAGE_UPLOADS'));
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
