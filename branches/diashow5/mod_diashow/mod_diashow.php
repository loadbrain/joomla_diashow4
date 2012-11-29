<?php
/*------------------------------------------------------------------------
# mod_diashow - DiaShow4
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
require_once (dirname(__FILE__).DS.'helper.php');
$diaShowData = modDiashowHelper::getDiaShowData($params);
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


require(JModuleHelper::getLayoutPath('mod_diashow'));

?>