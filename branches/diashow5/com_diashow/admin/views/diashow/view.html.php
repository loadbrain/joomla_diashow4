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
 * Diashow View
 */
class DiashowViewDiashow extends JViewLegacy
{
	        /**
         * View form
         *
         * @var         form
         */
        protected $form = null;
		protected $state = null;
		protected $item = null;
		protected $tmpl;
		protected $menu = null;

        /**
         * display method of Hello view
         * @return void
         */
        public function display($tpl = null){

			// get the Data
                $form = $this->get('Form');
                $item = $this->get('Item');
                $script = $this->get('Script');
                $this->state = $this->get('State');
				$this->menu = $this->get('Menu');


                // Check for errors.
                if (count($errors = $this->get('Errors')))
                {
                        JError::raiseError(500, implode('<br />', $errors));
                        return false;
                }
                // Assign the Data
                $this->form = $form;
                $this->item = $item;
                $this->script = $script;


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

                JRequest::setVar('hidemainmenu', true);
                $user		= JFactory::getUser();
                $checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
                $canDo		= DiashowHelper::getActions($this->state->get('filter.id'), $this->item->id);
                $isNew = ($this->item->id == 0);
        		// If not checked out, can save the item.
				if (!$checkedOut && $canDo->get('core.edit')){
					JToolBarHelper::apply('diashow.apply', 'JTOOLBAR_APPLY');
					JToolBarHelper::save('diashow.save', 'JTOOLBAR_SAVE');
					if ($canDo->get('core.create')){
						JToolBarHelper::addNew('diashow.save2new', 'JTOOLBAR_SAVE_AND_NEW');
					}
				}

				if ($canDo->get('core.create')){
					JToolBarHelper::custom('diashow.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
                }
				if (empty($this->item->id))  {
					JToolBarHelper::cancel('diashow.cancel', 'JTOOLBAR_CANCEL');
				}
				else {
					JToolBarHelper::cancel('diashow.cancel', 'JTOOLBAR_CLOSE');
				}
        }

        /**
         * Method to set up the document properties
         *
         * @return void
         */
        protected function setDocument()
        {
                $isNew = ($this->item->id < 1);
                $document = JFactory::getDocument();
                $document->setTitle($isNew ? JText::_('COM_DIASHOW_CREATING') : JText::_('COM_DIASHOW_EDITING'));
                $document->addScript(JURI::root() . $this->script);
                $document->addScript(JURI::root() . "/administrator/components/com_diashow/views/diashow/submitbutton.js");
                JText::script('COM_DIASHOW_ERROR_UNACCEPTABLE');

        }
}
?>
