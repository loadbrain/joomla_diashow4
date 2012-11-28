<?php
/*------------------------------------------------------------------------
# com_diashow - DiaShow5 - Joomla 3.x
# ------------------------------------------------------------------------
# author Ralf Weber
# copyright Copyright (C) 2011 http://www.weberr.de/. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.weberr.de/
# Technical Support: Forum - http://www.weberr.de/
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
jimport( 'joomla.filesystem.folder' );
/**
 * DiashowModelAbout Model
 */
class DiashowModelAbout extends JModelList{
	

	
	/**
	 * Method to get RWCard Version
	 * @return string Version of RWCards
	 */
	function getDiashowVersion(){
		$folder = JPATH_ADMINISTRATOR .DS. 'components'.DS.'com_diashow';
		if (JFolder::exists($folder)) {
			$xmlFilesInDir = JFolder::files($folder, '.xml$');
		} else {
			$folder = JPATH_SITE .DS. 'components'.DS.'com_diashow';
			if (JFolder::exists($folder)) {
				$xmlFilesInDir = JFolder::files($folder, '.xml$');
			} else {
				$xmlFilesInDir = null;
			}
		}

		$xml_items = '';
		if (count($xmlFilesInDir))
		{
			foreach ($xmlFilesInDir as $xmlfile)
			{
				if ($data = JApplicationHelper::parseXMLInstallFile($folder.DS.$xmlfile)) {
					foreach($data as $key => $value) {
						$xml_items[$key] = $value;
					}
				}
			}
		}
		
		if (isset($xml_items['version']) && $xml_items['version'] != '' ) {
			return $xml_items['version'];
		} else {
			return '';
		}
	}	
	
}
?>
