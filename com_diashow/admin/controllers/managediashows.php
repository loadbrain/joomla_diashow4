<?php
/**
* DiaShow Controller 
* 
* @author Ralf Weber  <ralf@weberr.de>
* @version 2.0
* @copyright Copyright (c) 2008, LoadBrain
* @link http://www.weberr.de/
*
* @license GNU/GPL
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();


class DiaShowControllerManageDiaShows extends DiashowController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
		$this->registerTask( 'add', 'edit' );
		$this->registerTask( 'view', 'view' );
		$this->registerTask( 'publish', 'publish' );
	}

	/**
	 * display the edit form
	 * @return void
	 */
	function edit()
	{
		JRequest::setVar( 'view', 'diashowManageDiashows' );
		JRequest::setVar( 'layout', 'formmanageeditdiashows'  );
		JRequest::setVar('hidemainmenu', 1);
		JRequest::setVar('edit', 'edit');

		parent::display();
	}
	
		/**
	 * display the edit form
	 * @return void
	 */
	function view()
	{
		JRequest::setVar( 'view', 'diashowManageDiashows' );
		JRequest::setVar( 'layout', 'formmanagediashows'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		$model = $this->getModel('diashowManageDiashows');
		if ($model->store($post)) {
			$msg = JText::_( 'ENTRY SAVED' );
		} else {
			$msg = JText::_( 'ERROR ENTRY SAVED' );
		}

		$link = 'index.php?option=com_diashow&controller=managediashows&task=view';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('DiaShowManageDiashows');
		if(!$model->delete()) {
			$msg = JText::_( 'ERROR ENTRY DELETED' );
		} else {
			$msg = JText::_( 'ENTRY DELETED' );
		}

		$this->setRedirect( 'index.php?option=com_diashow&controller=managediashows&task=view', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function close()
	{
		$msg = JText::_( 'CLOSE OPERATION' );
		$this->setRedirect( 'index.php?option=com_diashow&controller=managediashows&task=view', $msg );
	}
	
	function cancel()
	{
		$msg = JText::_( 'CANCEL OPERATION' );
		$this->setRedirect( 'index.php', $msg );
	}	
	
	function publish()
	{
		JRequest::setVar( 'view', 'diashowManageDiashows' );
		JRequest::setVar( 'layout', 'formmanageeditdiashows'  );
		JRequest::setVar('hidemainmenu', 1);
		JRequest::setVar('publish', 'publish');

		parent::display();
	}
	
	function unpublish()
	{
		JRequest::setVar( 'view', 'diashowManageDiashows' );
		JRequest::setVar( 'layout', 'formmanageeditdiashows'  );
		JRequest::setVar('hidemainmenu', 1);
		JRequest::setVar('unpublish', 'unpublish');

		parent::display();
	}	
	
	function orderdown()
	{
		JRequest::setVar( 'view', 'diashowManageDiashows' );
		JRequest::setVar( 'layout', 'formmanageeditdiashows'  );
		JRequest::setVar('hidemainmenu', 1);
		JRequest::setVar('orderdown', 'orderdown');

		parent::display();
	}		

	function orderup()
	{
		JRequest::setVar( 'view', 'diashowManageDiashows' );
		JRequest::setVar( 'layout', 'formmanageeditdiashows'  );
		JRequest::setVar('hidemainmenu', 1);
		JRequest::setVar('orderup', 'orderup');

		parent::display();
	}

	function saveorder()
	{
		JRequest::setVar( 'view', 'diashowManageDiashows' );
		JRequest::setVar( 'layout', 'formmanageeditdiashows'  );
		JRequest::setVar('hidemainmenu', 1);
		JRequest::setVar('saveorder', 'saveorder');

		parent::display();
	}		
}
?>
