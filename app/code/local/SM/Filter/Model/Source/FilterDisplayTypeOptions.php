<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/25/14
 * Time: 3:04 PM
 */
class SM_Filter_Model_Source_FilterDisplayTypeOptions extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {

	const LINK_VALUE        = 1;
	const LINK_LABEL        = 'Link';

	const CHECKBOX_VALUE    = 2;
	const CHECKBOX_LABEL    = 'Checkbox';

	const SELECT_VALUE      = 3;
	const SELECT_LABEL      = 'Select';

	const COLOR_VALUE       = 4;
	const COLOR_LABEL       = 'Color';

	public function getAllOptions() {
		$helper = Mage::helper('sm_filter');

		return array(
			array(
				'value'     => static::LINK_VALUE,
				'label'     => $helper->__(static::LINK_LABEL)
			),
			array(
				'value'     => static::CHECKBOX_VALUE,
				'label'     => $helper->__(static::CHECKBOX_LABEL)
			),
			array(
				'value'     => static::SELECT_VALUE,
				'label'     => $helper->__(static::SELECT_LABEL)
			),
			array(
				'value'     => static::COLOR_VALUE,
				'label'     => $helper->__(static::COLOR_LABEL)
			)
		);
	}

}