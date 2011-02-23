<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
 
// load tooltip behavior
JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_diashow'); ?>" method="post" name="adminForm">
<table class="adminlist">
	<thead>
		<tr>                    
		<td colspan="2" style="font-weight:bold;"><?php echo JText::_('COM_DIASHOW_ABOUT_HEADING_VERSION'); ?></td>      
	</tr>
	</thead>
	<tbody>
		<tr class="row<?php $i++; echo $i % 2; ?>">
			<td><?php echo $this->version; ?></td>
		</tr>
	</tbody>
</table>
<br/>
<table class="adminlist">
	<thead>
		<tr>                    
		<td colspan="2" style="font-weight:bold;"><?php echo JText::_('COM_DIASHOW_ABOUT_HEADING_INFOS'); ?></td>      
	</tr>
	</thead>
	<tbody>
	<tr>
		<td colspan="2" >
			<a href="http://www.weberr.de/" target="_blank"><?php echo JText::_('COM_DIASHOW_ABOUT_HOMEPAGE'); ?></a><br/>
			<a href="http://www.weberr.de/index.php/forum.html" target="_blank"><?php echo JText::_('COM_DIASHOW_ABOUT_FORUM'); ?></a><br/>
			<a href="http://www.weberr.de/index.php/downloads-mainmenu-27.html" target="_blank"><?php echo JText::_('COM_DIASHOW_ABOUT_NEW_VERSION'); ?></a>
		</td>
	</tr>
	</tbody>
</table>
<br/>				
<table class="adminlist">
	<tbody>

		<tr>
                <td>			<h4>How to</h4>
			<p>
				<ul>
					<li>Define the position and other parameters of your DiaShow with the module:</li>
                                        	<ul>
							<li>width of the slideshow</li>
							<li>height of the slideshow</li>
							<li>The width of the image border</li>
							<li>The color of the image border</li>
                                                        <li>The bgcolor of the textfield</li>
                                                        <li>Delay between image change, in milliseconds </li>
                                                        <li>to show pictures in random order</li>
						</ul>
					<li>Create different DiaShows with the component</li>
					<li>You can define for each picture in the Diashow if it should have:
						<ul>
							<li>a title for the image</li>
							<li>where the image is linked to (URL)</li>
							<li>the target of the link</li>
							<li>under which menu entries this image will be shown (all or one or several of you menu entries)</li>
						</ul>
					</li>
				</ul>
			</p>
			<p>
				So you can define several DiaShows, all showing different images on different pages!
				<br />
				Or simply all pictures on all pages... :-)
			</p>
			<p>
				If you have questions, please use the forum on my site <a href="http://www.loadbrain.de/" target="_blank">LoadBrain &copy;</a> or send me an email from the contact menu there.
			</p>
			<p>
				And finally: <a href="http://www.loadbrain.de/" target="_blank">Donation</a> are always welcome... :-)
			</p></td>                
        </tr>                                                        
	</tbody>
    <tfoot>
					<tr>
						<td colspan="4">DiaShow Version <?php echo $this->version; ?> - &copy 2011</td>
					</tr>
				</tfoot>
        </table>
        <div>
                <input type="hidden" name="task" value="" />
                <input type="hidden" name="boxchecked" value="0" />
                <?php echo JHtml::_('form.token'); ?>
        </div>
      
</form>
