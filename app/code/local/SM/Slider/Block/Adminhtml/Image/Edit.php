<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/12/14
 * Time: 11:21 AM
 */
class SM_Slider_Block_Adminhtml_Image_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

	public function __construct() {
		parent::__construct();

		$this->_blockGroup = 'sm_slider';
		$this->_controller = 'adminhtml_image';

		$this->_updateButton('save', 'label', $this->__('Save'));
		$this->_updateButton('delete', 'label', $this->__('Remove'));

		// Get slider ID
		if ($imageId = $this->getRequest()->getParam('id')) {
			$sliderId = Mage::getModel('sm_slider/image')->load($imageId)->getSliderId();
		}
		else {
			$sliderId = $this->getRequest()->getParam('slider_id');
		}

		$this->_updateButton(
			'back',
			'onclick',
			"document.location = '{$this->getUrl("*/sm_slider/edit/id/{$sliderId}")}'"
		);
	}

	public function getHeaderText() {
		if (Mage::registry('sm_slider_image')->getId()) {
			return $this->__('Edit Image');
		}
		else {
			return $this->__('New Image');
		}
	}

	protected function _prepareLayout() {
		parent::_prepareLayout();

		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
			$this->getLayout()
				->getBlock('head')
				->setCanLoadTinyMce(true);
		}
	}

}
