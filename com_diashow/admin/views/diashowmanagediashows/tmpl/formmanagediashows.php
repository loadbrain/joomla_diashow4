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
defined('_JEXEC') or die('Restricted access');


	$user =& JFactory::getUser();
	JHTML::_('behavior.tooltip');
	$ordering = ($this->diaShows['lists']['order'] == 'ordering');	
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
</style>

<script language="JavaScript">
function changeCategory()
{
	document.adminForm.submit();
}
</script>

<form action="index.php?option=com_diashow&controller=managediashows" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( '_DIASHOW_NAME' ); ?></legend>
		<table>
		<tr>
			<td align="left" width="100%">
				<?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" value="<?php echo $this->diaShows['lists']['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
			</td>
			<td nowrap="nowrap">
				<?php
				echo $this->diaShows['lists']['categories'];
				?>
			</td>
			<td nowrap="nowrap">
				<?php
				echo $this->diaShows['lists']['state'];
				?>
			</td>
		</tr>
		</table>
		<table class="adminlist">
			<thead>
				<tr>
					<th width="20"  align="center">
						<?php echo JText::_( 'Num' ); ?>
					</th>
					<th width="20"  align="center">
						<input type="checkbox" name="toggle" value=""  onclick="checkAll(<?php echo count( $this->diaShows['rows'] ); ?>);" />
					</th>
					<th nowrap="nowrap" class="title">
						<?php echo JHTML::_('grid.sort',  'DIASHOW_TITLE', 'autor', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th nowrap="nowrap" class="title">
						<?php echo JHTML::_('grid.sort',  'DIASHOW_LINK', 'description', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th nowrap="nowrap" class="title">
						<?php echo JHTML::_('grid.sort',  'DIASHOW_TARGET', 'category_id', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th nowrap="nowrap" class="title">
						<?php echo JHTML::_('grid.sort',  'DIASHOW_IMAGE', 'picture', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th nowrap="nowrap" class="title">
						<?php echo JHTML::_('grid.sort',  'DIASHOW_SHOW_UNDER', 'picture', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>					
					<th width="5%" class="title" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',   'Published', 'published', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th nowrap="nowrap" width="8%">
						<?php echo JHTML::_('grid.sort',   'Order by', 'ordering', @$lists['order_Dir'], @$lists['order'] ); ?>
						<?php echo JHTML::_('grid.order',  $this->diaShows['rows'] ); ?>
					</th>	
					<th width="1%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',   'ID', 'id', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="9">
						<?php echo $this->diaShows['_pageNav']->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
		<?php
		$k = 0;
		for ($i=0, $n=count( $this->diaShows['rows'] ); $i < $n; $i++)
		{
			$row = &$this->diaShows['rows'];
			$link =  'index.php?option=com_diashow&amp;controller=managediashows&amp;task=edit&amp;cid[]='. $row[$i]->id ;
			
			$published 		= JHTML::_('grid.published', $row[$i], $i );
			$checked 		= JHTML::_('grid.checkedout',   $row[$i], $i );
		
		?>
					<tr class="<?php echo "row$k"; ?>">
					<td align="center">
						<?php echo $this->diaShows['_pageNav']->getRowOffset($i); ?>
					</td>
					<td align="center">
						<?php echo $checked; ?>
					</td>
					<td>
						<?php
						if ( $row->checked_out && ( $row->checked_out != $user->get ('id') ) ) {
							echo $row[$i]->title;
						} else {
							?>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_( 'EDIT ENTRY' ); ?>">
								<?php echo $row[$i]->title; ?></a>
							<?php
						}
						?>
					</td>
					<td>
						<a href="<?php echo $row[$i]->link; ?>" target="_blank"><?php echo $row[$i]->link; ?></a>
					</td>
					<td>
						<?php echo $row[$i]->target; ?>
					</td>
					<td align="center"><img src="../images/stories/diashow/<?php echo $row[$i]->image; ?>" border="0" title="<?php echo $row[$i]->image; ?>" /></td>
					<td>
						<?php echo $this->diaShows['linkedTo'][$i]; ?>
					</td>
					<td align="center">
						<?php echo $published;?>
					</td>
					<td class="order">
						<span><?php echo $this->diaShows['_pageNav']->orderUpIcon( $i, ( $row[$i]->catid == @$rows[$i-1]->catid ), 'orderup', 'Move Up', $ordering ); ?></span>
						<span><?php echo $this->diaShows['_pageNav']->orderDownIcon( $i, $n, ( $row[$i]->catid == @$rows[$i+1]->catid ), 'orderdown', 'Move Down', $ordering ); ?></span>
						<?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
						<input type="text" name="order[]" size="5" value="<?php echo $row[$i]->ordering;?>" <?php echo $disabled ?> class="text_area" style="text-align: center" />
					</td>
					<td align="center">
						<?php echo $row[$i]->id; ?>
					</td>
				</tr>
		<?php
		$k = 1 - $k;
		}
		?>
			</tbody>
			</table>
		</fieldset>
</div>

<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="id" value="" />
<input type="hidden" name="task" value="view" />
<input type="hidden" name="controller" value="managediashows" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->diaShows['lists']['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $filter_order_Dir; ?>" />
</form>