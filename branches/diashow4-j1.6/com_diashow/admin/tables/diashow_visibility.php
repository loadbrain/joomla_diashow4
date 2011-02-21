<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

/**
 * DiashowTableDiashow_visibility Table class
 */
class DiashowTableDiashow_visibility  extends JTable{
        /**
         * Constructor
         *
         * @param object Database connector object
         */
        function __construct(&$db){
                parent::__construct('#__diashow_visibility', 'id', $db);
        }
}
?>
