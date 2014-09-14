<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/9/14
 * Time: 3:18 PM
 */
class SM_Slider_Model_Mysql4_Image_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

	protected function _construct() {
		$this->_init('sm_slider/image');
	}

}
