<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/11/14
 * Time: 2:42 PM
 */
class SM_Slider_Model_Observer_SliderObserver {

	/**
	 * This execution is always fired
	 * before a Slider is inserted or updated.
	 *
	 * If this event is set to be active,
	 * find the currently active one and de-activate it.
	 *
	 * @param $observer Varien_Event_Observer
	 */
	public function sliderBeforeSave($observer) {
		// Get slider being saved
		$slider = $observer->getEvent()->getObject();

		/*
		 * There is only 1 slider may be active.
		 * So if this slider is set to be active,
		 * find the currently active one to de-activate it before save this.
		 */
		if ($slider->getIsActive()) {
			// Get writing-allowed connection
			$connection = Mage::getSingleton('core/resource')->getConnection('core_write');

			// Execute update query
			$connection->update(
				// Table name
				Mage::getSingleton('core/resource')->getTableName('sm_slider/slider'),
				// Changes you wanna make
				array(
					'is_active' => false
				),
				// Record-seeking condition (aka WHERE) =))
				array(
					'is_active' => true
				)
			);
		}
	}
}
