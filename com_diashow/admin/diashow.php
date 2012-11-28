<?php
/*------------------------------------------------------------------------
# com_diashow - DiaShow4
# ------------------------------------------------------------------------
# author Ralf Weber
# copyright Copyright (C) 2011 http://www.weberr.de/. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.weberr.de/
# Technical Support: Forum - http://www.weberr.de/
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
if(!defined('DS')){
    define('DS',DIRECTORY_SEPARATOR);
}
// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_diashow'))
{
        return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// require helper file
JLoader::register('DiashowHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'diashow.php');

// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by Diashow
$controller = JControllerLegacy::getInstance('Diashow');

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();

?>
