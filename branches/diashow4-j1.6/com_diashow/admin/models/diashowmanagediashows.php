<?php
/**
* Diashow Model
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


jimport( 'joomla.application.component.model' );

class DiaShowModelDiaShowManageDiashows extends JModel
{

	/**
	 * data array
	 *
	 * @var array
	 */
	var $_data;
	var $_whereToShow;
	/**
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();
		$task = JRequest::getCmd('task');
		
		$id = JRequest::getVar('id', 0, 'get', 'int');
		$this->publish= ($task == 'publish') ? 1 : 0;
		$this->order = ($task == 'orderdown') ? 1 : -1;
		$this->saveorder = ($task == 'saveorder') ? 1 : -1;
       	$cid = JRequest::getVar('cid', array(0), 'request', 'array');
		JArrayHelper::toInteger($cid, array(0));

		$this->setId((int)$cid[0]);
	}

	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	function _buildQuery()
	{
		$query = ' SELECT * FROM #__diashow';
		return $query;
	}

	/**
	 * Retrieves the data
	 * @return array Array of objects containing the data from the database
	 */
	function &getListData()
	{	
		global $mainframe, $option;
		
	$db =& JFactory::getDBO();
	$filter_order = $mainframe->getUserStateFromRequest( $option.'filter_order', 		'filter_order', 	'ordering',	'cmd' );
	$filter_order_Dir = $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',	'word' );
	$filter_state = $mainframe->getUserStateFromRequest( $option.'filter_state', 		'filter_state', 	'',	'word' );
	$filter_catid = $mainframe->getUserStateFromRequest( $option.'filter_catid', 		'filter_catid',		'',	'int' );
	$search = $mainframe->getUserStateFromRequest( $option.'search', 			'search', 			'',	'string' );
	$search = JString::strtolower( $search );
	$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
	$limitstart = $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');
	

	$where = array();
	$linkedTo = array();

	if ( $search ) 
	{
		$where[] = 'title LIKE "%'.$db->getEscaped($search).'%"';
	}
	if ( $filter_catid ) 
	{
		$where[] = 'id = '.(int) $filter_catid;
	}
	if ( $filter_state ) 
	{
		if ( $filter_state == 'P' ) 
		{
			$where[] = 'published = 1';
		}
		else if ($filter_state == 'U' ) 
		{
			$where[] = 'published = 0';
		}
	}

	$where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
	if ($filter_order == 'ordering')
	{
		$orderby 	= ' ORDER BY ordering, title';
	}
	else 
	{
		$orderby 	= ' ORDER BY '. $filter_order .' '. $filter_order_Dir .', ordering, title';
	}

		// get the total number of records
		$query = "SELECT COUNT(*) FROM #__diashow". $where . $orderby;
	
		$db->setQuery( $query );
		$this->total = $db->loadResult();
		
		jimport('joomla.html.pagination');
		$this->_data['_pageNav'] = new JPagination( $this->total, $limitstart, $limit );
		
		$query = "SELECT * FROM #__diashow" . $where . $orderby;
                                              
		$db->setQuery( $query, $this->_data['_pageNav']->limitstart, $this->_data['_pageNav']->limit );
		
		$this->_data['rows'] = $db->loadObjectList();

		// state filter
		$lists['state']	=  JHTML::_('grid.state',  $filter_state );

		// table ordering
		if ( $filter_order_Dir == 'DESC' ) 
		{
			$lists['order_Dir'] = 'ASC';
		} 
		else 
		{
			$lists['order_Dir'] = 'DESC';
		}
		$lists['order'] = $filter_order;

		// search filter
		$lists['search']= $search;
		
		$this->_data['lists'] = $lists;
		
		// Put the corresponding menus in the array
		for ($i=0, $n=count( $this->_data['rows'] ); $i < $n; $i++)
		{
			$row = &$this->_data['rows'];
			
			$query = "SELECT distinct name, menutype, diashow_id, menu_id FROM #__diashow_visibility LEFT JOIN  #__menu ON #__menu.id = menu_id WHERE diashow_id = " . $row[$i]->id . " order by #__menu.menutype, #__menu.ordering";
			//echo $query;
			$this->_db->setQuery( $query );
			$this->_whereToShow = $this->_db->loadObjectList();

		
			for ($a=0, $b=count( $this->_whereToShow ); $a < $b; $a++)
			{
				$row = &$this->_whereToShow;
				if ($row[$a]->menu_id == 0)
				{
					$linkedTo[$i]  .= JText::_( 'DIASHOW_SHOW_ON_ALL_PAGES') . "<br />";
				continue;
				}
					$linkedTo[$i] .= $row[$a]->name . " (" . $row[$a]->menutype . ")<br />"; 
			}
		}
	
		$this->_data['linkedTo'] = $linkedTo;
		
		return $this->_data;
		}

	/**
	 *
	 * @access	public
	 * @param	int
	 * @return	void
	 */
	function setId($id)
	{
		// Set id and wipe data
		$this->_id = $id;
		$this->_data = null;
	}

	/**
	 * @return object with data
	 */
	function &getEditData()
	{

		$option = array();
		$targetOption = array();
		// Load the data
		if (empty( $this->_data )) 
		{
			$query = ' SELECT * FROM #__diashow where id = "'.$this->_id . '"';
			$this->_db->setQuery( $query );
			$this->_data['rows'] = $this->_db->loadObject();
		}
		if (!$this->_data) {
			$this->_data = new stdClass();
			$this->_data->id = 0;
		}
		
		// all pictures from /images/stories/diashow
		jimport( 'joomla.filesystem.folder' );
		$imageFiles = JFolder::files( JPATH_ROOT . '/images/stories/diashow', 'jpg$|gif$|png$', false, false, array('.jpg', '.gif'));
		
		$images = array();
		
		foreach ($imageFiles as $file)
		{
			$option[] = JHTML::_( 'select.option', $file );
		}
		
		$lists['imageFiles'] = JHTML::_('select.genericlist', $option, "image", "class=\"inputbox\" size=\"1\" onchange=\"changeImagePreview();\"", 'value', 'text', $this->_data['rows']->image);
		
		
		 // Targets
		$targetsArray = array('_blank', '_self', '_top');
		foreach ($targetsArray as $target)
		{
			$targetOption[] = JHTML::_( 'select.option', $target );
		}
		
		$lists['targets'] = JHTML::_('select.genericlist', $targetOption, "target", "class=\"inputbox\" size=\"1\" ", 'value', 'text', $this->_data['rows']->target);

		// Menus

		$menus = array();
		
		$menus[] = JHTML::_( 'select.option', '0', 'All');
		
		$query ="SELECT id , name , menutype FROM #__menu where published = '1' order by  menutype, ordering";
		$this->_db->setQuery( $query );
		$this->_rows = $this->_db->loadObjectList();
		
		
		foreach($this->_rows as $menu)
		{
			$menus[] = JHTML::_( 'select.option', $menu->id, $menu->name . " \t\t\t => " . $menu->menutype . "");
		}
		
		
		$query = "SELECT #__menu.id as value , #__menu.name, #__menu.menutype FROM #__diashow_visibility LEFT JOIN #__menu ON #__menu.id = menu_id WHERE diashow_id = '" . $this->_id . "'";
		
		$this->_db->setQuery( $query );
		$this->_selectedMenu = $this->_db->loadObjectList();
		 // if ALL is marked as where to show, set option selected 
		 if (isset($this->_selectedMenu))
		 {
			 foreach ($this->_selectedMenu as $val)
			 {
				if (!isset($val->value) )
			  	{
			 	$val->value = "0";
			    $val->menutype = "ALL";
			    $val->name = "All";
			  	}
		 	}
		 }
	 		
		$lists['menus'] = JHTML::_('select.genericlist', $menus, "wheretolink[]", "class=\"inputbox\" multiple=\"true\"" , 'value', 'text',  $this->_selectedMenu);

		$this->_data['lists'] = $lists;

		return $this->_data;
	}

	/**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function store()
	{
		$row =& $this->getTable('diashow');

		$data = JRequest::get( 'post' );

		// Bind the form fields to the table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure  record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		// Store to the database
		if (!$row->store()) {
			$this->setError( $row->getErrorMsg() );
			return false;
		}
 
 //diashow_visibility
		if ($data['id'])
		{
			$query = "delete from #__diashow_visibility where #__diashow_visibility.diashow_id = '" . $data['id'] . "'";
			$this->_db->setQuery( $query );
			$this->_db->loadObjectList();
				
			foreach ($data['wheretolink'] as $val)
			{
				$query = "insert into #__diashow_visibility (diashow_id, menu_id) values ('" . $data['id'] . "', '" . $val . "')";
				$this->_db->setQuery( $query );
				$this->_db->loadObjectList();
			}
		}
		else
		{
			foreach ($data['wheretolink'] as $val)
			{
				$query = "insert into #__diashow_visibility (diashow_id, menu_id) values ('" . $row->id . "', '" . $val . "')";
				$this->_db->setQuery( $query );
				$this->_db->loadObjectList();
			}
		}	
		
		return true;
	}

	/**
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$row =& JTable::getInstance('diashow', 'Table');

		if (count( $cids ))
		{
			foreach($cids as $cid) {
				if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}						
		}
		
		$row2 =& JTable::getInstance('diashow_visibility', 'Table');

		if (count( $cids ))
		{
			foreach($cids as $cid) {
				if (!$row2->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}						
		}
				
		return true;
	}
			


function getchangeData( $cid=null )
{
	global $mainframe;
	
	$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
	// Initialize variables
	$db =& JFactory::getDBO();
	$user =& JFactory::getUser();
	
	if (count( $this->_id)  < 1) 
	{
		$action = $this->publish ? 'publish' : 'unpublish';
		JError::raiseError(500, JText::_( 'Select an item to' .$action, true ) );
	}

	$cids = implode( ',', $cid );

	$query = 'UPDATE #__diashow'
	. ' SET published = ' . $this->publish
	. ' WHERE id IN ( '. $cids .' )'
	. ' AND ( checked_out = 0 OR ( checked_out = '. (int) $user->get('id') .' ) )'
	;
	$db->setQuery( $query );
	if (!$db->query()) 
	{
		JError::raiseError(500, $db->getErrorMsg() );
	}


	$mainframe->redirect( 'index.php?option=com_diashow&controller=managediashows&task=view' );
}


	function getOrderData( $cid=null )
	{
		global $mainframe;
		
		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		$db =& JFactory::getDBO();
		
		$row =& JTable::getInstance('diashow', 'Table');

		
		$row->load( $cid[0] );
		$row->move( $this->order, ' published != 0' );
		
		$mainframe->redirect( 'index.php?option=com_diashow&controller=managediashows&task=view' );
	}	


function getsaveOrderData( $cid=null )
{
	global $mainframe;
	
	$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );

	// Initialize variables
	$db =& JFactory::getDBO();
	$total = count( $cid );
	$order = JRequest::getVar( 'order', array(0), 'post', 'array' );
	JArrayHelper::toInteger($order, array(0));

	$row =& JTable::getInstance('diashow', 'Table');
	$groupings = array();

	// update ordering values
	for( $i=0; $i < $total; $i++ ) {
		$row->load( (int) $cid[$i] );
		// track categories
		$groupings[] = $row->catid;

		if ($row->ordering != $order[$i]) {
			$row->ordering = $order[$i];
			if (!$row->store()) {
				//TODO - convert to JError
				JError::raiseError(500, $db->getErrorMsg() );
			}
		}
	}

	// execute updateOrder for each parent group
	$groupings = array_unique( $groupings );
	foreach ($groupings as $group){
		$row->reorder('ordering = '.(int) $group);
	}

	$mainframe->redirect( 'index.php?option=com_diashow&controller=managediashows&task=view' );

}

}
