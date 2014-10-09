<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 1:50 PM
 */
class SM_MegaMenu2_Block_Adminhtml_Item_Edit_Renderer_CategorySelect extends Varien_Data_Form_Element_Abstract
{
	public function __construct($data)
	{
		parent::__construct($data);
		$this->setType('select');
	}

	public function getElementHtml()
	{
		$category = Mage::getModel('catalog/category');

		$tree = $category->getTreeModel()->load();

		$ids = $tree->getCollection()->getAllIds();

		$html = "<select name='{$this->getName()}'><option>--- Nothing ---</option>";

		if ($ids) {
			foreach ($ids as $id) {
				$cat = Mage::getModel('catalog/category')->load($id);

				if ($cat->getIsActive()) {
					$html .= "<option value='{$id}'>{$cat->getName()}</option>";
				}
			}
		}

		$html .= '</select>';

		return $html;
	}
}