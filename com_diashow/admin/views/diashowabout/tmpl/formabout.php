<?php 
/**
 * DiaShow
 * @author Ralf Weber (email ralf@weberr.de / site www.weberr.de)
 * @package DiaShow
 * @version     3.0
 * @copyright Copyright (C) 2008 LoadBrain
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 *
 * This is free software
 **/
defined('_JEXEC') or die('Restricted access');?>
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
		<legend><?php echo JText::_( 'DIASHOW_NAME' ) .  " " . JText::_( 'DIASHOW_VERSION') ; ?></legend>

		<table class="admintable" width="100%">
	<tr>
		<th><?php echo JText::_( 'DIASHOW_ABOUT_TITLE'); ?></td>
	</tr>
	</table>
	<br />
	
	<table border="0" cellspacing="2" cellpadding="2" class="adminform">
	<tr>
		<td valign="top">
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
			</p>
		</td>
		<td valign="top">
			<img src="./components/com_diashow/images/admin_loadbrain.gif" alt="" width="120" height="120" border="0" vspace="5" hspace="5">
			<br/><a href="http://www.loadbrain.de/" target="_blank">LoadBrain &copy;</a>
			<h4>HISTORY</h4>
			<p>Version 4.0.0 (06.04.2009)</p>
			<ul>
				<li>First Release</li>
			</ul>
		</td>
	</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>
<input type="hidden" name="theButton" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form>
