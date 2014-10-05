<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/1/14
 * Time: 3:51 PM
 */
class SM_ProductLabel_Block_Adminhtml_Label extends Mage_Adminhtml_Block_Widget_Grid_Container {

	public function __construct() {
		$this->_blockGroup = 'sm_productLabel';
		$this->_controller = 'adminhtml_label';

		$this->_headerText = $this->__('Manage Product Labels');
		$this->_addButtonLabel = $this->__('Add New Product Label');

		parent::__construct();
	}

}