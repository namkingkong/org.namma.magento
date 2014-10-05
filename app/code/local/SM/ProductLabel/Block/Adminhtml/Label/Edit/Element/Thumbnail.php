<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/3/14
 * Time: 1:31 AM
 */
class SM_ProductLabel_Block_Adminhtml_Label_Edit_Element_Thumbnail extends Varien_Data_Form_Element_Abstract {

	public function __construct($data) {
		parent::__construct($data);
		$this->setType('file');
	}

	public function getElementHtml() {
		$label = Mage::registry('sm_productLabel_label');

		$src = Mage::getBaseUrl('media') . 'sm/label/' . $label->getFilename();

		return "<img src='{$src}' alt='{$label->getName()}' class='sm-label-thumbnail' style='max-width: 100px;'>";
	}

}