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


class Tablediashow  extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	/** @var string*/
	var $title = '';	
	/** @var string */
	var $image = '';
	/** @var string */
	var $link = '';	
	/** @var string */
	var $target = '';	
	/** @var int */
	var $checked_out		= 0;
	/** @var date */
	var $checked_out_time	= 0;
	/** @var int */
	var $published			= 1;	
	/** @var int */
	var $ordering			= 1;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(& $db) {
		parent::__construct('#__diashow', 'id', $db);
	}
}
?>
