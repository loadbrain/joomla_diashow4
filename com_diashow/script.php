<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
 jimport( 'joomla.filesystem.folder' );

/**
 * Script file of DiaShow component
 */
class com_diashowInstallerScript
{
        /**
         * method to install the component
         *
         * @return void
         */
        function install($parent){
			if(!is_dir(JPath::clean(JPATH_ROOT . "/images/diashow"))){
				JFolder::create(JPATH_ROOT . "/images/diashow", 0777 );
				echo '<p>' . JText::_('COM_DIASHOW_INSTALL_IMAGE_DIRECTORY_TEXT') . '</p>';
			}
			// $parent is the class calling this method
			echo '<p>' . JText::_('COM_DIASHOW_INSTALL_TEXT') . '</p>';
			$parent->getParent()->setRedirectURL('index.php?option=com_diashow');
        }
 
        /**
         * method to uninstall the component
         *
         * @return void
         */
        function uninstall($parent) {
			if(is_dir(JPath::clean(JPATH_ROOT . "/images/diashow"))){
				JFolder::delete(JPATH_ROOT . "/images/diashow", 0777 );
				echo '<p>' . JText::_('COM_DIASHOW_UNINSTALL_IMAGE_DIRECTORY_TEXT') . '</p>';
			}
	
			// $parent is the class calling this method
            echo '<p>' . JText::_('COM_DIASHOW_UNINSTALL_TEXT') . '</p>';
        }
 
        /**
         * method to update the component
         *
         * @return void
         */
        function update($parent) 
        {
                // $parent is the class calling this method
                echo '<p>' . JText::_('COM_DIASHOW_UPDATE_TEXT') . '</p>';
        }
 
        /**
         * method to run before an install/update/uninstall method
         *
         * @return void
         */
        function preflight($type, $parent) 
        {
                // $parent is the class calling this method
                // $type is the type of change (install, update or discover_install)
                echo '<p>' . JText::_('COM_DIASHOW_PREFLIGHT_' . $type . '_TEXT') . '</p>';
        }
 
        /**
         * method to run after an install/update/uninstall method
         *
         * @return void
         */
        function postflight($type, $parent) 
        {
                // $parent is the class calling this method
                // $type is the type of change (install, update or discover_install)
                echo '<p>' . JText::_('COM_DIASHOW_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
        }
}
