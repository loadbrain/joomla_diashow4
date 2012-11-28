<?php
/*------------------------------------------------------------------------
# com_diashow - DiaShow5 - Joomla 3.x
# ------------------------------------------------------------------------
# author Ralf Weber
# copyright Copyright (C) 2011 http://www.weberr.de/. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.weberr.de/
# Technical Support: Forum - http://www.weberr.de/
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Rwcards Form Field class for the Rwcards component
 */
class JFormFieldRwcards extends JFormFieldList
{
        /**
         * The field type.
         *
         * @var         string
         */
        protected $type = 'Rwcards';

        /**
         * Method to get a list of options for a list input.
         *
         * @return      array           An array of JHtml options.
         */
        protected function getOptions()
        {
                $db = JFactory::getDBO();
                $query = $db->getQuery(true);
                $query->select('id, category_layout_option');
                $query->from('#__rwcardsconfig');
                $db->setQuery((string)$query);
                $category_layout_options = $db->loadObjectList();
                $options = array();
                if ($category_layout_options)
                {
                        foreach($category_layout_option as $category_layout_option)
                        {
                                $options[] = JHtml::_('select.option', $category_layout_option->id, $category_layout_option->category_layout_option);
                        }
                }
                $options = array_merge(parent::getOptions(), $options);
                return $options;
        }


}

