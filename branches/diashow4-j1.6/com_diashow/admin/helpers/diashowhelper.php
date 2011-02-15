<?php
defined('_JEXEC') or die;

class DiashowHelper
{
	public static function getActions($bookId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($bookId)) {
			$assetName = 'com_diashow';
		} else {
			$assetName = 'com_diashow.diashow'.(int) $bookId;
		}

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}
}