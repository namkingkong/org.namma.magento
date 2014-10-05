<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/2/14
 * Time: 5:48 PM
 */
class SM_ProductLabel_Block_Adminhtml_Label_Grid_Renderer_Thumbnail extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

	public function render(Varien_Object $obj) {
		$src = Mage::getBaseUrl('media') . "sm/label/{$obj->getFilename()}";

		return "<img src='{$src}' alt='{$obj->getName()}' class='sm-label-thumbnail' style='max-width: 100px;'>";
	}

}