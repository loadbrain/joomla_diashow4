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

// import Joomla controller library
jimport('joomla.application.component.controller');

/**
 * General Controller of Diashow component
 */
class DiashowController extends JControllerLegacy{
        /**
         * display task
         *
         * @return void
         */
        function display($cachable = false, $urlparams = false){
                // set default view if not set
                JRequest::setVar('view', JRequest::getCmd('view', 'diashows'));

                // call parent behavior
                parent::display($cachable);

                // Set the submenu
                DiashowHelper::addSubmenu('messages');

        }
}


?>
