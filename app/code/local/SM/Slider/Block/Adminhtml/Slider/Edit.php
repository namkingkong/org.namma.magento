<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/10/14
 * Time: 4:03 PM
 */
class SM_Slider_Block_Adminhtml_Slider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

	public function __construct() {
		parent::__construct();

		$this->_blockGroup = 'sm_slider';
		$this->_controller = 'adminhtml_slider';

		$this->_updateButton('save', 'label', $this->__('Save Slider'));
		$this->_updateButton('delete', 'label', $this->__('Remove Slider'));
	}

	/**
	 * Generate web page header
	 *
	 * @return string
	 */
	public function getHeaderText() {
		/*
		 * Get the Slider instance put in the registry,
		 * then check if the instance is new or an existed one
		 */
		if (Mage::registry('sm_slider_slider')->getId()) {
			return $this->__('Edit Slider');
		}
		else {
			return $this->__('New Slider');
		}
	}

}
