<?php
    $document = &JFactory::getDocument();
    $document->addScript(JURI::base() . 'modules/mod_diashow/js/jquery-1.3.2.min.js');
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
    $diaShow = "{imgName: '" . JURI::base() . 'images/diashow/' . $val->image . "', imgText: '" . ereg_replace("\n", "", nl2br($val->title)) . "', imgLink: '" . $val->link . "', imgTarget: '" . $val->target . "'}";
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
