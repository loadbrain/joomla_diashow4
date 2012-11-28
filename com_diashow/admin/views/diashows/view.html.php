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
 * Diashows View
 */
class DiashowViewDiashows extends JViewLegacy{
	/**
	 * display method
	 * @return void
	 */
	function display($tpl = null){
		// Get data from the model

		$items = $this->get('Items');
		$this->state	= $this->get('State');
		$pagination = $this->get('Pagination');
		$this->state = $this->get('State');
		$this->menu = $this->get('MenuEntries');


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

	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar(){
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'diashowhelper.php';

		$user		= JFactory::getUser();
		$canDo		= DiashowHelper::getActions($this->state->get('filter.id'));
		
		if ($canDo->get('core.edit')){
			JToolBarHelper::title(JText::_('COM_DIASHOW_MANAGER_DIASHOWS'));
			JToolBarHelper::editList('diashow.edit');
			JToolBarHelper::addNew('diashow.add');
		if ($canDo->get('core.edit.state'))
		{
			if ($this->state->get('filter.state') != 2)
			{
				JToolbarHelper::publish('diashows.publish', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::unpublish('diashows.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			}

			if ($this->state->get('filter.state') != -1)
			{
				if ($this->state->get('filter.state') != 2)
				{
					JToolbarHelper::archiveList('diashows.archive');
				}
				elseif ($this->state->get('filter.state') == 2)
				{
					JToolbarHelper::unarchiveList('diashows.publish');
				}
			}
		}
		if ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::checkin('diashows.checkin');
		}
		if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'diashows.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('diashows.trash');
		}
	}
}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_DIASHOW_ADMINISTRATION'));
	}

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 *
	 * @since   3.0
	 */
	protected function getSortFields()
	{
		return array(
			'ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'title' => JText::_('COM_DIASHOW_DIASHOW_HEADING_TITLE')
		);
	}	
}
?>
