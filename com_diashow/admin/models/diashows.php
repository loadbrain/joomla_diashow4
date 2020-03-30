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
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
jimport('joomla.filesystem.file');

/**
 * DiashowsList Model
 */
class DiashowModelDiashows extends JModelList
{

    /**
     * Constructor.
     *
     * @param	array	An optional associative array of configuration settings.
     * @see		JController
     * @since	1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'title', 'a.title',
                'link', 'a.link',
                'checked_out', 'a.checked_out',
                'checked_out_time', 'a.checked_out_time',
                'ordering', 'a.ordering',
                'published', 'a.published'
            );
        }

        parent::__construct($config);
    }
    
    protected function populateState($ordering = null, $direction = null)
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
        // List state information.
        parent::populateState('ordering', 'asc');
    }

    /**
     * Method to build an SQL query to load the list data.
     *
     * @return      string  An SQL query
     */
    protected function getListQuery()
    {
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
        } elseif ($published === '') {
            $query->where('(#__diashow.published IN (0, 1))');
        }

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('#__diashow.id = '.(int) substr($search, 3));
            } else {
                $search = $db->Quote('%'.$db->escape($search, true).'%');
                $query->where('( #__diashow.title LIKE '.$search.' OR #__diashow.link LIKE '.$search.')');
            }
        }

        // Add the list ordering clause.
        $orderCol	= $this->state->get('list.ordering', 'ordering');
        $orderDirn	= $this->state->get('list.direction', 'ASC');
        if ($orderCol == 'id' || $orderCol == 'title') {
            $orderCol = 'title '.$orderDirn.', ordering';
        }
        $query->order($db->escape($orderCol.' '.$orderDirn));
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

    
    public function getMenuEntries()
    {
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
        for ($i=0, $n=count($this->_data['rows']); $i < $n; $i++) {
            $row = &$this->_data['rows'];

            if (isset($row[0]->id)) {
                $query = "SELECT distinct alias, menutype, diashow_id, menu_id FROM #__diashow_visibility LEFT JOIN  #__menu ON #__menu.id = menu_id WHERE diashow_id = " . $row[$i]->id . " order by #__menu.menutype";
            } else {
                $query = "SELECT distinct alias, menutype, diashow_id, menu_id FROM #__diashow_visibility LEFT JOIN  #__menu ON #__menu.id = menu_id order by #__menu.menutype";
            }
    
            $this->_db->setQuery($query);
            $this->_whereToShow = $this->_db->loadObjectList();
            
            for ($a=0, $b=count($this->_whereToShow); $a < $b; $a++) {
                $row = &$this->_whereToShow;

                if ($row[$a]->menu_id == 0) {
                    $linkedTo[$row[$a]->diashow_id]  = JText::_('DIASHOW_SHOW_ON_ALL_PAGES') . "<br />";
                    continue;
                }
                @$linkedTo[$row[$a]->diashow_id] .= $row[$a]->alias . " (" . $row[$a]->menutype . ")<br />";
            }
        }
        return $linkedTo;
    }


    public function getImages()
    {
        return JFolder::files(JFolder::makeSafe(JPATH_ROOT . "/images/diashow"), $filter= '.', $recurse=true);
    }

    public function getImageFolder()
    {
        if (!is_dir(JPath::clean(JPATH_ROOT . "/images/diashow"))) {
            JFolder::create(JPATH_ROOT . "/images/diashow", 0777);
        }
    }
}
