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
<form action="<?php echo JRoute::_('index.php?option=com_diashow&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="span10 form-horizontal">
		<div class="tab-content">
<?php

foreach($this->form->getFieldset('details') as $field): ?>
			<div class="control-group">
				<div class="control-label">
					<?php echo $field->label; ?>
					</div>
					<div class="controls">
						<?php echo $field->input; ?>
					</div>
				</div>
<?php endforeach; ?>	
			<div class="control-group">
				<div class="control-label">
					<label class="hasTip required" for="jform_menu_id" id="jform_menu_id-lbl"><?php echo JText::_('COM_DIASHOW_HEADING_SHOW_UNDER'); ?><span class="star">&nbsp;*</span></label>
				</div>
				<div class="controls">
					<?php echo $this->menu['lists']['menus'];?>
				</div>
			</div>			
	</div>
</div>

<input type="hidden" name="task" value="diashows.edit" /> <?php echo JHtml::_('form.token'); ?>
</form>
