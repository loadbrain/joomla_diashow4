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
 
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');
$item = new stdClass();
?>
<form
    action="<?php echo JRoute::_('index.php?option=com_diashow'); ?>"
    method="post" name="adminForm">
    <table class="table table-striped" id="articleList">
        <thead>
            <tr>
                <th>
                    <?php
                                if ($this->canDo->get('core.edit')) {
                                    echo JText::_('COM_DIASHOW_UPLOAD_HEADER');
                                }?>
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="4">DiaShow &copy 2011</td>
            </tr>
        </tfoot>
        <tbody>

            <tr class="row<?php $i=0; echo $i % 2; ?>"
                sortable-group-id="<?php echo isset($item->id) ? $item->id : ""?>">
                <td class="order nowrap center hidden-phone">
                    <div id="image">
                        <?php
                    if ($this->canDo->get('core.edit')) {
                        foreach ($this->form->getFieldset('image') as $field): ?>
                        <?php if (!$field->hidden): ?>
                        <?php echo $field->label; ?>
                        <?php endif; ?>
                        <?php echo $field->input; ?>
                        <?php endforeach;
                    }
                    ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <h3><?php echo JText::_('COM_DIASHOW_UPLOAD_EXISTING_IMAGES'); ?>
                    </h3>
                </td>
            </tr>

            <tr>
                <td>
                    <?php
                if (is_array($this->images)) {
                    $i=0;
                    $breite = 160;
                    $hoehe = 120;
                    $sizemin = array();

                    echo "<table border='0' cellspacing='5' cellpadding='5' width='100%'><tr>";
                    foreach ($this->images as $val) {
                        $size = getimagesize(JPATH_ROOT . "/images/diashow/" . $val);
                        // zugross & quer
                        if ($size[0] > $breite && $size[1] > $hoehe  && $size[0] >= $size[1]) {
                            if ($size[0] == $size[1]) {
                                $sizemin[0] = $breite;
                                $sizemin[1] = $breite;
                            } else {
                                $sizemin[0] = $breite;
                                $sizemin[1] = $hoehe;
                            }
                        }
                        // zugross & hochkant
                        elseif ($size[0] > $breite && $size[1] > $hoehe && $size[1] > $size[0]) {
                            $sizemin[0] = $hoehe;
                            $sizemin[1] = $breite;
                        }
                        // breite zu gross:
                        elseif ($size[0] > $breite) {
                            $sizemin[0] = $breite;
                            $sizemin[1] = $size[1];
                        }
                        // hoehe zu gross:
                        elseif ($size[1] > $hoehe) {
                            $sizemin[0] = $size[0];
                            $sizemin[1] = $hoehe;
                        }
                        // bild ok:
                        else {
                            $sizemin[0] = $sizemin[0];
                            $sizemin[1] = $sizemin[1];
                        }

                        if (preg_match("/jpg$|gif$|png$/", $val)) {
                            echo "<td><img src='../images/diashow/" . $val . "' width=' . $sizemin[0]  . ' height=' . $sizemin[1] . ' align=top style='padding:5px; margin:5px; border:1px solid black; background-color:#ffffff;'><br>" . JText::_('UPLOAD_IMAGE_NAME') . ": " .  $val . "</td>";
                            $i++;
                        }
                
                        echo ($i % 5 == 0) ? "</tr><tr>" : "";
                    }
                }
                 //echo ($i % 5 == 0) ? "</tr>" : "";
                 ?>
            </tr>
    </table>

    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <?php echo JHtml::_('form.token'); ?>
    </div>

</form>
