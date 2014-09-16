<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/15/14
 * Time: 3:57 PM
 */
class SM_Slider_Model_System_Config_Source_SliderMode {

	public function toOptionArray() {
		return array(
			array(
				'value' => 'horizontal',
				'label' => Mage::helper('sm_slider')->__('Horizontal')
			),
			array(
				'value' => 'vertical',
				'label' => Mage::helper('sm_slider')->__('Vertical')
			)
		);
	}

	public function toArray() {
		return array(
			'horizontal'    => Mage::helper('sm_slider')->__('Horizontal'),
			'vertical'      => Mage::helper('sm_slider')->__('Vertical')
		);
	}

}