<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/11/14
 * Time: 5:07 PM
 */
class SM_Slider_Block_Adminhtml_Image extends Mage_Adminhtml_Block_Widget_Grid_Container {

	public function __construct() {
		parent::__construct();

		$this->_blockGroup = 'sm_slider';
		$this->_controller = 'adminhtml_image';

		$this->_headerText = $this->__('Image List');
		$this->_addButtonLabel = $this->__('Add New Image');
	}

}
