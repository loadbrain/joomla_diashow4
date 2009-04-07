<?php
/**
 * DiaShow
 * @author Ralf Weber (email ralf@weberr.de / site www.weberr.de)
 * @package DiaShow
 * @version    3.0
 * @copyright Copyright (C) 2008 LoadBrain
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 *
 * This is free software
 **/

defined('_JEXEC') or die('Restricted access');?>
<?php
 $arr = array(
JHTML::_('select.option',  '0', JText::_( NO ) ),
JHTML::_('select.option',  '1', JText::_( YES ) )
);
?>
<style type="text/css">
table.admintable td.key
{
	background-color: #f6f6f6;
	text-align: left;
	width:200px;
	color: #666;
	font-weight: bold;
	border-bottom: 1px solid #e9e9e9;
	border-right: 1px solid #e9e9e9;
}

#otherImageChosen
{
	color:red;
	font-weight:bold;
}
</style>
<script language="JavaScript">
function changeImagePreview()
{
	if (document.adminForm.imageFile.value !='')
	{
		document.images['imageFile'].src = '../images/stories/diashow/' + document.adminForm.picture.value;
		document.getElementById('otherImageChosen').innerHTML = document.adminForm.picture.value;
		document.getElementById('originalImage').style.color = "green;"
		document.getElementById('originalImage').innerHTML = "<?php echo JText::_( 'ECARD_ORIGINAL_PICTURE' ) . '<br/>' . $this->rwcards['rows']->picture; ?>";
	}
	else
	{
		document.images['imageFile'].src = 'images/blank.png';
	}
}
</script>
<form action="index.php?option=com_diashow&controller=managediashows" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'DIASHOW_NAME' ); ?></legend>
		<table class="admintable">
			<tbody>
			<tr>
				<td width="100" align="right" class="key">
					<label for="title">
						<?php echo JText::_( 'DIASHOW_EDIT_HEADER' ); ?>:
					</label>
				</td>
				<td>
			<input class="text_area" type="text" name="title" id="title" size="32" maxlength="250" value="<?php echo $this->diaShows['rows']->title;?>" />
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key">
					<label for="image">
						<?php echo JText::_( 'DIASHOW_IMAGE' ); ?>:
					</label>
				</td>
				<td>
					<?php echo $this->diaShows['lists']['imageFiles'];?><div id="imagePreview" style="margin-top:10px; clear:none;"></div>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" valign="top" class="key">
					<label for="link">
						<?php echo JText::_( 'DIASHOW_lINK' ); ?>:
					</label>
				</td>
				<td>
			<input class="text_area" type="text" name="link" id="link" size="32" maxlength="250" value="<?php echo $this->diaShows['rows']->link;?>" />
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key">
					<label for="target">
						<?php echo JText::_( 'DIASHOW_TARGET' ); ?>:
					</label>
				</td>
				<td>
					<?php echo $this->diaShows['lists']['targets'];?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" valign="top" class="key">
					<label for="picture">
						<?php echo JText::_( 'DIASHOW_SHOW_UNDER' ); ?>
					</label>
				</td>
				<td>
					<?php echo $this->diaShows['lists']['menus'];?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<label for="published">
						<?php echo JText::_( 'PUBLISH' ); ?>:
					</label>
				</td>
				<td>
					<?php echo JHTML::_('select.radiolist',  $arr, "published", $attribs, 'value', 'text', (int) $this->diaShows['rows']->published, $id ); ?>
				</td>
		</tr>
			</tbody>
			</table>
		</fieldset>
</div>
 <script>
 if ( document.getElementById('imagePreview').innerHTML == "")
 {
document.getElementById('imagePreview').innerHTML = '<img src=../images/stories/diashow/' + document.adminForm.image.options[document.adminForm.image.selectedIndex].value;
	}

 		function changeImagePreview()
		{
			if (document.adminForm.image.value !='')
			{
				document.getElementById('imagePreview').innerHTML = '<img src=../images/stories/diashow/' + document.adminForm.image.options[document.adminForm.image.selectedIndex].value;
			}
			else
			{
				document.getElementById('imagePreview').innerHTML = '<img src=../images/stories/diashow/' + document.adminForm.image.options[0].value;
			}
		}

	</script>
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="id" value="<?php echo $this->diaShows['rows']->id; ?>" />
<input type="hidden" name="cid[]" value="<?php echo $this->diaShows['rows']->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="managediashows" />
</form>
