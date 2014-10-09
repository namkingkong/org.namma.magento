<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 2:05 PM
 */
class SM_MegaMenu2_Block_Adminhtml_Item_Edit_Renderer_BlockSelect extends Varien_Data_Form_Element_Abstract
{
	public function __construct($data)
	{
		parent::__construct($data);
		$this->setType('select');
	}

	public function getElementHtml()
	{
		$blocks = Mage::getModel('cms/block')->getCollection()->addFieldToSelect(array('block_id', 'title'));

		$html = "<select name='{$this->getName()}'><option>--- Nothing ---</option>";

		foreach ($blocks as $block) {
			$html .= "<option value='{$block->getId()}'>{$block->getTitle()}</option>";
		}

		$html .= '</select>';

		return $html;
	}
}