<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$canOrder	= $user->authorise('core.edit.state', 'com_diashow.diashows');
$saveOrder	= 'ordering';
$cntx = 'diashows';
?>
<?php foreach($this->items as $i => $item):
$ordering	= ($listOrder == 'ordering');?>
        <tr class="row<?php echo $i % 2; ?>">

                <td colspan="2" align="center">
                        <?php
                        if ($this->canDo->get('core.edit')){
                        	echo JHtml::_('grid.id', $i, $item->id);
                        }
                        else{
                        echo $item->id;
                        }?>
                </td>
                <td>
                <?php if ($this->canDo->get('core.edit')){ ?>
		                <a href="<?php echo JRoute::_('index.php?option=com_diashow&task=diashow.edit&id='.$item->id);?>">
                <?php }
                        echo JTEXT::_($item->title); ?>
                        </a>
                </td>
                <td>
                        <?php echo "<img src='../images/diashow/" .  $item->image . "' />"; ?>
                </td>
                <td>
                        <?php echo JTEXT::_($item->link); ?>
                </td>
                <td>
                        <?php echo JTEXT::_($item->target); ?>
                </td>
                <td>
                        <?php echo JTEXT::_($item->menu); ?>
                </td>
                <td align="center">
                        <?php echo  JHtml::_('jgrid.published', $item->published, $i, 'diashow.'); ?>
                </td>
                <td>
				<?php if ($saveOrder) {
						if ($listDirn == 'asc') {
							echo '<span>'. $this->pagination->orderUpIcon($i, true, $cntx.'.orderup', 'JLIB_HTML_MOVE_UP', $ordering).'</span>';
							echo '<span>'.$this->pagination->orderDownIcon($i, $this->pagination->total, true, $cntx.'.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering).'</span>';
						} else if ($listDirn == 'desc') {
							echo '<span>'. $this->pagination->orderUpIcon($i, true, $cntx.'.orderdown', 'JLIB_HTML_MOVE_UP', $ordering).'</span>';
							echo '<span>'.$this->pagination->orderDownIcon($i, $this->pagination->total, true, $cntx.'.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering).'</span>';
						}
					}
					$disabled = $saveOrder ?  '' : 'disabled="disabled"';
					echo '<input type="text" name="order[]" size="5" value="'.$item->ordering.'" '.$disabled.' class="text-area-order" />';
				 ?>
                </td>
        </tr>
<?php endforeach; ?>

