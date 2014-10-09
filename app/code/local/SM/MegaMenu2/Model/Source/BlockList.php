<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 2:27 PM
 */
class SM_MegaMenu2_Model_Source_BlockList
{
	public function getOptionsArray()
	{
		$blocks = Mage::getModel('cms/block')->getCollection()->addFieldToSelect(array('block_id', 'title'));

		$options = array();

		foreach ($blocks as $block) {
			$options[$block->getId()] = $block->getTitle();
		}

		return $options;
	}
}