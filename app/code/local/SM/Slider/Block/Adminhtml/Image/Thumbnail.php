<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/11/14
 * Time: 5:40 PM
 */
class SM_Slider_Block_Adminhtml_Image_Thumbnail
		extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

	public function render(Varien_Object $row) {
		$sliderId = $row->getSliderId();
		$filename = $row->getFilename();
		$imageId = $row->getId();

		$href = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)
			. "sm/slider/{$sliderId}/{$imageId}_{$filename}";

		return "<img src='{$href}' style='width: 100%'>";
	}

}
