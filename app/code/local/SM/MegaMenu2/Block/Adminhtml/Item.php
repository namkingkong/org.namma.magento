<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 1:43 AM
 */
class SM_MegaMenu2_Block_Adminhtml_Item extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup      = 'sm_megamenu2';
		$this->_controller      = 'adminhtml_item';
		$this->_headerText      = $this->__('Manage Mega Menu Items');
		$this->_addButtonLabel  = $this->__('Add new menu item');

		parent::__construct();
	}
}