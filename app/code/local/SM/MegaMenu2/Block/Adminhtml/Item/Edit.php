<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 3:20 AM
 */
class SM_MegaMenu2_Block_Adminhtml_Item_Edit
		extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
		parent::__construct();

		$this->_blockGroup = 'sm_megamenu2';
		$this->_controller = 'adminhtml_item';

		$this->_updateButton('save', 'label', $this->__('Save'));
		$this->_updateButton('delete', 'label', $this->__('Remove'));
	}

	public function getHeaderText()
	{
		return Mage::registry('sm_megamenu2_item')->getId() ?
			$this->__('Edit Mega Menu Item'): $this->__('Create New Mega Menu Item');
	}
}