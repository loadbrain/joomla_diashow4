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
defined('_JEXEC') or die('Restricted access');

// load tooltip behavior
JHtml::_('behavior.tooltip');
?>
<div id="j-main-container">
	<form
		action="<?php echo JRoute::_('index.php?option=com_diashow'); ?>"
		method="post" name="adminForm">
		<table class="adminlist">
			<thead>
				<tr>
					<td colspan="2" style="font-weight:bold;"><?php echo JText::_('COM_DIASHOW_ABOUT_HEADING_VERSION'); ?>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr class="row<?php $i=0; $i++; echo $i % 2; ?>">
					<td><?php echo $this->version; ?>
					</td>
				</tr>
			</tbody>
		</table>
		<br />
		<table class="adminlist">
			<thead>
				<tr>
					<td colspan="2" style="font-weight:bold;"><?php echo JText::_('COM_DIASHOW_ABOUT_HEADING_INFOS'); ?>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="2">
						<a href="http://www.weberr.de/" target="_blank"><?php echo JText::_('COM_DIASHOW_ABOUT_HOMEPAGE'); ?></a><br />
					</td>
				</tr>
			</tbody>
		</table>
		<br />
		<table class="adminlist">
			<tbody>

				<tr>
					<td>
						<h4>How to</h4>
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
										<li>under which menu entries this image will be shown (all or one or several of
											you menu entries)</li>
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
							And finally: <a href="http://www.weberr.de/" target="_blank">Donation</a> are always
							welcome... :-)
						</p>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">DiaShow Version <?php echo $this->version; ?> - &copy 2012</td>
				</tr>
			</tfoot>
		</table>
		<div>
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<?php echo JHtml::_('form.token'); ?>
		</div>

	</form>
</div>
