<?php
/**
* DiaShow Controller for DiaShow Component
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

class DiaShowControllerManageUploadDiaShows extends DiaShowController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
		$this->registerTask( 'add'  , 	'view' );
	}

	/**
	 * display the edit form
	 * @return void
	 */
	function view()
	{
		JRequest::setVar( 'view', 'diashowmanageuploaddiashows' );
		JRequest::setVar( 'layout', 'formuploaddiashows'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}



	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'CANCEL OPERATION' );
		$this->setRedirect( 'index.php', $msg );
	}
}
?>
