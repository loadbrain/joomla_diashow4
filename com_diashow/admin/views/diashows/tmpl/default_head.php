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
$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$canOrder	= $user->authorise('core.edit.state', 'com_diashow.diashows');
$saveOrder	= 'ordering';
?>
        <th width="5">
                <?php echo JText::_('COM_DIASHOW_DIASHOW_HEADING_ID'); ?>
        </th>
        <th width="20">
        <?php if ($this->canDo->get('core.edit')){ ?>
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
        <?php }?>
        </th>
        <th>
                <?php echo JText::_('COM_DIASHOW_DIASHOW_HEADING_TITLE'); ?>
        </th>
        <th>
                <?php echo JText::_('COM_DIASHOW_DIASHOW_HEADING_IMAGE'); ?>
        </th>
        <th>
                <?php echo JText::_('COM_DIASHOW_DIASHOW_HEADING_LINK'); ?>
        </th>
        <th>
                <?php echo JText::_('COM_DIASHOW_DIASHOW_HEADING_TARGET'); ?>
        </th>
        <th>
                <?php echo JText::_('COM_DIASHOW_HEADING_SHOW_UNDER'); ?>
        </th>
        <th>
                <?php echo JText::_('COM_DIASHOW_HEADING_PUBLISHED'); ?>
        </th>
        <th>
            <?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ORDERING', 'ordering', $listDirn, $listOrder);
		if ($canOrder && $saveOrder) {
			echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'diashows.saveorder');
		} ?>
        </th>
</tr>
