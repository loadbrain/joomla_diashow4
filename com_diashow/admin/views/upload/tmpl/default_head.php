<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<tr>
        <th>
                <?php
                if ($this->canDo->get('core.edit')){
                	echo JText::_('COM_DIASHOW_UPLOAD_HEADER');
                }?>
        </th>
</tr>
