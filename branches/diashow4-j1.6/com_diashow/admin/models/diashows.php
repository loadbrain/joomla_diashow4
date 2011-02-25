<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
jimport( 'joomla.filesystem.file' );

/**
 * DiashowsList Model
 */
class DiashowModelDiashows extends JModelList{

	protected function populateState()
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$accessId = $app->getUserStateFromRequest($this->context.'.filter.access', 'filter_access', null, 'int');
		$this->setState('filter.access', $accessId);

		$state = $app->getUserStateFromRequest($this->context.'.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $state);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_diashow');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('uc.name', 'asc');
	}

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery(){
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Select some fields
		$query->select('#__diashow.*');
		$query->from('#__diashow');

		// Filter by published state.
		$published = $this->getState('filter.state');
		if (is_numeric($published)) {
			$query->where('#__diashow.published = '.(int) $published);
		}
		else if ($published === '') {
			$query->where('(#__diashow.published IN (0, 1))');
		}

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0) {
				$query->where('#__diashow.id = '.(int) substr($search, 3));
			}
			else
			{
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
				$query->where('( #__diashow.title LIKE '.$search.')');
			}
		}

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		if ($orderCol != 'ordering') {
			$orderCol = 'ordering';
		}
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));
		//echo nl2br(str_replace('#__', 'jos_', $query->__toString()));
		return $query;
	}

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'Diashow', $prefix = 'DiashowTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	
	public function getMenuEntries(){
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Select some fields
		$query->select('#__diashow.*');
		$query->from('#__diashow');
		$query->order('ordering');
		$this->_data['rows'] = $db->loadObjectList();
		$linkedTo = array();
		
		// Put the corresponding menus in the array
		for ($i=0, $n=count( $this->_data['rows'] ); $i < $n; $i++)
		{
			$row = &$this->_data['rows'];
			
			$query = "SELECT distinct alias, menutype, diashow_id, menu_id FROM #__diashow_visibility LEFT JOIN  #__menu ON #__menu.id = menu_id WHERE diashow_id = " . $row[$i]->id . " order by #__menu.menutype, #__menu.ordering";
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
					$linkedTo[$i] .= $row[$a]->alias . " (" . $row[$a]->menutype . ")<br />"; 
			}
		}
		return $linkedTo;
	}


	public function getImages(){
		return JFolder::files(JFolder::makeSafe(JPATH_ROOT . "/images/diashow"), $filter= '.', $recurse=true );

	}

	public function getImageFolder(){
		if(!is_dir(JPath::clean(JPATH_ROOT . "/images/diashow"))){
			JFolder::create(JPATH_ROOT . "/images/diashow", 0777 );
		}
	}


}
?>