<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 2:48 PM
 */
class SM_MegaMenu2_Block_Frontend_Menu extends Mage_Core_Block_Template
{
	public function getMenuItems()
	{
		return Mage::getModel('sm_megamenu2/item')
			->getCollection()
			->setOrder('item_type', 'asc');
	}

	public function getCategories($parentId) {

	}
}