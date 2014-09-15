<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/15/14
 * Time: 8:56 AM
 */
class SM_Slider_Block_Adminhtml_Image_Edit_Element_Thumbnail extends Varien_Data_Form_Element_Abstract {

	public function __construct($data) {
		parent::__construct($data);
		$this->setType('file');
	}

	public function getElementHtml() {
		$id = Mage::app()->getRequest()->getParam('id');

		$model = Mage::getModel('sm_slider/image')->load($id);

		$src = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "sm/slider/{$model->getSliderId()}/{$id}_{$model->getFilename()}";

		return "<img src='{$src}' alt='Slider Image'>";
	}

}