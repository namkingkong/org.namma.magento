<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/8/14
 * Time: 9:25 AM
 */
class SM_MegaMenu_Model_Mysql4_Item_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

	protected function _construct() {
		$this->_init('sm_megamenu/item');
	}

}
