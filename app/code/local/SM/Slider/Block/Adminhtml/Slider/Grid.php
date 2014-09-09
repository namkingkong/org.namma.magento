<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/9/14
 * Time: 5:32 PM
 */
class SM_Slider_Block_Adminhtml_Slider_Grid extends Mage_Adminhtml_Block_Widget_Grid {

	/**
	 * @return Mage_Adminhtml_Block_Widget_Grid
	 */
	protected function _prepareCollection() {
		$this->setCollection(
			Mage::getModel('sm_slider/slider')->getCollection()
		);

		return parent::_prepareCollection();
	}


}
