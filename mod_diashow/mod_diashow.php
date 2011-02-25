<?php
/**
* @version		4.00
* @copyright	Copyright (C) 2008 LoadBrain <http://www.loadbrain.de/>. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$containerWidth = (int) $params->get( 'slideshow_width' );
$containerHeight = (int) $params->get( 'slideshow_height' );
$containerBorder = trim($params->get( 'containerBorder' ));
$hintHeight =  trim($params->get( 'hintHeight' ));
$showIt = trim($params->get( 'showIt' ));
$xPos = trim($params->get( 'xPos' ));
$yPos = trim($params->get( 'yPos' ));
$height = trim($params->get( 'height' ));
$width = trim($params->get( 'width' ));
$borderCss = trim($params->get( 'borderCss' ));
$timerInterval = (int)$params->get( 'delay' );
$optionalRandomOrder 	= trim($params->get( 'optionalRandomOrder') );
$moduleclass_sfx = trim($params->get( 'moduleclass_sfx') );

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');
$diaShowData = modDiashowHelper::getDiaShowData($params);
require(JModuleHelper::getLayoutPath('mod_diashow'));

?>