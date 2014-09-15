<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/15/14
 * Time: 9:25 AM
 */
class SM_Slider_Block_Slider extends Mage_Core_Block_Template {

	public function getActiveSlider() {
		$sliderCollecion = Mage::getModel('sm_slider/slider')
			->getCollection()
			->addFieldToFilter('is_active', true)
			->setPageSize(1)
			->setCurPage(1);

		return $sliderCollecion->count() ?
			$sliderCollecion->getFirstItem() : null;
	}

}