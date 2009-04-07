<?php
/**
 * DiaShow
 * @author Ralf Weber (email ralf@weberr.de / site www.weberr.de)
 * @package DiaShow
 * @version     $Id$
 * @copyright Copyright (C) 2008 LoadBrain
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 *
 * This is free software
 **/

// no direct access
defined('_JEXEC') or die('Restricted access');


class Tablediashow_visibility  extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $diashow_id = null;
	/** @var int*/
	var $menu_id = '';


	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(& $db) {
		parent::__construct('#__diashow_visibility', 'diashow_id', $db);
	}
}
?>
