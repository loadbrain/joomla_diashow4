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

JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_diashow.diashows');
$archived = $this -> state -> get('filter.published') == 2 ? true : false;
$trashed = $this -> state -> get('filter.published') == -2 ? true : false;
$params		= (isset($this->state->params)) ? $this->state->params : new JObject;
$saveOrder	= $listOrder == 'ordering';
if ($saveOrder) {
    $saveOrderingUrl = 'index.php?option=com_diashow&task=diashows.saveOrderAjax&tmpl=component';
    JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$sortFields = $this -> getSortFields();
?>
<script type="text/javascript">
	Joomla.orderTable = function() {
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>') {
			dirn = 'asc';
		} else {
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>
<div style="background:#F06534; padding: 5px; border: 1px solid black; color:#fff;font-weight:bold;">
	<?php echo JText::_('COM_DIASHOW_USAGE_HINT'); ?>
</div>
<br />

<form
	action="<?php echo JRoute::_('index.php?option=com_diashow&view=diashows'); ?>"
	method="post" name="adminForm" id="adminForm">
	<?php if (!empty($this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this -> sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php else : ?>
		<div id="j-main-container">
			<?php endif; ?>
			<div id="filter-bar" class="btn-toolbar">
				<div class="filter-search btn-group pull-left">
					<label for="filter_search" class="element-invisible"><?php echo JText::_('COM_DIASHOW_SEARCH_IN_TITLE'); ?></label>
					<input type="text" name="filter_search" id="filter_search"
						placeholder="<?php echo JText::_('COM_DIASHOW_SEARCH_IN_TITLE'); ?>"
						value="<?php echo $this -> escape($this -> state -> get('filter.search')); ?>"
						title="<?php echo JText::_('COM_DIASHOW_SEARCH_IN_TITLE'); ?>" />
				</div>
				<div class="btn-group pull-left">
					<button type="submit" class="btn hasTooltip"
						title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>"><i
							class="icon-search"></i></button>
					<button type="button" class="btn hasTooltip"
						title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>"
						onclick="document.id('filter_search').value='';this.form.submit();"><i
							class="icon-remove"></i></button>
				</div>
				<div class="btn-group pull-right hidden-phone">
					<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
					<?php echo $this -> pagination -> getLimitBox(); ?>
				</div>
				<div class="btn-group pull-right hidden-phone">
					<label for="directionTable" class="element-invisible"><?php echo JText::_('JFIELD_ORDERING_DESC'); ?></label>
					<select name="directionTable" id="directionTable" class="input-medium"
						onchange="Joomla.orderTable()">
						<option value=""><?php echo JText::_('JFIELD_ORDERING_DESC');?>
						</option>
						<option value="asc" <?php if ($listDirn == 'asc') {
    echo 'selected="selected"';
} ?>><?php echo JText::_('JGLOBAL_ORDER_ASCENDING');?>
						</option>
						<option value="desc" <?php if ($listDirn == 'desc') {
    echo 'selected="selected"';
} ?>><?php echo JText::_('JGLOBAL_ORDER_DESCENDING');?>
						</option>
					</select>
				</div>
				<div class="btn-group pull-right">
					<label for="sortTable" class="element-invisible"><?php echo JText::_('JGLOBAL_SORT_BY'); ?></label>
					<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
						<option value=""><?php echo JText::_('JGLOBAL_SORT_BY'); ?>
						</option>
						<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder); ?>
					</select>
				</div>
			</div>
			<div class="filter-select fltrt">

				<select name="filter_published" class="inputbox" onchange="this.form.submit()">
					<option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?>
					</option>
					<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions', array('archived' => 0, 'trash' => 0)), 'value', 'text', $this->state->get('filter.state'), true);?>
				</select>
			</div>
			<div class="clr"> </div>
			<table class="table table-striped" id="articleList">
				<thead>
					<tr>
						<th width="1%" class="nowrap center hidden-phone">
							<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
						</th>
						<th width="1%" class="hidden-phone">
							<input type="checkbox" name="checkall-toggle" value=""
								title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>"
								onclick="Joomla.checkAll(this)" />
						</th>
						<th width="1%" class="nowrap center">
							<?php echo JHtml::_('grid.sort', 'JSTATUS', 'published', $listDirn, $listOrder); ?>
						</th>
						<th>
							<?php echo JHtml::_('grid.sort', 'COM_DIASHOW_DIASHOW_HEADING_TITLE', 'title', $listDirn, $listOrder); ?>
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
						<th width="1%" class="nowrap center hidden-phone">
							<?php echo JText::_('JGRID_HEADING_ID'); ?>
						</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="10"><?php echo $this -> pagination -> getListFooter(); ?>
						</td>
					</tr>
				</tfoot>
				<tbody>

					<?php foreach ($this->items as $i => $item):
$ordering	= ($listOrder == 'ordering');
$canCreate  = $user->authorise('core.create', 'com_diashow.diashows.' . $item->id);
$canEdit    = $user->authorise('core.edit', 'com_diashow.diashows.' . $item->id);
$canCheckin = $user->authorise('core.manage', 'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
$canChange  = $user->authorise('core.edit.state', 'com_diashow.diashows.' . $item->id) && $canCheckin;
?>
					<tr class="row<?php echo $i % 2; ?>"
						sortable-group-id="<?php echo $item->id?>">
						<td class="order nowrap center hidden-phone">
							<?php if ($canChange) :
                        $disableClassName = '';
                        $disabledLabel	  = '';
                        if (!$saveOrder) :
                            $disabledLabel    = JText::_('JORDERINGDISABLED');
                            $disableClassName = 'inactive tip-top';
                        endif; ?>
							<span
								class="sortable-handler hasTooltip <?php echo $disableClassName?>"
								title="<?php echo $disabledLabel?>">
								<i class="icon-menu"></i>
							</span>
							<input type="text" style="display:none" name="order[]" size="5"
								value="<?php echo $item->ordering; ?>"
								class="width-20 text-area-order " />
							<?php else : ?>
							<span class="sortable-handler inactive">
								<i class="icon-menu"></i>
							</span>
							<?php endif; ?>
						</td>
						<td class="center hidden-phone">
							<?php echo JHtml::_('grid.id', $i, $item -> id); ?>
						</td>
						<td align="center">
							<?php echo JHtml::_('jgrid.published', $item -> published, $i, 'diashows.'); ?>
						</td>
						<td class="nowrap has-context">
							<div class="pull-left">
								<?php if ($item->checked_out) : ?>
								<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item -> checked_out_time, 'diashows.', $canCheckin); ?>
								<?php endif; ?>

								<?php if ($canEdit) {?>
								<a
									href="<?php echo JRoute::_('index.php?option=com_diashow&task=diashow.edit&id=' . $item -> id); ?>"><?php echo JTEXT::_($item->title) ?></a>
								<?php } else {
                            echo JTEXT::_($item->title);
                        }
                ?>
							</div>
							<div class="pull-left">
								<?php // Create dropdown items
                            JHtml::_('dropdown.edit', $item -> id, 'diashow.');
                            JHtml::_('dropdown.divider');
                            if ($item -> title) :
                                JHtml::_('dropdown.unpublish', 'cb' . $i, 'diashows.');
                            else :
                                JHtml::_('dropdown.publish', 'cb' . $i, 'diashows.');
                            endif;

                            JHtml::_('dropdown.divider');

                            if ($archived) :
                                JHtml::_('dropdown.unarchive', 'cb' . $i, 'diashows.');
                            else :
                                JHtml::_('dropdown.archive', 'cb' . $i, 'diashows.');
                            endif;

                            if ($item -> checked_out) :
                                JHtml::_('dropdown.checkin', 'cb' . $i, 'diashows.');
                            endif;

                            if ($trashed) :
                                JHtml::_('dropdown.untrash', 'cb' . $i, 'diashows.');
                            else :
                                JHtml::_('dropdown.trash', 'cb' . $i, 'diashows.');
                            endif;

                            // render dropdown list
                            echo JHtml::_('dropdown.render');
                                ?>
							</div>
						</td>
						<td>
							<?php echo "<img src='../images/diashow/" .  $item->image . "' />"; ?>

						</td>
						<td>
							<?php echo $item->link; ?>
						</td>
						<td>
							<?php echo $item->target; ?>
						</td>
						<td>
							<?php echo $this->menu[$item->id]; ?>
						</td>
						<td align="center">
							<?php echo JHtml::_('jgrid.published', $item -> published, $i, 'diashows.'); ?>
						</td>
						<td class="center hidden-phone">
							<?php echo JTEXT::_($item->id); ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div>
				<input type="hidden" name="task" value="" />
				<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="filter_order"
					value="<?php echo $listOrder; ?>" />
				<input type="hidden" name="filter_order_Dir"
					value="<?php echo $listDirn; ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</div>

</form>
