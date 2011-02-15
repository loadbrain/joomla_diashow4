<?php
/**
* DiaShow View class
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

jimport( 'joomla.application.component.view' );


class DiaShowViewDiashowManageDiashows extends JView
{
	/**
	 * Hellos data array
	 *
	 * @var array
	 */
	var $_data;
	
	/**
	 * display method of Hello view
	 * @return void
	 **/
	function display($tpl = null)
	{
		$task =  JRequest::getVar('task');
		$cid 	= JRequest::getVar('cid', array(0), 'post', 'array');
		JArrayHelper::toInteger($cid, array(0));   
		
		switch($task)
		{
			case "edit":
			case "add":
			$this->editData($cid);
			break;

			case "publish":
			$this->changeData($cid, 1);
			break;

			case "unpublish":
			$this->changeData($cid, 0);
			break;

			case 'orderup':
			$this->orderData( $cid[0], -1 );
			break;
		
			case 'orderdown':
			$this->orderData( $cid[0], 1 );
			break;

			case 'saveorder':
			$this->saveOrder( $cid[0] );
			break;
					
			default:
			$this->getData();
		}

	}
	
	function getData()
	{
		$tpl;
		$diaShows		=& $this->get('ListData');

		JToolBarHelper::title(   JText::_( 'DIASHOW_MANAGE_DIASHOWS' ), 'diashow' );
		JHTML::_('stylesheet', 'diashow.css', 'administrator/components/com_diashow/css/');
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();
		JToolBarHelper::cancel( 'close', 'Close' );
		JToolBarHelper::cancel( 'cancel', 'Cancel' );

		$this->assignRef('diaShows', $diaShows);
		$this->assignRef('pageNav', $pageNav);
		
		parent::display($tpl);
	}
	
	
	function editData()
	{
		$diaShows		=& $this->get('editData');

		$isNew		= ($diaShows->id < 1);
		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'DIASHOW_MANAGE_DIASHOWS' ) .': <small><small>[ ' . $text.' ]</small></small>', 'diahsow' );
		JHTML::_('stylesheet', 'diashow.css', 'administrator/components/com_diashow/css/');
		JToolBarHelper::save();
		if ($isNew)  {
		JToolBarHelper::cancel( 'close', 'Close' );
		JToolBarHelper::cancel( 'cancel', 'Cancel' );
		} else {
		JToolBarHelper::cancel( 'close', 'Close' );
		JToolBarHelper::cancel( 'cancel', 'Cancel' );
		}
		$this->assignRef('diaShows', $diaShows);
		parent::display($tpl);
	}
	

/**
* Changes the state of one or more content pages
* @param array An array of unique category id numbers
* @param integer 0 if unpublishing, 1 if publishing
* @param string The current option
*/
	
	function changeData($cid=null, $state=0)
	{
		$diaShows		=& $this->get('changeData');
	}	
	
	function orderData( $uid, $inc )
	{
		$diaShows		=& $this->get('orderData');
	}

	function saveOrder( $cid )
	{
        $diaShows		=& $this->get('saveOrderData');
	}
}

