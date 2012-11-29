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
JHtml::_('behavior.framework');
JHtml::_('bootstrap.tooltip');

    $document = JFactory::getDocument();
    $document->addScript(JURI::base() . 'modules/mod_diashow/js/jquery.timers.min.js');
    $document->addScript(JURI::base() . 'modules/mod_diashow/js/jquery.mousewheel.min.js');
    $document->addScript(JURI::base() . 'modules/mod_diashow/js/jquery.diashow.min.js');			
    $document->addStyleSheet( JURI::base() . 'modules/mod_diashow/css/diashow.css', 'text/css', null, array( 'id' => 'StyleSheet' ) );
?>
<script type="text/javascript">
	var $jQ = jQuery.noConflict();
	
         $jQ(document).ready(function(){
    	
			var imgObject = new Array();
	
    <?php
    foreach($diaShowData as $val){
    $diaShow = "{imgName: '" . JURI::base() . 'images/diashow/' . $val->image . "', imgText: '" . preg_replace("/\n/", "", nl2br($val->title)) . "', imgLink: '" . $val->link . "', imgTarget: '" . $val->target . "'}";
    ?>                   
    imgObject.push(<?php echo $diaShow; ?>);
    <?php
    }
    ?>
	
	            $jQ('#ds_container').diaShow({
                imgObject: imgObject,
                containerBorder: '<?php echo $containerBorder; ?>',
                containerWidth: '<?php echo $containerWidth; ?>px',
                containerHeight: '<?php echo $containerHeight; ?>px',
                timerInterval: <?php echo $timerInterval; ?>,
				hintHeight: '<?php echo $hintHeight; ?>',
				showFullImage : {
        			showIt : <?php echo $showIt; ?>,
					xPos: '<?php echo $xPos; ?>',
					yPos: '<?php echo $yPos; ?>',
					height: '<?php echo $height; ?>',
					width: '<?php echo $width; ?>',
					borderCss: '<?php echo $borderCss; ?>'
					}
            });
        });// ready
</script>
	<div style="height: <?php echo $containerHeight; ?>px; width:<?php echo $containerWidth; ?>px; clear:both;">
        <div id="ds_container" title="<?php echo ($showIt) ? "Toggle mouse wheel for full view" : ""; ?>"></div>
		<div id="ds_fullView"></div>
	</div>
