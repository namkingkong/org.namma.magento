<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/1/14
 * Time: 2:42 PM
 */
class SM_ProductLabel_Model_Source_Label extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {

	const NONE_VALUE = null;
	const NONE_LABEL = 'None';

	protected $labels = null;

	protected function getLabels() {
		// Load only if labels array is not loaded yet
		if ($this->labels === null) {
			$this->labels = Mage::getModel('sm_productLabel/label')
				->getCollection()
				->addFieldToSelect(array('id', 'name'));
		}

		return $this->labels;
	}

	public function getAllOptions() {
		$options = array(
			array(
				'value'     => static::NONE_VALUE,
				'label'     => static::NONE_LABEL
			)
		);

		foreach ($this->getLabels() as $label) {
			$options[] = array(
				'value'     => $label->getId(),
				'label'     => $label->getName()
			);
		}

		return $options;
	}

}