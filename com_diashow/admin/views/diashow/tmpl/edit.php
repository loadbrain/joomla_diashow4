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
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//$params = $this->form->getFieldsets('params');

?>
<form
	action="<?php echo JRoute::_('index.php?option=com_diashow&layout=edit&id='.(int) $this->item->id); ?>"
	method="post" name="adminForm" id="diashow-form" class="form-validate">
<div class="width-60 fltlft">
<fieldset class="adminform"><legend><?php echo JText::_( 'COM_DIASHOW_DETAILS' ); ?></legend>
<ul class="adminformlist">
<?php

foreach($this->form->getFieldset('details') as $field): ?>
	<li><?php echo $field->label;echo $field->input;?></li>
	<?php endforeach; ?>
	<li><label class="hasTip required" for="jform_menu_id" id="jform_menu_id-lbl"><?php echo JText::_('COM_DIASHOW_HEADING_SHOW_UNDER'); ?><span class="star">&nbsp;*</span></label><?php echo $this->menu['lists']['menus'];?></li>
</ul>

</div>

<input type="hidden" name="task" value="diashows.edit" /> <?php echo JHtml::_('form.token'); ?>
</div>
</form>