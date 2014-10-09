<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 2:27 AM
 */
class SM_MegaMenu2_Block_Adminhtml_Item_Grid_Renderer_Content
		extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $obj)
	{
		switch ($obj->getItemType()) {
			case SM_MegaMenu2_Model_Source_ItemType::CATEGORY : {
				$category = Mage::getModel('catalog/category')->load($obj->getCategoryId());
				$content =  "{$category->getName()} (ID = {$category->getId()})";
				break;
			}
			case SM_MegaMenu2_Model_Source_ItemType::BLOCK : {
				$block = Mage::getModel('cms/block')->load($obj->getBlockId());
				$content = "{$block->getTitle()} (ID = {$block->getId()})";
				break;
			}
			case SM_MegaMenu2_Model_Source_ItemType::LINK : {
				$content = "<a href='{$obj->getLink()}'>{$obj->getLink()}</a>";
				break;
			}
			default:
				$content = 'Item type having type-code of ' . $obj->getItemType() . ' is not supported';
		}

		return $content;
	}
}