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
defined( '_JEXEC' ) or die( 'Restricted access' );


function com_uninstall ()
{
	echo "Component successfully uninstalled.<br /><br />";
	echo "<p style='font-family:Verdana; size: 12px;'>Please keep in mind that the <code>/images/stories/diashow/</code> directory is <strong>NOT</strong> deleted. You have to do this by hand, if you will deinstall the component completly. If you upgrade, your images are all still there.</p><br /><br />";
	echo "<p style=\"text-align:center;\">&copy; Copyright 2008 by Ralf Weber - <a href=\"http://www.weberr.de\" target=\"_blank\">LoadBrain</a></p>";
}
?>
