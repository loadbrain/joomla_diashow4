<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
	<tr>
		<td>
			<div id="image">
					<?php
					if ($this->canDo->get('core.edit')){
					foreach($this->form->getFieldset('image') as $field): ?>
						<?php if (!$field->hidden): ?>
							<?php echo $field->label; ?>
						<?php endif; ?>
						<?php echo $field->input; ?>
					<?php endforeach;
					}
					?>
				</div>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td><h3><?php echo JText::_('COM_DIASHOW_UPLOAD_EXISTING_IMAGES'); ?></h3></td>
	</tr>
	</table>

<?php
				$i=0;
				$breite = 160;
				$hoehe = 120; 
				echo "<table border='0' cellspacing='5' cellpadding='5' width='100%'><tr>";
				foreach ($this->images as $val)
				{
					$size = getimagesize(JPATH_ROOT . "/images/diashow/" . $val);
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
echo "<td><img src='../images/diashow/" . $val . "' width=' . $sizemin[0]  . ' height=' . $sizemin[1] . ' align=top style='padding:5px; margin:5px; border:1px solid black; background-color:#ffffff;'><br>" . JText::_( 'UPLOAD_IMAGE_NAME' ) . ": " .  $val . "</td>";					
$i++;
}
				
					echo ($i % 5 == 0) ? "</tr><tr>" : "";
					
				}
				 //echo ($i % 5 == 0) ? "</tr>" : "";
				 ?>
				 </tr></table>


