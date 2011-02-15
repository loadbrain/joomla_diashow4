<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// require helper file
JLoader::register('DiashowHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'diashow.php');

// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by Diashow
$controller = JController::getInstance('Diashow');

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();

?>
