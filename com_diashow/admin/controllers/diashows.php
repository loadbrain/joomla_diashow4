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
defined( '_JEXEC' ) or die( 'Restricted access' ); 

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

/**
 * DiashowControllerDiashows Controller
 */
class DiashowControllerDiashows extends JControllerAdmin{
        /**
         * Proxy for getModel.
         * @since       1.6
         */
        public function getModel($name = 'Diashow', $prefix = 'DiashowModel', $config = array('ignore_request' => true)){
                $model = parent::getModel($name, $prefix, array('ignore_request' => true));

                return $model;
        }

	/**
	 * Method to save the submitted ordering values for records via AJAX.
	 *
	 * @return	void
	 *
	 * @since   3.0
	 */
	public function saveOrderAjax()
	{
		// Get the input
		$pks = $this->input->post->get('cid', array(), 'array');
		$order = $this->input->post->get('order', array(), 'array');

		// Sanitize the input
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();

		// Save the ordering
		$return = $model->saveorder($pks, $order);

		if ($return)
		{
			echo "1";
		}

		// Close the application
		JFactory::getApplication()->close();
	}	
		
}

?>
