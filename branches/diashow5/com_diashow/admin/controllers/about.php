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

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

/**
 * DiashowControllerAbout Controller
 */
class DiashowControllerAbout extends JControllerAdmin{

        /**
         * Proxy for getModel.
         * @since       1.6
         */
        public function getModel($name = 'Diashow', $prefix = 'DiashowModel'){
			
                $model = parent::getModel($name, $prefix, array('ignore_request' => true));
                return $model;
        }

}

?>
