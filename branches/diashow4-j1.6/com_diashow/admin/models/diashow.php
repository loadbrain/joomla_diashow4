<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

/**
 * Diashow Model
 */
class DiashowModelDiashow extends JModelAdmin{
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param       type    The table type to instantiate
	 * @param       string  A prefix for the table class name. Optional.
	 * @param       array   Configuration array for model. Optional.
	 * @return      JTable  A database object
	 * @since       1.6
	 */
	public function getTable($type = 'Diashow', $prefix = 'DiashowTable', $config = array()){

		return JTable::getInstance($type, $prefix, $config);
	}


	function save(){

		$db =& JFactory::getDBO();
		$data = JRequest::get( 'post' );

		$row = $this->getTable();
		$diashowVisTable = JTable::getInstance('Diashow_visibility', 'DiashowTable');
		//$row =& $this->getTable('diashow');
		//var_dump($data); exit;
		if ($data["jform"]["id"] != ""){
			$row->load($data['jform']['id']);
			$row->bind($data['jform']);
			$row->store();
			$query = "delete from #__diashow_visibility where #__diashow_visibility.diashow_id = '" . (int)$data["jform"]['id'] . "'";
			$db->setQuery( $query );
			$db->loadObjectList();

			foreach ($data['wheretolink'] as $val)
			{
				$query = "insert into #__diashow_visibility (diashow_id, menu_id) values ('" . $data["jform"]['id'] . "', '" . $val . "')";
				$db->setQuery( $query );
				$db->loadObjectList();
			}
		}
		else
		{
			$query = "insert into #__diashow (title, image, link, target, published) values ('". $data['jform']['title'] . "', '" . $data['jform']['image'] . "', '". $data['jform']['link'] . "', '" . $data['jform']['target'] . "', '". $data['jform']['published']. "')";
			$db->setQuery($query);
			$db->loadObjectList();
			$diaShowId = $db->insertid();
			foreach ($data['wheretolink'] as $val)
			{
				$query = "insert into #__diashow_visibility (diashow_id, menu_id) values ('" . $diaShowId . "', '" . $val . "')";
				$db->setQuery( $query );
				$db->loadObjectList();
			}
		}
		return true;
	}
	/**
	 * Method to get the record form.
	 *
	 * @param       array   $data           Data for the form.
	 * @param       boolean $loadData       True if the form is to load its own data (default case), false if not.
	 * @return      mixed   A JForm object on success, false on failure
	 * @since       1.6
	 */
	public function getForm($data = array(), $loadData = true){
		// Get the form.
		$form = $this->loadForm('com_diashow.diashow', 'diashow', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)){
			return false;
		}
		return $form;
	}

	/**
	 * Method to get the script that have to be included on the form
	 *
	 * @return string       Script files
	 */
	public function getScript()
	{
		return 'administrator/components/com_diashow/models/forms/diashow.js';
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return      mixed   The data for the form.
	 * @since       1.6
	 */
	protected function loadFormData(){
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_diashow.edit.diashow.data', array());
		if (empty($data)){
			$data = $this->getItem();
			$this->new = true;
		}
		return $data;
	}


	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param	object	A record object.
	 * @return	boolean	True if allowed to delete the record. Defaults to the permission set in the component.
	 * @since	1.6
	 */
	protected function canDelete($record){
		$user = JFactory::getUser();

		if (!empty($record->id)) {
			$row = JTable::getInstance('Diashow_visibility', 'DiashowTable');
			$row->delete($record->id);
			return $user->authorise('core.delete', 'com_diashow');
		}
		else {
			return parent::canDelete($record);
		}
	}


	/**
	 * Method to get the menu entries
	 * @return string       Script files
	 */
	public function getMenu(){
		$menus = array();
		$data = $this->loadFormData();

		$menus[] = JHTML::_( 'select.option', '0', 'All');

		$query ="SELECT id , alias , menutype FROM #__menu where published = '1' order by  menutype, ordering";
		$this->_db->setQuery( $query );
		$this->_rows = $this->_db->loadObjectList();


		foreach($this->_rows as $menu)
		{
			$menus[] = JHTML::_( 'select.option', $menu->id, $menu->alias . " \t\t\t => " . $menu->menutype . "");
		}

		if($data->id == ""){
			$data->id = 0;
		}
		$query = "SELECT #__menu.id as value , #__menu.alias, #__menu.menutype FROM #__diashow_visibility LEFT JOIN #__menu ON #__menu.id = menu_id WHERE diashow_id = '" . $data->id . "'";

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

		$lists['menus'] = JHTML::_('select.genericlist', $menus, "wheretolink[]", "class=\"inputbox validate-menu_id required\" aria-invalid=\"true\" multiple=\"true\"" , 'value', 'text',  $this->_selectedMenu);

		$this->_data['lists'] = $lists;

		return $this->_data;
	}
}
?>
