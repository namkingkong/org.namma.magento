<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/9/14
 * Time: 5:20 PM
 */
class SM_Slider_Block_Adminhtml_Slider extends Mage_Adminhtml_Block_Widget_Grid_Container {

	public function __construct() {
		/*
		 * This is the first half part of Block URI
		 */
		$this->_blockGroup = 'sm_slider';
		/*
		 * This is the second half part of Block URI
		 * ("controller" here does not mean a MVC Controller,
		 * it's Block Controller, or we can call a Container")
		 */
		$this->_controller = 'adminhtml_slider';

		// No need to call Helper
		$this->_headerText = $this->__('Manage Slider');
		$this->_addButtonLabel = $this->__('Add New Slider');

		// Call predecessor's constructor
		parent::__construct();
	}

}
