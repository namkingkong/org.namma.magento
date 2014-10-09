<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 2:56 AM
 */
class SM_MegaMenu2_Block_Adminhtml_Item_Grid_Renderer_ItemType
		extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $obj)
	{
		switch ($obj->getItemType()) {
			case SM_MegaMenu2_Model_Source_ItemType::CATEGORY :
				$content = 'Category Menu';
				break;
			case SM_MegaMenu2_Model_Source_ItemType::BLOCK :
				$content = 'Static-block Menu';
				break;
			case SM_MegaMenu2_Model_Source_ItemType::LINK :
				$content = 'Link';
				break;
			default :
				$content = 'Item type having type-code of ' . $obj->getItemType() . ' is not supported';
		}

		return $content;
	}
}