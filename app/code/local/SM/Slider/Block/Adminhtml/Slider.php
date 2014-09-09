<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/9/14
 * Time: 5:20 PM
 */
class SM_Slider_Block_Adminhtml_Slider extends Mage_Adminhtml_Block_Widget_Grid_Container {

	public function __construct() {
		$helper = Mage::getHelper('sm_slider');

		$this->_controller = 'adminhtml_slider';
		$this->_blockGroup = 'sm_slider';

		$this->_headerText = $helper->__('Manage Slider');
		$this->_addButtonLabel = $helper->__('Add New Slider');

		// Call accessor's constructor
		parent::__construct();
	}

}
