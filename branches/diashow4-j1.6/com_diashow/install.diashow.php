<?php
/**
 * DiaShow
 * @author Ralf Weber (email ralf@weberr.de / site www.weberr.de)
 * @package DiaShow
 * @version     3.0
 * @copyright Copyright (C) 2008 LoadBrain
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 *
 * This is free software
 **/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


function com_install ()
{
	@chdir(JPATH_ROOT . "/images/stories/diashow");
	$oldumask = umask(0);
	@mkdir(JPATH_ROOT . "/images/stories/diashow/", 0777);
	umask($oldumask);
		 
?>
  <center>
  <table width="100%" border="0">
    <tr>
      <td><img src="components/com_diashow/images/admin_loadbrain.gif"></td>
      <td>
        <strong>Diashow - A Joomla Diashow Component</strong><br/>
        <font class="small">&copy; Copyright 2008 by <a href="http://www.loadbrain.de/" target="_blank">Ralf Weber - LoadBrain &copy;</a><br/>
        Released under the terms and conditions of the <a href="index2.php?option=com_admisc&task=license">GNU General Public License</a>.</font><br/>
      </td>
    </tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
    <tr>
      <td background="E0E0E0" style="border:1px solid #999;color:green;font-weight:bold;" colspan="2">Installation finished.</td>
    </tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
  </table>
  </center>
<?php	   
}
?>
