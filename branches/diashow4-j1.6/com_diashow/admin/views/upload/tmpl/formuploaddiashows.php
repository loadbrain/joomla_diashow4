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

<style type="text/css">
table.admintable td.key
{
	background-color: #f6f6f6;
	text-align: left;
	width:100%;
	color: #666;
	font-weight: bold;
	border-bottom: 1px solid #e9e9e9;
	border-right: 1px solid #e9e9e9;
}
</style>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td class="key">
				<?php echo JText::_( 'UPLOAD_DIASHOWS_TEXT' ); ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'UPLOAD_AVAILABLE_PICTURES' ); ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php 
				$i = 0;
				$breite = 160;
				$hoehe = 120; 
				echo "<table border='0' cellspacing='5' cellpadding='5' width='100%'><tr>";
				foreach ($this->diashowImages as $val)
				{
					$size = getimagesize(JPATH_ROOT . "/images/stories/diashow/" . $val);
				   // zugross & quer
				   if ($size[0] > $breite && $size[1] > $hoehe  && $size[0] >= $size[1]) 
				   {
						if ($size[0] == $size[1])
						{
							$sizemin[0] = $breite;
							$sizemin[1] = $breite;
						}  
						else
						{
							$sizemin[0] = $breite;
							$sizemin[1] = $hoehe;
						}
				   }
				   // zugross & hochkant
				   else if ($size[0] > $breite && $size[1] > $hoehe && $size[1] > $size[0]) 
				   {
						  $sizemin[0] = $hoehe;
						  $sizemin[1] = $breite;
				   }
				   // breite zu gross:
				   else if ($size[0] > $breite )
				   {
						  $sizemin[0] = $breite;
						  $sizemin[1] = $size[1];
				   }
				   // hoehe zu gross:
				   else if ($size[1] > $hoehe )
				   {
						  $sizemin[0] = $size[0];
						  $sizemin[1] = $hoehe;
				   }
				   // bild ok:
				   else 
				   {
						  $sizemin[0] = $sizemin[0];
						  $sizemin[1] = $sizemin[1];
				   }		

if (preg_match("/jpg$|gif$|png$/", $val))
{
echo "<td><img src='../images/stories/diashow/" . $val . "' width=' . $sizemin[0]  . ' height=' . $sizemin[1] . ' align=top style='padding:5px; margin:5px; border:1px solid black; background-color:#ffffff;'><br>" . JText::_( 'UPLOAD_IMAGE_NAME' ) . ": " .  $val . "</td>";					
$i++;
}
				
					echo ($i % 5 == 0) ? "</tr><tr>" : "";
					
				}
				 //echo ($i % 5 == 0) ? "</tr>" : "";
				 ?>
				 </tr></table>
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_diashow" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="manageuploaddiashows" />
</form>
