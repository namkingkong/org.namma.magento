<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/1/14
 * Time: 2:10 PM
 */
class SM_ProductLabel_Model_Mysql4_Label_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

	protected function _construct() {
		$this->_init('sm_productLabel/label');
	}

}