<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/12/14
 * Time: 11:21 AM
 */
class SM_Slider_Block_Adminhtml_Image_FormContainer extends Mage_Adminhtml_Block_Widget_Form_Container {

	public function __construct() {
		parent::__construct();

		$this->_blockGroup = 'sm_slider';
		$this->_controller = 'adminhtml_image';

		$this->_updateButton('save', 'label', $this->__('Save'));
		$this->_deleteButton('delete', 'label', $this->__('Remove'));
	}

	public function getHeaderText() {
		if (Mage::getRegistry('sm_slider_image')->getId()) {
			return $this->__('Edit Image');
		}
		else {
			return $this->__('New Image');
		}
	}

}
