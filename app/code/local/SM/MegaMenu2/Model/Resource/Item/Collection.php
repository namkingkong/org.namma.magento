<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/6/14
 * Time: 11:36 PM
 */
class SM_MegaMenu2_Model_Resource_Item_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	protected function _construct()
	{
		$this->_init('sm_megamenu2/item');
	}
}