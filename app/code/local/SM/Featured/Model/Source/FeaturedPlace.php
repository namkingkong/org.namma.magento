<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 9/16/14
 * Time: 5:52 PM
 */
class SM_Featured_Model_Source_FeaturedPlace extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {

	const CATEGORY_VALUE    = 1;
	const CATEGORY_LABEL    = 'Category';

	const WEBSITE_VALUE     = 2;
	const WEBSITE_LABEL     = 'Website';

	const BOTH_VALUE        = 3;
	const BOTH_LABEL        = 'Both';

	public function getAllOptions() {
		return array(
			array('value' => self::CATEGORY_VALUE,  'label' => self::CATEGORY_LABEL),
			array('value' => self::WEBSITE_VALUE,   'label' => self::WEBSITE_LABEL),
			array('value' => self::BOTH_VALUE,      'label' => self::BOTH_LABEL)
		);
	}

	public function toOptionArray() {
		return $this->getAllOptions();
	}

	public function toArray() {
		$options = array();

		foreach ($this->getAllOptions() as $node) {
			$options[$node['value']] = $node['label'];
		}

		return $options;
	}

	public function getPlaceName($placeID) {
		return $this->toArray()[$placeID];
	}

}