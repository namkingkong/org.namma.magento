<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/1/14
 * Time: 4:28 PM
 */
class SM_ProductLabel_Block_Adminhtml_Label_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

	public function __construct() {
		parent::__construct();

		$this->_blockGroup = 'sm_productLabel';
		$this->_controller = 'adminhtml_label';

		$this->_updateButton('save', 'label', $this->__('Save'));
		$this->_updateButton('delete', 'label', $this->__('Remove'));
	}

	public function getHeaderText() {
		if (Mage::registry('sm_productLabel_label')->getId()) {
			return $this->__('Edit Product Label');
		}
		else {
			return $this->__('Create New Product Label');
		}
	}

}